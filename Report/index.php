<html>
<head>
  <title> Anti Ragging Feedback Login </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body{
    background-image: url("login1.jpg") ;
	background-repeat:no-repeat;
    background-color: #444;

}

.vertical-offset-100{
    padding-top:100px;
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
 if(isset($_POST['login'])){
  $username =$_POST['username'];
  $password = $_POST['password'];
  if($username && $password){
    $conn = mysqli_connect("localhost","root","","arc") or die("connection failed");
	
	$query = mysqli_query($conn,"select * from login where username = '$username'") or mysqli_error($conn);
	$rows = mysqli_num_rows($query);
	 if( $rows > 0){
		$query1 = mysqli_query($conn,"select * from login where username = '$username' and password = '$password' ");

                           if(mysqli_num_rows($query1) > 0){
                              while( $row = mysqli_fetch_assoc($query1)){
                               $username = $row['username'];
							   $usertype = $row['usertype'];
							  }
							 if($usertype == 1){
								   session_start();
								   $_SESSION["username"] = $username;
								   $_SESSION["usertype"] = $usertype;
								   header("location:mainpage.php");
							   }
}
else{
	 ?>
	 <div class="col-md-6 col-md-offset-3">
	 <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
            </div></div><?php
}

}
else{
	 ?>
	 <div class="col-md-6 col-md-offset-3">
	 <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
            </div></div><?php
}
     
}
 
 }
?>
<div class="container-fluid" style="margin-top:70px;">
<div style="background-color:#FFFFFF; background-color:rgb(204, 230, 220)" class="col-md-6 col-md-offset-3">
 <h3>Dhanekula Anti Ragging Feedback Portal Login</h3><hr>
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Sign in </strong></h3>
     
  </div>
  
  <div class="panel-body">
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  
  <div style="margin-bottom: 12px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input style="text-transform : uppercase" id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
                                    </div>
                                
                            <div style="margin-bottom: 12px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    
  <button type="submit" name="login" class="btn btn-success" >Login</button>
  
  <hr style="margin-top:10px;margin-bottom:10px;" >
</form>
  </div>
</div>
</div>
</div>
 
</body>
</html>