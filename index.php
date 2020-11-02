<html>
  <head>
    <title>Anti Ragging Online Feedback Portal</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	  tr,td,table{
		  padding: 10px;
	  }
	  body{
		  background-color: 	rgb(204, 230, 255);
	  }
	  h1{
		  font-family: "Canterbury","serif";
		  color: black;
		  letter-spacing: 3px;
		  font-size: 55px;;
	  }
	td{
		font-family; "BatmanForeverAlternate";
	}
	</style>
  </head>
  <body>
    <body>	<br>
		<h1 align="center">Dhanekula Anti Ragging Online Feedback Portal</h1><br><br>
		<div class="container">
		<div class="col-sm-7">
		 <img src="1.jpg" alt="feedback img" style="width:100%;height:90%;margin-top:-60px;">
	</div>
		 <div class="col-sm-5 ">
		<form action="" method="POST" autocomplete="off">
		<table border="0" align="center"  cellpadding="6" class="table">
			
			<tr><td align="center">Academic Year</td>
				<td align="center">:</td>
				<td><select class="form-control" name='accyear' id="accyear" required>
						 <option value="2019-20">2019-20</option>
						 </select></td></tr>
			<tr><td align="center">Branch</td>
				<td align="center">:</td>
				<td><select class="form-control" name='branch' id="branch" required>
						<option value="">Select</option>
						  <option value="ce">CE</option>
						  <option value="eee">EEE</option>
						  <option value="me">ME</option>						  
						  <option value="ece">ECE</option>
						  <option value="cse">CSE</option>
						   <option value="IT">IT</option>
					</select></td></tr>
					</select></td></tr>
			<tr><td align="center">Year</td>
				<td align="center">:</td>
				<td><select class="form-control" name='year' required>
						 <option value="1">1</option>
						 </select></td></tr>
			<tr><td align="center">Semester</td>
				<td align="center">:</td>
				<td><select class="form-control" name='sem' required>
						<option value="1">1</option>
						</select></td></tr>	
			<tr><td align="center">Section</td>
				<td align="center">:</td>
				<td><select class="form-control" name='sec' id="sec" required>
						<option value="">Select</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					</select></td></tr>	
			<tr><td align="center">Roll No:</td>
				<td align="center">:</td>
				<td><select name="rollno" id="rollno" class="form-control" required >
					</select>
				</td></tr>
			
			<tr><td colspan="3" align="center"><input type="submit" class="btn btn-success" value="submit" name="submit"/></td></tr>
		</table>
		</form>
		</div>
		</div>
		
		<?php
		if(isset($_POST['submit']))
		{
			session_start();
			$accyear = $_POST['accyear'];
			$branch = $_POST['branch'];
			$year = $_POST['year'];
			$sem = $_POST['sem'];
			$sec = $_POST['sec'];
			$rollno = strtoupper($_POST['rollno']);	
				
						
			$_SESSION['accyear'] = $accyear;
			$_SESSION['branch'] = $branch;
			$_SESSION['year'] = $year;
			$_SESSION['sem'] = $sem;
			$_SESSION['sec'] = $sec;
			$_SESSION['rollno'] = $rollno;
			header("Location:arc.php");
		}
		
		if(isset($_POST['accyear']) && isset($_POST['branch']) && isset($_POST['sec'])){
			$branch = $_POST['branch'];
			$accyear=$_POST['accyear'];
			$sec = $_POST['sec'];
			
			$connect = mysqli_connect("localhost","root","","arc") or mysqli_error();
			
			$output = '';
			$q1="SELECT rollno FROM student WHERE branch='$branch' and sec='$sec' and accyear='$accyear'";
			echo $q1;
			$studentlist = mysqli_query($connect,$q1) or die(mysqli_error($connect));

			$output = '<option value=""> Select Id</option>';
			while($row1 = mysqli_fetch_array($studentlist)){
					$output.= '<option value="'.$row1['rollno'].'">'.$row1['rollno'].'</option>'; 
		  
			}
			echo $output;
			
		}
		
		?>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   <script type="text/javascript">
   
   
  $(document).ready(function(){
	$('#accyear,#branch,#sec').on('change',function(){
		var accyear = document.getElementById("accyear").value;
		var branch = document.getElementById("branch").value;
		var sec = document.getElementById("sec").value;
		
	if(accyear != '' && branch != '' && sec != ''){
			
		$.ajax({
			url : "",
			method : "POST",
			data : {accyear:accyear,branch:branch,sec:sec},
			dataType : "text",
			success : function(data){
				$("#rollno").html(data);
			}
		});
		}
		
	});
});
</script>
  </body>
 
</html>