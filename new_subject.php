<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
            	<h2>Create New Subject</h2>
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
<?php require("includes/footer.php"); ?>
