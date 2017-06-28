<?php
session_start();
include_once ('../model/Room.php');
include_once ('../model/photo.php');
include_once ('../model/Customer.php');
include_once ('../controller/RoomController.php');
include_once ('../controller/PhotoController.php');
include_once ('../DBConnection/DBConnection.php');

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/18/2017
 * Time: 3:49 PM
 */

if (isset($_POST['save_room'])) {
    $target = "../images/room/".basename($_POST['photo_sel']);

    $size = $_POST['size'];
    $no = $_POST['no_of_rooms'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $photo = $_POST['photo_sel'];
    $feature = $_POST['features'];

    $sql = "select MAX(room_id) from rooms";
    $db = new DBConnection();
    $res = $db -> getConnection() -> query($sql);
    $row = mysqli_fetch_row($res);

    $r = new Room();
    $r -> setRoomId(NULL);
    $r -> setSize($size);
    $r -> setNoOfRooms($no);
    $r -> setPrice($price);
    $r -> setLocation($location);
    $r -> setFeatures($feature);
    $r -> setRenterId($_SESSION['customer_id']);

    $rc = new RoomController();
    $res = $rc -> createRoom($r);

    $p = new Photo();
    $p -> setPhotoId(NULL);
    $p -> setPhotoName($photo);
    $p -> setRoomId($row[0]+1);
    $p -> setCustomerId($_SESSION['customer_id']);

    $rc = new PhotoController();
    $res1 = $rc -> insertImage($p);

    $move_done = move_uploaded_file($_POST['photo_sel'], $target);

    if (!$move_done) {
        echo error_reporting(E_ALL);
    }

    if ($res > 0 || $res1){
        header("location: ../index.php");
    } else {
        header("location: ../index.php");
        ?>
        <script>
            alert("Room added successfully");
        </script>
        <?php
        ?>
        <script>
            alert("something went wrong");
        </script>
        <?php
    }
}