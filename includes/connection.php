<?php 
require("constants.php");
//connect
$connection=mysql_connect(DB_SERVER, DB_USER, DB_PWD);
if(!$connection){
	die("Det gick inte att ansluta till servern ". mysql_error());
}
//select
$selection=mysql_select_db(DB_SELECT,$connection);
if(!$selection){
	die("Det gick inte att välja databasen ".mysql_error());
}
?>