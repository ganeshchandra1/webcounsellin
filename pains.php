<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include("connect-db.php");

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($first = '', $last ='', $mat='', $o = '', $m ='',$c = '', $ol ='',$ml = '', $cl ='' , $error = '', $id = '')
{ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>
<?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>

<strong>First Name: *</strong> <input type="text" name="firstname"
value="<?php echo $first; ?>"/><br/>
<strong>Last Name: *</strong> <input type="text" name="lastname"
value="<?php echo $last; ?>"/>
<strong>maths: *</strong> <input type="text" name="maths"
value="<?php echo $mat; ?>"/>
<strong>os: *</strong> <input type="text" name="os"
value="<?php echo $o; ?>"/><br/>
<strong>mpc: *</strong> <input type="text" name="mpc"
value="<?php echo $m; ?>"/><br/>
<strong>cn: *</strong> <input type="text" name="cn"
value="<?php echo $c; ?>"/><br/>
<strong>communication: *</strong> <input type="text" name="communication"
value="<?php echo $ol; ?>"/><br/>
<strong>extracurriculars: *</strong> <input type="text" name="extracurriculars"
value="<?php echo $ml; ?>"/><br/>
<strong>socialbehaviour: *</strong> <input type="text" name="socialbehaviour"
value="<?php echo $cl; ?>"/><br/>
<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
$lastname = htmlentities($_POST['lastname'], ENT_QUOTES);
$maths = htmlentities($_POST['maths'], ENT_QUOTES);
$os = htmlentities($_POST['os'], ENT_QUOTES);
$mpc = htmlentities($_POST['mpc'], ENT_QUOTES);
$cn = htmlentities($_POST['cn'], ENT_QUOTES);
$communication = htmlentities($_POST['communication'], ENT_QUOTES);
$extracurriculars = htmlentities($_POST['extracurriculars'], ENT_QUOTES);
$socialbehaviour = htmlentities($_POST['socialbehaviour'], ENT_QUOTES);

// check that firstname and lastname are both not empty
if ($firstname == '' || $lastname == '' || $maths == '' || $os == '' || $mpc == '' || $cn == '' || $communication == '' || $extracurriculars == '' || $socialbehaviour == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($firstname, $lastname, $maths,$os, $mpc, $cn, $communication, $extracurriculars, $socialbehaviour, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("UPDATE parentsfeed SET firstname = ?, lastname = ?, maths = ?,os = ?, mpc = ?, cn = ?, communication = ?, extracurriculars = ?, socialbehaviour = ?
WHERE id=?"))
{
$stmt->bind_param("sssssssssi", $firstname, $lastname, $maths,$os, $mpc, $cn, $communication, $extracurriculars, $socialbehaviour, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: pafeed.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $mysqli->prepare("SELECT * FROM parentsfeed WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname, $maths, $os, $mpc, $cn, $communication, $extracurriculars, $socialbehaviour);
$stmt->fetch();

// show the form
renderForm($firstname, $lastname, $maths, $os, $mpc, $cn, $communication, $extracurriculars, $socialbehaviour, NULL, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
header("Location: pafeed.php");
}
}
}



/*

NEW RECORD

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
else
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
$lastname = htmlentities($_POST['lastname'], ENT_QUOTES);
$maths = htmlentities($_POST['maths'], ENT_QUOTES);
$os = htmlentities($_POST['os'], ENT_QUOTES);
$mpc = htmlentities($_POST['mpc'], ENT_QUOTES);
$cn = htmlentities($_POST['cn'], ENT_QUOTES);
$communication = htmlentities($_POST['communication'], ENT_QUOTES);
$extracurriculars = htmlentities($_POST['extracurriculars'], ENT_QUOTES);
$socialbehaviour = htmlentities($_POST['socialbehaviour'], ENT_QUOTES);

// check that firstname and lastname are both not empty
if ($firstname == '' || $lastname == '' || $maths== '' || $os == '' || $mpc == '' || $cn == '' || $communication == '' || $extracurriculars == '' || $socialbehaviour == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($firstname, $lastname, $maths,$os, $mpc, $cn, $communication, $extracurriculars, $socialbehaviour, $error);
}
else
{
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT parentsfeed (firstname, lastname,maths,os, mpc, cn, communication, extracurriculars, socialbehaviour) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("sssssssss", $firstname, $lastname, $maths,$os, $mpc, $cn, $communication, $extracurriculars, $socialbehaviour);
$stmt->execute();
$stmt->close();
}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
header("Location: pafeed.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
}
}

// close the mysqli connection
$mysqli->close();
?>