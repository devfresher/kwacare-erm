<?php

$to 		= 'demo@gmail.com';
$headers	= 'FROM: "'.$email.'"';

//All form values
$uname 		= $_POST['uname'];
$uemail 	= $_POST['uemail'];
$unumber 	= $_POST['unumber'];
$udate 		= $_POST['udate'];
$department = $_POST['udepartment'];
$udoctor 	= $_POST['udoctor'];
$umsg 		= $_POST['umsg'];
$output 	= "\n
				Name: ".$uname."\n
			  	Email: ".$uemail."\n
			  	Number: ".$unumber."\n
			  	Date: ".$udate."\n
			  	Department: ".$department."\n
			  	Doctor: ".$udoctor."\n
			  	Message: ".$umsg;

$send		= mail($to, $name, $output, $headers);