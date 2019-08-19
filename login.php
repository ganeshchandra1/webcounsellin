<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<style>
form{
text-align:center;
}
input[type=text]{
width:20%;
padding:12px 20px;
margin: 8px 0;
box-sizzing:border-box;
}
input[type=text]
{
border:2px solid green;
border-radius:4px;

}
input[type=password]{
width:20%;
padding:12px 20px;
margin: 8px 0;
box-sizzing:border-box;

}
input[type=password]
{
border:2px solid green;
border-radius:4px;

}


input[type=submit]
{
background-color:green;
border:none;
color:white;
margin-top:1px;
margin-bottom:1px;
margin-right:1px;
margin-left:1px;
position :absolute;
bottom:18%;
right:780px;
width:12%;
height:7%;
border-radius:4px;
font-size:25px;
}
body
{
color:green;
font-style:normal;
font-size:25px;
}
body,html{
height:100%;
margin:0;
}

form{
padding-top:350px;
padding-right:350px;

} 
#p
{
	right:40px;
}
</style>
<body>
<?php
require('db.php');
session_start();
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
     $query = "SELECT * FROM `users` WHERE username='$username'
    and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: studenthome.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else {
?>
<div class="form">
<h1 align:"center">LOGIN</h1>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd0WpJdj9UYkrBgG9lbPMeNgI0yjW3aTMpwLJqWO_a0I-29_UyqA" style="width:190px; height:190px; position:absolute; top:180px; right:750px;"/>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p style="position:absolute;right:285px;bottom:180px">Not registered yet? <a style="color:green" href='registration.php'>Register Here</a></p>
</div>
<?php } ?>
</body>
</html>
