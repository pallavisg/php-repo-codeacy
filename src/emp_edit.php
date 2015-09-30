<?php
 include 'Employee.php';

 //fetching values in form for editing record
$opt= '';
if($_GET){
if(isset($_GET['opt'])){
$opt= $_GET['opt'];
}
if($opt == 'edit'){
		$id = $_GET['id'];
		$emp = new Employee(); 
		$result = $emp->showEmployee($id);
		if($result == false){echo "no entry present";exit;//or redirect user to listing page
		}

}
		 

}
//editing functionality initiating
if($_POST){
 if($_POST['modify'])
 {
 $emp = new Employee(); 
 $kv = array();
  foreach ($_POST as $key => $value) {
    $kv[$key] = $value;
	}
	
 $kv1 = $emp -> edit($kv);
 if($kv1 = TRUE)
		{
		echo "<script> window.location.href = 'list.php' </script>"; 
		}
		else
		{
		echo "Error!";
		}
 
 }
} 
	
   ?>
   
   
   <html>
<head>
</head>


<body  style="background-image:url(prod.JPG);background-size: 95%" >

<form name="employee-record" method="post" action="emp_edit.php?id='<?php echo $id; ?>'" >
	<center><h1>Update Information </h1></center>
<br><br><br><br><br><br><br><br><br><br>
	<center>Employee-Name: <input type="text" id= "P_name" name="P_name" value = "<?php if(isset($result[0])){echo $result[0];}?>"></center><br>
	
	<center>Employee-Age: <input type="text" id= "P_age" name="P_age" value = "<?php if(isset($result[0])){echo $result[1];}?>"></center><br>
	
	<center>Employee-Occupation: <input type="text" id= "P_occup" name="P_occup" value = "<?php if(isset($result[0])){echo $result[2];}?>"></center><br>
	
	<center>Employee-Address: <input type="text" id= "P_addr" name="P_addr" value = "<?php if(isset($result[0])){echo $result[3];}?>"></center><br>
	
	<center>Employee-image: <input type="file" id= "fileToUpload" name="fileToUpload" value = "<?php if(isset($result[0])){echo $result[4];}?>"></center><br>
<!-- creating a hidden input tag and give value of id -->
	<input id = "modify" name = "modify" type = "hidden" value = "<?php echo $id; ?>"></center>
	
	
	<center><input type="submit" name="submit" value="Save changes"></center>
	
	
	
</form>

</body>
</html>