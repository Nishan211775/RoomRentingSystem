<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/14/2017
 * Time: 12:10 AM
 */

include_once ("model/Room.php");
include_once ("model/photo.php");
include_once ("controller/RoomController.php");
include_once ("controller/PhotoController.php");

if (isset($_POST['save_room'])) {

    $target = "../images/".basename($_FILES['photo_selector']['name']);
    $image_name = $_FILES['photo_selector']['name'];

    $size = $_POST['size'];
    $no_of_rooms = $_POST['no_of_rooms'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $photo = $_POST['photo_selector'];
    $features = $_POST['features'];

    $photo = new Photo();
    $room = new Room();
    $room_controller = new RoomController();
    $photo_controller = new PhotoController();

    $room -> setRoomId(NULL);
    $room -> setSize($size);
    $room -> setNoOfRooms($no_of_rooms);
    $room -> setPrice($price);
    $room -> setLocation($location);
    $room -> setFeatures($photo);
    $room -> setRenterId($features);

    $photo -> setPhotoId(NULL);
    $photo -> setPhotoName($image_name);
    $photo -> setCustomerId(NULL);
    $photo -> setRoomId(NULL);

    $room_controller -> createRoom($room);
    $photo_controller -> insertImage($photo);

    move_uploaded_file($_FILES['photo_selector']['tmp_name'], $target);
}