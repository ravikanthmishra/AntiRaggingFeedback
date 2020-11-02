
<?php

if(isset($_POST['dept']) && isset($_POST['batch'])){
	echo '<script>window.alert("enterd");</script>';
  $connect = mysqli_connect("localhost","root","","feedback") or die("cannot connect");;
  $batch = $_POST['batch'];
  $dept = $_POST['dept'];
  //echo '<script>window.alert('.$dept.');</script>';
  $output = '';
  	  $studentlist = mysqli_query($connect,"SELECT id FROM students WHERE batch = $batch AND dept = '$dept' ") or die(mysqli_error($connect));
 
  $output = '<option value=""> Select Id</option>';
	  while($row1 = mysqli_fetch_array($studentlist)){
		  $output. = '<option value="'.$row1['id'].'">'.$row1["id"].'</option>'; 
		  
	  }
  echo $output;
}