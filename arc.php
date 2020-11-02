<html>
    <head>
        <title>:: Dhanekula Feedback System ::</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		body{
			background-color: #f4f8ed;
		}
		</style>
        
		 <SCRIPT type='text/javascript'>
 // SCRIPT TO STOP NAVIGATING PREVIOUS PAGE
window.history.forward();
    function noBack() {window.history.forward(); }
window.onload='noBack()';
window.onpageshow=function(evt){if(evt.persisted)noBack()}
window.onunload=function(){void(0)}

</script>
    </head>
    <body>
	  <?php
			session_start();
			ob_start();
			$accyear = $_SESSION['accyear'];
			$branch = strtoupper($_SESSION['branch']);
			echo $branch;
			$year = $_SESSION['year'];
			$sem = $_SESSION['sem'];
			$sec = $_SESSION['sec'];
			$rollno = $_SESSION['rollno'];	
			
			
			$connect = mysqli_connect("localhost","root","","arc") or mysqli_error();
			
	  ?>
		<div class="container-fluid">
        <h3 align="center" style="font-family:Cooper;letter-spacing:3px" > <u> DHANEKULA ANTI RAGGING ONLINE FEEDBACK SYSTEM </u> </h3>
		
		<form action="" method="POST">
		<table border="2" align="center" style="border-collapse:collapse;">
                <tr>
                    <td>Academic Year:<?php echo '<b style = "font-family:Elephant" align="center">'.$accyear.'</b>' ?>
					</td>
				</tr>
				<tr>
                    <td>Roll NO: <?php echo '<b style = "font-family:Elephant" align="center">'.$rollno.'</b>'?></td>
				</tr>
				<tr>
                    <td>Name of the Student:<?php 
					
						$q1="SELECT name FROM student WHERE rollno='$rollno'";
						//echo $q1;
						$name='';
						$studentname = mysqli_query($connect,$q1) or die(mysqli_error($connect));
						if($row1 = mysqli_fetch_array($studentname)){
							$name=$row1['name'];
						echo '<b style = "font-family:Elephant" align="center">'.$name.'</b>'; 
		  
			} ?> </td>
				</tr>
				
				<tr>
					<td> Branch: <?php
						if($branch == 'CSE'){
							echo "hello".'<b style = "font-family:Elephant" align="center">DEPARTMENT OF COMPUTER SCIENCE & ENGINEERING</b> ' ;
						}
						else if($branch == 'CE'){
							echo '<b style = "font-family:Comic Sans MS"  align="center">DEPARTMENT OF CIVIL ENGINEERING</b> ' ;
						}
						else if($branch == 'IT'){
							echo '<b style = "font-family:Comic Sans MS"  align="center">DEPARTMENT OF INFORMATION TECHNOLOGY</b> ' ;
						}
						else if($branch =='ME'){
							echo '<b style = "font-family:Comic Sans MS" align="center">DEPARTMENT OF MECHANICAL ENGINEERING</b> ' ;
						}
						else if ($branch == 'ECE'){
							echo '<b style = "font-family:Comic Sans MS" align="center">DEPARTMENT OF ELECTRONICS COMMUNICATION AND ENGINEERING</b> ' ;
						}
						else if($branch == 'EEE'){
							echo '<b  style = "font-family:Comic Sans MS" align="center">DEPARTMENT OF ELECTRICAL AND ELECTRONICS ENGINEERING</b> ' ;
						}
						?>
				</tr>
				<tr>
					<td>Year-Semester:<?php echo '<b style = "font-family:Elephant" align="center">'.$year.' B.Tech - '.$sem.' sem</b>'?></td>
				</tr>
				<tr>
                    <td>Type of Student:
					<select name="studenttype" required>
							<option value="">select</option>
                            <option value="Hostler">Hostler</option>
                            <option value="DayScholar">DayScholar</option>
                            </select></td>
				</tr>
               <tr>
					<td>
							<p style="position:relative;align="left">Do you face any problems with seniors if so give details. Comments only on Ragging.</p>
							<textarea rows=5 cols=100 name="comments" required/>
							</textarea>
					</td>
			   </tr>
					<td>
							<p style="position:relative;align="left">Did you observed any ragging activity in the campus or outside the Campus? if <b>YES</b>, please provide details.</p>
							<textarea rows=5 cols=100 name="observation"/>
							</textarea>
					</td>
			   <tr>
					<td>
							<p style="position:relative;align="left">Suggestions if any for providing Ragging Free Campus</p>
							<textarea rows=5 cols=100 name="suggestions"/>
							</textarea>
					</td>
			   </tr>
			 </table>
            <br>
            
 
                      <center>  <input class="btn btn-primary" type="submit"  value="Submit" name="arc_submit"/></center>
   
        </form>
		
		</div>
		<?php
		  if(isset($_POST['arc_submit'])){
			$studenttype=$_POST['studenttype'];
			$comments = $_POST['comments'];
			$observation = $_POST['observation'];
			$suggestions = $_POST['suggestions'];
			$q11= "replace INTO arc_report VALUES(CURDATE(),'$accyear','$name','$rollno','$branch',$year,$sem,'$sec','$studenttype','$comments','$observation','$suggestions')";
			echo $q11;
			$insertquery = mysqli_query($connect,$q11) or die(mysqli_error($connect));
			header("Location:success.php");
		  }
			 
		?>
		<footer>
		   <div class="footer-copyright" style="background-color:#459; padding:0.1%;color:white"><center><p> Developed by Department of CSE</p></center></div>
		</footer>
    </body>
</html>
