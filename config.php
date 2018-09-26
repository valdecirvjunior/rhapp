<?php
$con = mysqli_connect('localhost','root','');
$db = mysqli_select_db($con,'rhapp');
	
if(!$con || !$db)
{
	echo "<pre>";
	echo mysqli_error($con);
	echo "</pre>";
} else {
	echo "<pre>";
	echo "Banco ok!";
	echo "</pre>";
}
?>