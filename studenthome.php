<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<html>
<head>
<title>studentpage</title>
</head>
<frameset cols="350,*">
<frame name="contents" target="main" src="studenthomeleft.php">
<frame name="main" src="studenthomeright.php">
<noframes>
<body>
<p>hi</p>
</body>
</noframes>
</frameset>
</html>