<?php
function check_required_field($errors){
	//Form Validation	
	$required= array();
	foreach($errors as $field)
		{
		if(!isset($_POST[$field]) || (empty($_POST[$field]) && !is_numeric($_POST[$field])))
		{
			$required[] = $field;
		}
		
	}
	return $required;
}
function check_max_length($length_array){
	$error= array();
	foreach($length_array as $field => $max){
		if(strlen(trim(mysql_prep($_POST[$field]))) > $max){
			$error[]=$field;
		
		}
	}
	return $error;	
	}
	
function display_error($error_array){
 echo "<p class=\"errors\">";
 echo "Please review the following fields <br />";
 foreach($error_array as $field){
	 echo " - ".$field."<br />";
	 }	
	}	
?>
