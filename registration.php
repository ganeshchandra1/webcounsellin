<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
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
input[type=email]{
width:20%;
padding:12px 20px;
margin: 8px 0;
box-sizzing:border-box;
}
input[type=email]
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
</style>
<body>
<?php
require('db.php');
if (isset($_REQUEST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1 align:"center">Registration</h1>

<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd0WpJdj9UYkrBgG9lbPMeNgI0yjW3aTMpwLJqWO_a0I-29_UyqA" style="width:190px; height:190px; position:absolute; top:180px; right:750px;"/>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>
