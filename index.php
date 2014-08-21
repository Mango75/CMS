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
         		<?php  echo public_navigation($set_subj,$set_page, $public=true);?>       
                </ul>
                <a href="new_subject.php">Create New Subject</a>
            </aside>
            <article>
            	<h2><?php if(!is_null($set_subj))
				{echo htmlentities($set_subj['menu_name']);} 
				elseif(!is_null($set_page))
				{ echo $set_page['menu_name'];} else{ echo "Inget valt";} ?></h2>
                <p><?php echo strip_tags(nl2br($set_page['content']),"<br><a>"); ?></p>	
            </article>    
<?php require("includes/footer.php"); ?>
