<?php

// LIVE SITE
$db_name = "scipy";
if ($_SERVER['SERVER_NAME'] == "localhost")
{
  $connection = @mysql_connect("127.0.0.1","jri","tensai14") or die("Couldn't Connect.");
}
else
{
  $connection = @mysql_connect("127.0.0.1","jivanoff","tr4n5c3nd!!") or die("Couldn't Connect.");
}


$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

?>