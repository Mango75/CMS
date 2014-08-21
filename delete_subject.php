<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	 if(intval($_GET['subj'])==0){
	  redirect("content.php");
	 }
	
	 $id=mysql_prep($_GET['subj']);
	if($subject = select_subject_by_id($id)){
	 $query="DELETE FROM subjects WHERE id ={$id} LIMIT 1";
	 $result=mysql_query($query, $connection);
	 if(mysql_affected_rows() == 1)
	 {//success
		 redirect("content.php");
		 }
	else{
	//failed	
	echo"<p>Subject deletion feiled</p>";
	echo"<p>".mysl_error()."</p>";
	echo"<a href=\"content.php\>Return to Main Page</a>";
		}
	}else{
		//subject did not exist in database
		redirect("content.php");
		}
?>	
<?php require("includes/footer.php"); ?>
