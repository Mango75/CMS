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
    	<header>
        	<h1>Mango CMS</h1>
        </header>
        <div id="content">
            <aside>
            	<ul id="meny">
         		<?php navigation($set_subject,$set_page)?>       
                </ul>
                <a href="new_subject.php">Create New Subject</a>
            </aside>
            <article>
            	<h2><?php if(!is_null($set_subj)){echo $set_subj['menu_name'];} elseif(!is_null($set_page)){ echo $set_page['menu_name'];} else{ echo "Inget valt";} ?></h2>
                <p><?php echo $set_page['content']; 
				?></p>
                   <form action="create_subject.php" method="post">
                    <p>Subject name:
                    	<input type="text" name="menu_name" id="menu_name" />
                    </p>
                    <p>Position:
                    	<select name"position">
                        <?php
							$subject_set=get_subjects();
							$subject_count=mysql_num_rows($subject_set);
							for($count=1;$count<= $subject_count+1;$count++){
                    		echo"<option value=\"{$count}\">{$count}</option>";
							}
							?>
                     	</select>       
                    </p>
                    <p>Visible:
                    	<input type="radio" name="visible" value="0" />No
                        <input type="radio" name="visible" value="1" />Yes
                    </p>
                    <p>
                    	<input type="submit" value="Add Subject" />
                    </p>
                </form>		    		
            </article>    
<?php mysql_close($connection); ?>
