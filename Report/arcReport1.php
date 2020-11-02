<!DOCTYPE html>

<html>
    <head>
        <title>:: Dhanekula Anti Ragging Feedback Report ::</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
		  .ovr{
			  overflow-y: scroll;
			  height: 300px;
			  
		  }
		  body{
			
		}
		</style>

    </head>
    <body>
	  <?php
			session_start();
			ob_start();
			$accyear = $_SESSION['accyear'];
			$year = $_SESSION['year'];
			$branch = $_SESSION['branch'];
			$sem = $_SESSION['sem'];
			$studenttype=$_SESSION['studenttype'];
			
						
			$connect = mysqli_connect("localhost","root","","arc") or mysqli_error($connect);
			
			if(!isset($_SESSION['username'])){
				header("Location:index.php");
			}
			else if(!isset($_SESSION['year'])){
				header("Location:mainpage.php");
			}
			
			
	  ?>
	  <center><table style="border:none">
		  <tr ><td colspan="2"><img src="diet.png" width="100%" height="60%" alt="college header"></td></tr>
		</table ></center>
		<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Center</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="mainpage.php">MainPage</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
	  <center><h3 style="font-family:Stencil;letter-spacing:3px"> Dhanekula Anti Ragging Feedback Reports</h3></center>
	
	  <hr>
	  <div class="container">
	    <table border="2" align="center" class="table table-bordered">
                <th>
					<td><b>Batch:<?php echo $accyear ?> </b></td>
                    <td><b>Year: <?php echo $year ?></b></td>
					<td><b>Semester:<?php echo $sem ?></b></td>
                    <td><b>Branch:<?php
						if($branch == 'cse'){
							echo '<b style = "font-family:Elephant" align="center">DEPARTMENT OF COMPUTER SCIENCE & ENGINEERING</b> ' ;
						}
						else if($branch == 'ce'){
							echo '<b style = "font-family:Comic Sans MS"  align="center">DEPARTMENT OF CIVIL ENGINEERING</b> ' ;
						}
						else if($branch == 'IT'){
							echo '<b style = "font-family:Comic Sans MS"  align="center">DEPARTMENT OF INFORMATION TECHNOLOGY</b> ' ;
						}
						else if($branch =='me'){
							echo '<b style = "font-family:Comic Sans MS" align="center">DEPARTMENT OF MECHANICAL ENGINEERING</b> ' ;
						}
						else if ($branch == 'ece'){
							echo '<b style = "font-family:Comic Sans MS" align="center">DEPARTMENT OF ELECTRONICS COMMUNICATION AND ENGINEERING</b> ' ;
						}
						else if($branch == 'eee'){
							echo '<b  style = "font-family:Comic Sans MS" align="center">DEPARTMENT OF ELECTRICAL AND ELECTRONICS ENGINEERING</b> ' ;
						}
						?></b></td>
                   
					
                </th>
            </table>
	  
	  <?php
		//$retrieve_query = mysqli_query($connect," SELECT rollno FROM arc_report WHERE accyear='$accyear' AND branch='$branch' and year=$year AND sem=$sem") or die(mysqli_error($connect));
	   // $count = mysqli_num_rows($retrieve_query);
	  	$q1=mysqli_query($connect,"SELECT * FROM arc_report WHERE accyear='$accyear' AND branch='$branch' and year=$year AND sem=$sem");?>
		<div class="ovr">
		<table class="table table-striped table-bordered" id="arctable1">
			<tr><th>S.No</th>
				<th>Roll No.</th>
				<th>Name</th>
				<th>Type of Student</th>
				<th>Comments on Ragging</th>
				<th>Any Observations of Ragging</th>
				<th>Suggestions</th>
			</tr>
			
				<?php	
					$i=0;
					$query3 = mysqli_query($connect,"SELECT * FROM arc_report WHERE accyear='$accyear' AND branch='$branch' and year=$year AND sem=$sem ORDER BY rollno ASC") or mysqli_error($connect);
					while ($row=mysqli_fetch_array($query3))
    				{
						$i=$i+1;
				?>
				<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['rollno']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['studenttype']; ?></td>
				<td><?php echo $row['comments'] ?></td>
				<td><?php echo $row['observation']; ?></td>
				<td><?php echo $row['suggestions']; ?></td>
				</tr>
				<?php									
		  
					}
				?>	
				
						
			</table>
			</div>
			<button onclick='fnExcelReport("arctable1")' name="excelbtn" class="btn btn-primary">export to excel</button>
		   </div>
		  
<script>
function fnExcelReport(id)
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById(id); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
	  </body>