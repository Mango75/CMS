<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
    	<header>
        	<h1>Mango CMS</h1>
        </header>
        <div id="content">
            <aside>
            <a href="index.php">Return to menu</a>
            </aside>
            <article>
            	<h2>Login:</h2>
                <form action="logon.php" method="post">
                <p>Username: <input type="text" name="user" /></p>
                <p>Password: <input type="text" name="pwd" /></p>
                <input type="submit" name="submit" value="Login" />
                </form>	
            </article>    
<?php require("includes/footer.php"); ?>
