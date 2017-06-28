<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/17/2017
 * Time: 9:35 AM
 */

session_start();
session_destroy();
header("location: login.php");

?>