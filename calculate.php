<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

<table class ="table table-striped">

  <tr>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Payment per Hour</th>
    <th>Hours In</th>
    <th>Hours Out</th>
    <th>Total Hours</th>
    <th>Total Payment</th>
  </tr>

  <tr>
    <?php
        error_reporting(0);
        include'connection.php';

        //query qe merr te dhenat nga databaza

        $sql = "SELECT employee_salary.employee_id, employee_salary.name, employee_salary.salary, working_days.hours, specific_days.day_type
                FROM employee_salary 
                JOIN working_days 
                ON employee_salary.employee_id = working_days.employee_id 
                JOIN specific_days 
                ON working_days.day_id = specific_days.day_id";



    $result_users_data = mysqli_query($connect, $sql);

      $data = array();
      while($row = mysqli_fetch_assoc($result_users_data)){
        
          $data[$row['employee_id']]['id'] = $row['employee_id'];
          $data[$row['employee_id']]['name'] = $row['name'];
          $data[$row['employee_id']]['salary'] = $row['salary'];
          $data[$row['employee_id']]['hours'] = $row['hours'];
          $data[$row['employee_id']]['day_type'] = $row['day_type'];
          $data[$row['employee_id']]['payment_per_hours'] = round( ($row['salary']/22/8) ,2);
          
          $day_type = $row['day_type'];
          $in_hours = $row['hours'];
          $out_hours = 0;

        if ($in_hours > 8) {
            $in_hours = 8;
            $out_hours = $row['hours'] - 8;
        }

          $data[$row['employee_id']]['in_hours'] += $in_hours;
          $data[$row['employee_id']]['out_hours'] += $out_hours;
          $data[$row['employee_id']]['total_hours'] += $in_hours + $out_hours;

          $k=0;
          $k_extra = 0;

            if($day_type=='holiday') {
                    $k=1.5;
                    $k_extra = 2;       
            }elseif($day_type=='weekend'){
                    $k=1.25;
                    $k_extra = 1.5;
            }else{
                    $k=1;
                    $k_extra = 1.25;
            }
                $data[$row['employee_id']]['total_payment'] += round( ($data[$row['employee_id']]['in_hours'] * $data[$row['employee_id']]['payment_per_hours'] * $k) ,2);
                $data[$row['employee_id']]['total_payment'] += round( ($data[$row['employee_id']]['out_hours'] * $data[$row['employee_id']]['payment_per_hours'] * $k_extra) ,2);
         
        }

            // echo"<pre>";
            // print_r($data);

    foreach ($data as $employee_id => $information){
            echo "<tr><td>$employee_id</td><td>$information[name]</td><td>$information[payment_per_hours]</td><td>$information[in_hours]</td>
            <td>$information[out_hours]</td><td>$information[total_hours]</td><td>$information[total_payment]</td>";
            }
      
          echo "</tr></table>";
          exit;


//====================================================================================================================================================
// $result_users_data = mysqli_query($connect, $sql);

//   $data = array();
//   while($row = mysqli_fetch_assoc($result_users_data)){
    
//     $data[$row['employee_id']]['id'] = $row['employee_id'];
//     $data[$row['employee_id']]['name'] = $row['name'];
//     $data[$row['employee_id']]['salary'] = $row['salary'];
//     $data[$row['employee_id']]['hours'] = $row['hours'];
//     $data[$row['employee_id']]['day_type'] = $row['day_type'];
//     $data[$row['employee_id']]['payment_per_hours'] = round( ($row['salary']/22/8) ,2);
    

//     $in_hours = $row['hours'];
//     $out_hours = 0;

//     if ($in_hours > 8) {
//       $in_hours = 8;
//       $out_hours = $row['hours'] - 8;
//     }
//     $data[$row['employee_id']]['in_hours'] += $in_hours;
//     $data[$row['employee_id']]['out_hours'] += $out_hours;
//     $data[$row['employee_id']]['total_hours'] += $in_hours + $out_hours;

//     if($data[$row['employee_id']]['day_type']=='weekend') {

//       $data[$row['employee_id']]['total_payment'] += $data[$row['employee_id']]['in_hours'] * $data[$row['employee_id']]['payment_per_hours'] * 1.25;
//       $data[$row['employee_id']]['total_payment'] += $data[$row['employee_id']]['out_hours'] * $data[$row['employee_id']]['payment_per_hours'] * 1.5;

//     }elseif($data[$row['employee_id']]['day_type']=='holiday'){

//       $data[$row['employee_id']]['total_payment'] += $data[$row['employee_id']]['in_hours'] * $data[$row['employee_id']]['payment_per_hours'] * 1.5;
//       $data[$row['employee_id']]['total_payment'] +=  $data[$row['employee_id']]['out_hours'] * $data[$row['employee_id']]['payment_per_hours'] * 2;
//     }else{

//       $data[$row['employee_id']]['total_payment'] +=  $data[$row['employee_id']]['in_hours'] * $data[$row['employee_id']]['payment_per_hours'];
//       $data[$row['employee_id']]['total_payment'] +=  $data[$row['employee_id']]['out_hours'] * $data[$row['employee_id']]['payment_per_hours'] * 1.25;
//     }

//   }



// // echo"<pre>";
// // print_r($data);

// foreach ($data as $employee_id => $information){
//   echo "<tr><td>$employee_id</td><td>$information[name]</td><td>$information[total_hours]</td><td>$information[total_payment]</td>";
//   }
  
//   echo "</tr></table>";

//====================================================================================================================================================




// foreach($data as $data_result){

//   $data_result['daily_rate'] = null;
//      $day_type = $data_result['day_type'];
     
//         $hourly_rate = $data_result['salary'] / 176; // paga fikse pjesetuar me 22 dite pune * 8 ore pune te zakonshme ne dite
  
//         $hours = $data_result['hours']; 

//         switch ($day_type) {
//           case 'holiday':
//             $data_result['daily_rate'] = $hourly_rate * $hours * 1.5;
//              break;
  
//           case 'weekend':
//             $data_result['daily_rate'] = $hourly_rate * $hours * 1.25; // llogariten te ardhurat per secilen dite pune ne menyre te ndare me pas mblidhen ne baze te id se punonjesit
//               break;
          
//           default:
  
//           if($hours>8){
            
//           $data_result['daily_rate'] = $hourly_rate*8 + $hourly_rate*($hours-8)* 1.25;
             
//           }else{
//             $data_result['daily_rate'] = $hourly_rate * $hours;
//           }
//           break;
                
//         }

//     print_r($data_result);
//     exit;
//     if(!isset($result[$data_result['employee_id']])){ // grupohen te ardhurat e seciles dite pune per te gjetur totalin e te ardhurave per te gjitha ditet qe ka punuar cdo punonjes
//       $result[$data_result['employee_id']] = $data_result;  // ruajme ne vektorin result me celes id e punonjesit
//     } else{
//       $result[$data_result['employee_id']]['daily_rate'] += $data_result['daily_rate']; // autoshume per te mbledhur te ardhurat e seciles dite dhe oret totale te punes
//       $result[$data_result['employee_id']]['hours'] += $data_result['hours'];  
//     }

// }

// // print_r($result);
// //printohen te dhenat ne forme tabele

// foreach ($result as $employee_id => $information){
//   echo "<tr><td>$employee_id</td><td>$information[name]</td><td>$information[hours]</td><td>$information[daily_rate]</td>";
//   }
  
//   echo "</tr></table>";

?>

</tr>
</table>
</body>
</html>






