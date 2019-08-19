<?php
//include auth.php file on all secure pages
include("auth.php");
?><!DOCTYPE html>
<html>
<head>
<title>student page</title>
<base target="main">
</head>
<body>
<h1 align="center">welcome user</h1>
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<form>
<table border="0" cellpadding="20" cellspacing="50" style="border-collapse:collapse"width="100%">
<tr>
<td width="40%"><font face="arial black">u r logged in on </font></td>
<td width="72%"><font face="arial black"><p id="demo"></p>
<script>
document.getElementById("demo").innerHTML = Date();
</script></font></td></tr>
</table>
</form>
</body>
</html>