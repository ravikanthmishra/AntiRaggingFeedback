<html>
  <head>
    <title>Anti Ragging Feedback Portal</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		td,tr,table{
			padding:13px;
		}
		table{
			border: 2px solid black;
		}
		
	</style>
  </head>
  <body>
  <?php
    session_start();
	if(!isset($_SESSION['username'])){
		header("Location:index.php");
	}
  ?>
			<div class="container-fluid">
	<center><table style="border:none">
		  <tr ><td colspan="2"><img src="diet.png" width="100%" height="60%" alt="college header"></td></tr>
		</table ></center>
		<nav class="navbar navbar-inverse">
  
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Center</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="mainpage.php">Reports</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
	<div class="container-fluid"><br>
		<h3 align="center" style="font-family:Lucida Bright;letter-spacing:3px; font-size:30px;">Anti Ragging Feedback Report Portal</h3>
		<div class="col-sm-3"></div>
		 <div class="col-sm-5 ">
		 
		<form action="" method="POST">
		<table border="0" align="center"  cellpadding="6" class="">
			
			<tr><td align="center" style="font-family:BatmanForeverAlternate">Academic Year</td>
				<td align="center">:</td>
				<td><select class="form-control" name='accyear' required>
						  <option value="2018-19">2018-19</option>
						 <select></td></tr>
			<tr><td align="center" style="font-family:BatmanForeverAlternate">Branch</td>
				<td align="center">:</td>
				<td><select class="form-control" name='branch' required>
						  <option value="">Select</option>
						  <option value="ce">CE</option>
						  <option value="eee">EEE</option>
						  <option value="me">ME</option>						  
						  <option value="ece">ECE</option>
						  <option value="cse">CSE</option>
					</select></td></tr>
			<tr><td align="center" style="font-family:BatmanForeverAlternate">Year</td>
				<td align="center">:</td>
				<td><select class="form-control" name='year' required>
						  <option value="1">1</option>
					</select></td></tr>
			<tr><td align="center" style="font-family:BatmanForeverAlternate">Semester</td>
				<td align="center">:</td>
				<td><select class="form-control" name='sem' required>
						  <option value="1">1</option>
					</select></td></tr>	
			<tr><td colspan="3" align="center"><input type="submit" class="btn btn-success" value="submit" name="submit"/></td></tr>
		</table>
		</form>
		
		</div>

		
		<?php
		if(isset($_POST['submit']))
		{
			
			$accyear = $_POST['accyear'];
			$branch = $_POST['branch'];
			$year = $_POST['year'];
			$sem = $_POST['sem'];
			
			  
		    $connect = mysqli_connect("localhost","root","","arc");
			
			
			$_SESSION['accyear'] = $accyear;
			$_SESSION['branch'] = $branch;
			$_SESSION['year'] = $year;
			$_SESSION['sem'] = $sem;
				
			$query1 = mysqli_query($connect,"SELECT count(*) FROM arc_report WHERE year=$year AND sem=$sem and branch='$branch' AND accyear='$accyear'") or mysqli_error($connect);
			$row = mysqli_fetch_array($query1);
			if($row[0] != 0)
			{			
				header("Location:arcReport1.php");
			}
			else
			{
			    ?>
				<br>
				<div class="col-md-6 col-md-offset-3">
				<div class="alert alert-danger">
					<a class="close" data-dismiss="alert" href="#">×</a>Reports not available for given details
				</div></div><?php
			}
		}
		else
		{
			//echo "enter valid regulation and batch details";
		}
		
				
		?>
  </div>
 
  </body>
</html>