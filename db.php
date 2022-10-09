<?php
define('DSN', 'mysql:host=localhost;dbname=uts_forum');
define('DBUSER', 'root');
define('DBPASS', '');

$db = new PDO(DSN, DBUSER, DBPASS);
