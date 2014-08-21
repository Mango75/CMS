<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php $errors = array();
	//Form Validation
	
	$required= array('menu_name','position','visible');
	foreach($required as $field){
		if(isset($_POST[$required]) || empty($_POST[$required])){
			$errors[] =$field;
		}
	}
?>
<?php
	$menu_name=mysql_prep( $_POST['menu_name']);
	$position= mysql_prep($_POST['position']);
	$visible= mysql_prep($_POST['visible']);
?>

<?php 
$query="INSERT INTO subjects ( menu_name, position, visible ) VALUES ( '{$menu_name}', {$position}, {$visible} )";
$result=mysql_query($query, $connection);
if($result){
	//succeeded
	redirect("content.php");
	}
else{
	//Error message
	echo "Ett fel inträffade ".mysql_error();
	}	
?>
<?php mysql_close($connection); ?>
