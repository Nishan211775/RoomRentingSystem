<?php

include_once ("../controller/RoomController.php");
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 7/2/2017
 * Time: 3:58 PM
 */

$room = new RoomController();
$res = $room -> deleteRoom($_GET['id']);

if ($res > 0) {
    header("location: room.php?mes='deleted'");
}