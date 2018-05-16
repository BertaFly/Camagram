#!/usr/bin/php
<?php
	exec("~/Library/Containers/MAMP/mysql/bin/mysql -u root -pRisha1"); 
	exec("~/Library/Containers/MAMP/mysql/bin/mysql create database testdb");
	exec("~/Library/Containers/MAMP/mysql/bin/mysql use ~/Camagru/db/testdb.sql");

?>
