<!DOCTYPE html>

<html>
    <head>
        <title>:: Dhanekula COO Feedback Report ::</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
		  .ovr{
			  overflow-x: scroll;
			  
		  }
		</style>

    </head>
    <body bgcolor="#ffffff">
	  <?php
			session_start();
			ob_start();
			$reg = $_SESSION['reg'];
			$year = $_SESSION['year'];
			$batch = $_SESSION['batch'];
			$dept = $_SESSION['dept'];
			$sem = $_SESSION['sem'];
						
			$connect = mysqli_connect("localhost","root","","COO") or mysqli_error();
			
			
	  ?>
	  <table>
		  <tr ><td colspan="2"><img src="diet.png" width="100%" height="60%" alt="college header"></td></tr>
		</table >
			<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Center</a>
    </div>
    <ul class="nav navbar-nav">
	 <li ><a href="mainpage.php">Home</a></li>
      <
      <li class="active"><a href="addsubjects.php">Add Subjects</a></li>
    </ul>
  </div>
</nav>
	  <center><h3> Dhanekula COO  Reports</h3></center>
	  <hr>
	  <div class="">
	    <table border="2" align="center" class="table table-bordered">
                <th>
                    <td>Year-Semester:<?php echo $year.'-'.$sem?></td>
                    <td>Dept: <?php echo $dept; ?></td>
                    <td>Batch:<?php $next_batch=$batch+4; echo $batch.'-'.$next_batch; ?> </td>
					<td>Regulation: <?php echo $reg; ?></td>
                </th>
            </table>
	  
	  <?php
		$retrieve_query = mysqli_query($connect," SELECT code,name FROM subjects WHERE regulation='$reg' AND year=$year AND sem=$sem AND dept='$dept'") or mysqli_error();
	    $count = mysqli_num_rows($retrieve_query);
		$i=0;
		while($i<$count){
			$row = mysqli_fetch_array($retrieve_query);
			$code[$i] = $row['code'];
			$i = $i+1;
		}
	  ?>
	    <div class="ovr">
	  	   <table border="2" align="center" id="headerTable" class="table table-bordered">
		    <tr>
			  <th>Regd No</th>
			  <?php
			  $i=0;
				while($i<$count){
					$coquery = mysqli_query($connect,"SELECT co FROM course_outcome WHERE code='$code[$i]' and dept='$dept' and REG = '$reg'") or mysqli_error();
					while($row1 = mysqli_fetch_array($coquery)){
					 	
					
					?>
			     
			  <th><?php echo $code[$i].'.'.$row1['co'];?></th><?php
					}
					$i = $i+1;
				}?>
		    </tr>
			 
			  <?php
			  
			  $rollquery = mysqli_query($connect, "SELECT DISTINCT(rollno) FROM coo_reports WHERE year=$year AND sem=$sem AND batch='$batch' AND dept='$dept'") or mysqli_error();
			  $x=0;
			  while($x < mysqli_num_rows($rollquery)){
				  $roll = mysqli_fetch_array($rollquery);
				  $rno = $roll['rollno'];?>
			  <tr><td><?php echo $rno;
					 ?> </td><?php
			  
			  $i=0;
			  
				while($i<$count){?>
				<?php
					$query3 = mysqli_query($connect,"SELECT * FROM coo_reports WHERE year=$year AND sem=$sem AND batch='$batch' AND dept='$dept' AND code='$code[$i]' AND rollno='$rno' ") or mysqli_error();
					$row2 = mysqli_fetch_array($query3);
					
					
					while($row2){
					 	$j=7;
						while($j<13){
							if($row2[$j] != NULL){
							?>
			     
							<td><?php echo $row2[$j]; }?> </td><?php
						$j = $j+1;
						}
					$row2 = mysqli_fetch_array($query3);
					}
					$i = $i+1;
				}
					$x = $x+1;
				}
				?>
		    </tr>
		   
		   </table>
		   </div>
		</div>
		   <button onclick="fnExcelReport()" name="excelbtn" class="btn btn-link">export to excel</button>
		<script>
		function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('headerTable'); // id of table

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