<?
session_start();
$db=mysqli_connect("localhost","root","pass","authentication");
if(isset($_POST[register_btn])){
session_start();
$username=mysql_real_escape_string($_POST['username']);
$email=mysql_real_escape_string($_POST['email']);
$password=mysql_real_escape_string($_POST['password']);
$password2=mysql_real_escape_string($_POST['password2']);
  if($password==$password2){
  $password=md5($password);
  $sql="INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
  mysqli_query($db,$sql);
  $_SESSION['message']="you are now logged in";
$_SESSION['username']=$username;
header("location: home.php");
  }
  else
  {
  $_SESSION['message']="the two passwords donot match";
  }
?>
<html>
<head>
<title>user authentication</title>
</head>
<body>
<div class="header">
<h1>reg,login,logout</h1>
</div>
<form method="post" acion="register.php">
<table>
<tr>
<td>Username:</td>
<td><input type="text" name="username" class="textuser"></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="email" name="email" class="textuser"></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name="password" class="textuser"></td>
</tr>
<tr>
<td>Confirm Passwod:</td>
<td><input type="password" name="password2" class="textuser"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="register_btn" value="register"></td>
</tr>
</table>
</form>
</body>
</html>