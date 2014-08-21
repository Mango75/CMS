<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	 if(intval($_GET['subj'])==0){
	  redirect("content.php");
	 }
	 if(isset($_POST['submit'])){
		 $errors = array();
		 $required= array('menu_name','position','visible');
		foreach($required as $field){
			if(!isset($_POST[$field]) || (empty($_POST[$field]) && !is_numeric($_POST[$field]))){
				$errors[] =$field;
			}
		}
	$fields_with_lengths = array('menu_name' => 30);
	foreach($fields_with_lengths as $field => $max){
		if(strlen(trim(mysql_prep($_POST['$field']))) > $max){
			$errors[]=$field;}
		}
		if(empty($errors)){
			
		$id=mysql_prep($_GET['subj']);
		$menu_name=mysql_prep( $_POST['menu_name']);
		$position= mysql_prep($_POST['position']);
		$visible= mysql_prep($_POST['visible']);
		$query="UPDATE subjects SET   
				menu_name= '{$menu_name}',
				position= {$position},
				visible= {$visible}
				WHERE id={$id}";
		$result= mysql_query($query, $connection);
			if(mysql_affected_rows() == 1){
			//success
			$message= "The subject where successfully updated.";		
			}
			else{
			//failed	
			$message="The update did not occur.";
			$message.="The problem was ".mysql_error();
			}
			}
		else{ 
		if(count($errors)==1){
			$message="There was 1 error in the form";
		}else{
		//errors occured
		$message="The update did not occur.";
		$message.=count($errors)." errors.";
		}
		}
	}// end of isset($_GET['submit']
?>
<?php get_selected_page();?>
<?php include("includes/header.php"); ?>	
    	<header>
        	<h1>Mango CMS</h1>
        </header>
        <div id="content">
            <aside>
            	<ul id="meny">
         		<?php navigation($set_subject,$set_page)?>       
                </ul>
                <a href="content.php">Cancel</a>
            </aside>
            <article>
            	<h2>Edit Subject: <?php echo $set_subj['menu_name']?></h2>
                <?php if(!empty($errors)){echo"<p class=\"message\"> ".$message." </p>";} ?>
                <?php if(!empty($errors)){
					echo "<p class=\"errors\"";
					echo "Please review the following fields: <br/>";
					foreach($errors as $error){
						echo " - ". $error."<br />";
						}
					}
				?>
                <form action="update_subject.php?subj=<?php  echo urlencode($set_subj['id']); ?>" method="post">
                    <p>Subject name:
                    	<input type="text" name="menu_name" id="menu_name" value=<?php echo $set_subj['menu_name'];?> />
                    </p>
                    <p>Position:
                    	<select name="position">
                        <?php
							$subject_set=get_subjects();
							$subject_count=mysql_num_rows($subject_set);
							for($count=1; $count<= $subject_count+1 ;$count++){
                    		echo "<option value=\"{$count}\"";
								if($count==$set_subj['position']){
								echo " selected";
								}
							echo ">{$count}</option>";
							}
							?>
                     	</select>       
                    </p>
                    <p>Visible:
                    	<input type="radio" name="visible" value="0" <?php if($set_subj['visible']==0){echo " checked";} ?> />No
                        <input type="radio" name="visible" value="1" <?php if($set_subj['visible']==1){echo " checked";} ?>/>Yes
                    </p>
                    <p>
                    	<input type="submit" name="submit" value="submit" />
                        <a href="delete_subject.php?subj=<?php echo urlencode($set_subj['id']); ?>" onclick="return confirm('Are you sure?')"> Delete subject</a>
                    </p>
                </form>
                <div>
                	<h3>Pages for this subject</h3>
                    	<ul>
                        	<?php $subject_pages = get_pages($set_subj['id']);
								while($page = mysql_fetch_array($subject_pages)){
									echo "<li><a href=\"content.php?page={$page['id']}\">{$page['menu_name']}</a></li>";
								}
							?>
                        </ul>
                        <a href="new_page.php?subj=<?php echo $set_subj['id'] ?>">Add new page</a>
                </div>		
            </article>    
<?php require("includes/footer.php"); ?>
