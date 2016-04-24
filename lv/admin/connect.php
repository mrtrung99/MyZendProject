<?php

$conn=mysql_connect("localhost", "root", "") or die("can't connect database");
mysql_select_db("mrt",$conn); 
mysql_query("set names 'utf8'",$conn);

?>