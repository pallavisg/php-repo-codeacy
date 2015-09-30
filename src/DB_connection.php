<?php
include ("..\conf\config.php");
//exit;
class DB_connection
{
	function __construct() {
      $con = mysql_connect(config::HOST,config::USER,config::PASSWORD) or die("failed to establish connection....!");
	  mysql_select_db(config::DATABASE);
	}
	//records insertion functionality
	function insert($tablename, $key, $val){
	
	$sql= "INSERT INTO $tablename ($key[0],$key[1],$key[2],$key[3],$key[4]) VALUES ($val[0], $val[1], $val[2], $val[3],$val[4]);";
   
       mysql_query($sql);
	   echo mysql_insert_id();    //shows last inserted id
	
	          echo "<script>alert('Information Added successfully!')</script>";
	          echo "<script> window.location.href = 'list.php' </script>"; 
    }
	
	//normal database display without sorting
	function select($tablename){
	$key=array("name", "age", "occupation", "address","Path");
		$sql="SELECT * FROM $tablename";
		$res = mysql_query($sql);
		
		if($res !== FALSE){
			return $res;
		}
		return false;
	}
	
	//sorting functionality by name/age/occupation/address
	function selectOnSort($tablename,$sort){
	
		$sql="SELECT * FROM $tablename order by $sort";
		$res = mysql_query($sql);
		
		if($res !== FALSE){
			return $res;
		}
		return false;
	}
	
	//functionality for displaying records based on id fetched
	function selectWhere($tablename,$id){
		$sql="SELECT name,age,occupation,address,Path FROM $tablename where id=$id";
		$res = mysql_query($sql);
		
		if($res !== FALSE){
			return $res;
		}
		return false;

	}
	//records editing functionality
	function update($tablename,$kv)
	{
	$key=array("name", "age", "occupation", "address","Path");
	$sql="UPDATE $tablename SET $key[0]='$kv[P_name]', $key[1]=$kv[P_age], $key[2]='$kv[P_occup]', $key[3]='$kv[P_addr]',$key[4]='$kv[fileToUpload]' WHERE id=$kv[modify]";
			$upd = mysql_query($sql);
			 if($upd !== FALSE)
	          {
	          return TRUE;
	           }
	              else
	               {
	               return FALSE;
	               }
			
}

   //remove records functionality
    function delete($tablename,$id)
    {
    $id=$_GET['id'];
    $sql4 = "DELETE FROM $tablename WHERE id=$id";
    $del = mysql_query($sql4);
       if($del !== FALSE)
	   {
	    return TRUE;
	   }
	    else
	    {
	     return FALSE;
	    }
    }
}
?>



