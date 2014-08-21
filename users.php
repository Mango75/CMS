<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/form_functions.php");
	if (isset($_POST['submit'])){
	}
	else{
		$username="";
		$password="";
	}
	

?>
<?php include("includes/header.php"); ?>
    	<header>
        	<h1>Mango CMS</h1>
        </header>
        <div id="content">
            <aside>
            <a href="index.php">Return to public page</a>
            </aside>
            <article>
            	<h2>Add User:</h2>
                <?php if(!empty($errors)){echo"<p class=\"message\"> ".$message." </p>";} ?>
                <?php if(!empty($errors)){display_errors($errors); } ?>
                <form action="adduser.php" method="post">
                <p>Username: <input type="text" name="user" maxlength="30" value="<?php echo htmlentities($username); ?>" /></p>
                <p>Password: <input type="password" name="pwd"  maxlength="30" value="<?php echo htmlentities($password); ?>" /></p>
                <input type="submit" name="submit" value="Add User" />
                </form>	
            </article>    
<?php require("includes/footer.php"); ?>
