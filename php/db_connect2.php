<?php
  include("db_config.php");
  mysql_connect(DBHOST, DBUSER, DBPASS) or die(mysql_error());
  mysql_select_db(DBNAME) or die(mysql_error());
?>