<?php
include "cxn.php";
session_start();
$email = $_SESSION['email_ses'];
$role = $_SESSION['role_ses'];

if (isset($_POST["upload"]))
{
		$name = $_FILES["file"]["name"];
		$type = $_FILES["file"]["type"];
		$size = $_FILES["file"]["size"];
		$tmp_name = $_FILES["file"]["tmp_name"];
		$error = $_FILES["file"]["error"];
		$cid = $_POST['cid'];
		$cid=stripcslashes($cid);
		$fname = $_POST['fname'];
		
		if ($type== "application/msword" || $type== "text/html" || $type== "application/zip" || $type== "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $type== "application/vnd.ms-excel" || $type== "application/vnd.ms-powerpoint" || $type== "image/jpeg" || $type== "image/png" || $type== "image/gif" || $type== "image/plain" || $type== "application/pdf" ||$type== "application/x-pdf" || $type== "application/acrobat" || $type== "application/vnd.pdf" )
		{
			if($error > 0)
			{
	//			echo "Error!".$error;
				header("location: instructor_course.phpc=$cid&resources");
			}
			else
			{  
				$location = "upload/".$name;
				
				if (file_exists("upload/".$name))
				{
					//echo $name." already exists";
					unlink($location);
				}
				
				move_uploaded_file($tmp_name,$location);
				
				$sqlcode = mysql_query("INSERT INTO resources (cid,location,name) VALUES ('$cid','$location','$fname') ");
	
			//	echo "<a href='$location'>Click here to view the file.</a>";
			
			
				header("location:instructor_course.php?c=$cid&resources");
				
			}
		}
	
		else
		{
			//echo "Error1";	
			header("location:instructor_course.php?c=$cid&resources");
		}
	
	
	}
else
{
	echo "<a href='instructor_course.php?c=$cid&resources'>";
//echo "Error2";
}
?>