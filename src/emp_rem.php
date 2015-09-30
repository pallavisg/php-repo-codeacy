<?php
include 'Employee.php';
$id=$_GET['id'];
$emp_remv= new Employee(); 
$emp_remv->remove();


?>
		