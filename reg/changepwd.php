<?php
session_start();

if (empty($_SESSION['login'])) {
	echo "<script type='text/javascript'>alert('Please login first to access this page');</script>";
	echo "<script type='text/javascript'> window.location.href='../index.html';</script>";
	exit();
}
?>
<html>
<body>


 <?php
$servername = getenv("mysql_hostname");
$username = getenv("mysql_username");
$password = getenv("mysql_password");
$dbname = getenv("mysql_database");


$un=$_SESSION['login'];
$op1=$_POST["oldp"];
$np1=$_POST["newp"];
$op=md5($op1);
$np=md5($np1);



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$s1="SELECT * From Individual WHERE username ='$un' AND password='$op'";
$s2="SELECT * From Orgs WHERE username ='$un' AND password='$op'";
$r1=$conn->query($s1);
$r2=$conn->query($s2);
if($r1->num_rows >0)
{
	
$a1="UPDATE Individual SET password ='$np' WHERE username ='$un' AND password='$op'";
$b1=$conn->query($a1);
$conn->close();
echo "<script type='text/javascript'>alert('Password changed successfully!');</script>";
 echo "<script type='text/javascript'> window.location.href='../login/loggedin2.php';</script>";
}
elseif($r2->num_rows >0)
{
	
$a2="UPDATE Orgs SET password ='$np' WHERE username ='$un' AND password='$op'";
$b1=$conn->query($a2);
$conn->close();
echo "<script type='text/javascript'>alert('Password changed successfully!');</script>";
 echo "<script type='text/javascript'> window.location.href='../login/loggedin2.php';</script>";
}





else {
	
	$conn->close();
    echo "<script type='text/javascript'>alert('Unsuccessful!check if your old password is right!');</script>";
 echo "<script type='text/javascript'> window.location.href='change.html';</script>";
}




?> 

</body>
</html> 
