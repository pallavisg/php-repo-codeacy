<?php
include "DB_connection.php";

class Employee{
public static $key=array("name", "age", "occupation", "address","Path");
	function __construct() {
      $db= new DB_connection();
	}
	
	//condition for sorting
	function index($sort='name'){
	  $db= new DB_connection();
	
	  $result_arr = $db->selectOnSort(config::TABLENAME,$sort);
    
		//$row = mysql_fetch_row($result_arr);
	    $array = array();
		while($row = mysql_fetch_array($result_arr))
		{
		array_push($array, $row);
		}
		return $array;
	}	
	//database selection and connection and calling selectWhere function of database class
	function showEmployee($id){
	   $db= new DB_connection();
	   return mysql_fetch_row($db->selectWhere(config::TABLENAME,$id));
	}
	
	
	
	//add records functionality and image upload functionality
	function add(){
	   $target_dir = "profile_picture//";
       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       $uploadOk = 1;
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
              if(isset($_POST["submit"])) {
                   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                   if($check !== false) {
                   echo "File is an image - " . $check["mime"] . ".";
                   $uploadOk = 1;
                 } 
				 else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                       }
                 }
      // Check if file already exists
              if (file_exists($target_file)) {
                     echo "Sorry, file already exists.";
                     $uploadOk = 0;
}

     // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
                     echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
              } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                  } else {
                          echo "Sorry, there was an error uploading your file.";
                         }
                    }			
	       
		             $key=array("name", "age", "occupation", "address","Path");
		             $val=array('"'.$_POST['P_name'].'"', '"'.$_POST['P_age'].'"', '"'.$_POST['P_occup'].'"', '"'.$_POST['P_addr'].'"','"'.$target_file.'"');
		             $db= new DB_connection();
		             $db->insert(config::TABLENAME,$key,$val);	  
		              }
		
		
	
	//database selection and connection and calling update function of database class	
	function edit($kv){
	       $db= new DB_connection();
		   return $db->update(config::TABLENAME,$kv);    
	}
	//database selection and connection and calling delete function of database class
	function remove($id)
	{
	       $db= new DB_connection();
		   return $db->delete(config::TABLENAME,$id);    
	}
    
		
}

?>

