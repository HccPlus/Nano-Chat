
<?php

include "main.php";
$con = connect_SQL("MAIN");
$cookie = $_COOKIE["user"];
$sql = "UPDATE `LOGINDATA` SET `COOKIE` = NULL, `TIME` = NULL WHERE `COOKIE` = '{$cookie}';";
mysqli_query($con, $sql);
mysqli_close($con);
echo 0;

?>