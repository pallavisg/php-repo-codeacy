<?php
include 'Employee.php';

$emp = new Employee(); 
$row = $emp->index();
//initiate deletion procedure
if($_POST){
if($_POST['delete']){

  $i = 0;
  while(list($key, $val) = each($_POST['checkbox'])) {
    $sql = "DELETE FROM $tbl_name WHERE id='$val'";
    mysql_query($sql);
    $i += mysql_affected_rows();
  }

  // if successful redirect to delete_multiple.php
  if($i > 0){
    echo '<meta http-equiv="refresh" content="0;URL=delete_multiple.php">';
  }
}
}


if($_GET){
if(isset($_GET['opt'])){

if($_GET['opt'] == 'delete'){
	$id=$_GET['id'];
		$emp->remove($id);
		if(TRUE)
		{
		echo "<script> window.location.href = 'list.php' </script>"; 
		}
		else
		{
		echo "Item deletion failure!";
		}
	}

}
if(isset($_GET['sort'])){
	$onSort = $_GET['sort'];
	$emp = new Employee(); 
	$row = $emp->index($onSort);
}
}

?>
<html>
<head><h1>User List PAGE</h1>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){

$('input[id="checkbox"]').click(function(){
	if($(this).prop("checked") == true){
		$("input[id^='checkbox_']").prop("checked", true);
	}
	else if($(this).prop("checked") == false){
		$("input[id^='checkbox_']").prop("checked", false);
	}
	
});
  
});
</script>
</head>
<body>
<table>
<tr>
<td><input name="checkbox" type="checkbox" id="checkbox"></td>
<td><a href="list.php?sort=name">Name</a></td>
<td><a href="list.php?sort=age">Age</a></td>
<td><a href="list.php?sort=occupation">Occupation</a></td>
<td><a href="list.php?sort=address">Address</a></td>
<td>Image</td>
<td>Action</td>
<td>Action</td>
</tr>

<?php foreach($row as $result){
?>
	<tr>
	<td><input name="checkbox" type="checkbox" id="<?php echo 'checkbox_'.$result['id'];?>" class= "check" value="<?php echo $result['id']; ?>"></td>
	<td><?php echo $result['name']?></td>
	<td><?php echo $result['age']?></td>
	<td><?php echo $result['occupation']?></td>
	<td><?php echo $result['address']?></td>
	<td><?php echo "<img src='".$result['Path']."' width='300' height='150' id='image'/>"; ?></td>
	<td><?php 
	echo '<a href="emp_edit.php?opt=edit&id=' . $result['id'] . '">Edit_record/</a>'
	?></td>
	<td><?php 
	echo '<a href="list.php?opt=delete&id=' . $result['id'] . '">Remove_record/</a>'
	?></td>
	
	
	</tr>
	
<?php } ?>
</table>

<a href = "emp.php">Add_record</a>


</body>
</html>