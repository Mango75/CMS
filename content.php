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
         		<?php  echo navigation($set_subject,$set_page,$public);?>       
                </ul>
                <a href="new_subject.php">Create New Subject</a>
            </aside>
            <article>
            	<h2><?php if(!is_null($set_subj)){echo $set_subj['menu_name'];} elseif(!is_null($set_page)){ echo $set_page['menu_name'];} else{ echo "Inget valt";} ?></h2>
                <p><?php echo "<p>".$set_page['content']."</p>";
				 		echo "<p><a href=\"update_page.php?page=".urlencode($set_page['id'])."\">Update Page</a></p>"; 
				?>		
            </article>    
<?php require("includes/footer.php"); ?>
