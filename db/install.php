#!/usr/bin/php
<?php
	exec('~/Library/Containers/MAMP/mysql/bin/mysql -u root -pRisha1'); 
	exec("~/Library/Containers/MAMP/mysql/bin/mysql create database testdb");
	exec("~/Library/Containers/MAMP/mysql/bin/mysql use testdb");
	exec("~/Library/Containers/MAMP/mysql/bin/mysql source ~/camagru/db/testdb.sql");

?>
