<?php 

//conf.inc.php
if(!defined('IN_RATING')){
	exit('Access Denied');
}

DB::$user = 'db_username';
DB::$password = 'db_password';
DB::$dbName = 'db_dbname';


?>