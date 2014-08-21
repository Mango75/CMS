<?php 
//basic functions
 function mysql_prep($value){
	 $magic_quotes_active = get_magic_quotes_gpc();
	 $new_enough_php=function_exists("mysql_real_escape_string");
	 
	 if($new_enough_php){
		 if($magic_quotes_active){
			 $value= stripslashes($value);}
			 $value=mysql_real_escape_string($value);
		 }
	 else{
		 if(!$magic_quotes_active)
		 $value=addslashes($value);
		 }	 
	return $value;
	}
 function redirect($location= NULL){
	 if($location != NULL){
	 header("Location: {$location}");
	 }
 }
 function confirm_query($result_set){
 			if(!$result_set){
					die("Det fick inget svar". mysql_error());
					}
 }
 function get_subjects($public=true){
	 			global $connection;
 				$query="SELECT * 
						FROM subjects ";
				if($public){		
				$query.="WHERE visible = 1 ";
				}
				$query.="ORDER BY position ASC";
				$subject_set=mysql_query($query ,$connection);
				confirm_query($subject_set);
				return $subject_set;
 }
 function get_all_pages(){
				global $connection;
 				$query="SELECT * 
						FROM pages 
						ORDER BY position ASC";
					$page_set=mysql_query($query, $connection);
					confirm_query($page_set);
					return $page_set;
 }
 
 function get_pages($subject_id, $public=true){
				global $connection;
 				$query="SELECT * 
						FROM pages 
						WHERE subject_id = {$subject_id} ";
							if($public){		
				$query.="AND visible = 1 ";
				}
				$query.="ORDER BY position ASC";
					$page_set=mysql_query($query, $connection);
					confirm_query($page_set);
					return $page_set;
 }
 function select_subject_by_id($subject_id){
  	global $connection;
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE id= {$subject_id} ";
	$query .= "LIMIT 1";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	if($subject = mysql_fetch_array($result_set)){
		return $subject;
	}
	else{
		return NULL;
	}	
 }
 function select_page_by_id($page_id){
  	global $connection;
	$query = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id=" . $page_id . " ";
	$query .= "LIMIT 1";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	if($page = mysql_fetch_array($result_set)){
		return $page;
	}
	else{
		return NULL;
	}	
 }
 function get_default_page($subject_id){
	 $page_set = get_pages($subject_id,true);
	 if($first_page = mysql_fetch_array($page_set)){
	 	return $first_page;
	 }
	 else{
	 	return NULL;
	 }
 
 }
  function get_selected_page(){
	  global $set_subj;
	  global $set_page;
  if(isset($_GET['subj'])){
	$set_subj=select_subject_by_id($_GET['subj']);
	$set_page=get_default_page($set_subj['id']);
	}
	elseif(isset($_GET['page'])){
	$set_subj=NULL;
	$set_page=select_page_by_id($_GET['page']);	
	} 
	else{
	$set_subj=NULL;
	$set_page=NULL;
	}
  }
  function navigation($set_subject,$set_page, $public=false)
  {
	  global $connection;
	  	//ask for data
				$subject_set=get_subjects($public);
				//show data
				while($subject=mysql_fetch_array($subject_set)){
					echo "<li"; if($subject["id"]==$set_subj['id']){ echo " class=\"selected\"";} echo "><a href=\"update_subject.php?subj=".urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>";
					$page_set=get_pages($subject["id"],$public);
					//show data
					echo '<ul id="pages">';
					while($page=mysql_fetch_array($page_set)){
					echo "<li";if($page["id"]==$set_page['id']){ echo " class=\"selected\"";} echo "><a href=\"content.php?page=".urlencode($page["id"])."\">{$page["menu_name"]}</a></li>";
					}
					echo "</ul>";
				}
					
  }
   function public_navigation($set_subj,$set_page, $public=true)
  {
	  global $connection;
	  	//ask for data
				$subject_set=get_subjects($public);
				//show data
				while($subject=mysql_fetch_array($subject_set)){
					echo "<li"; 
					if($subject["id"]==$set_subj['id']){ echo " class=\"selected\"";} echo "><a href=\"index.php?subj=".urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>";
					if($subject["id"]==$set_subj['id']){
						$page_set=get_pages($subject["id"],$public);
						//show data
						echo '<ul id="pages">';
						while($page=mysql_fetch_array($page_set)){
						echo "<li";
						if($page['id']==$set_page['id']){ echo " class=\"selected\"";} echo "><a href=\"index.php?page=".urlencode($page["id"])."\">{$page["menu_name"]}</a></li>";
						}
						echo "</ul>";
					}
				}
					
  }
?>