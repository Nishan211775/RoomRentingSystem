<?php
include_once ('../model/Room.php');
include_once ('../DBConnection/DBConnection.php');
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/17/2017
 * Time: 6:29 PM
 */
class RoomController extends DBConnection {

    public function RoomController() {
        parent::DBConnection();
    }

    public function createRoom(Room $r) {
        $res = 0;

        $sql = "INSERT INTO rooms(`room_id`, `size`, `no_of_rooms`, `price`, `location`, `features`, `renter_id`) VALUES(NULL, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this -> getConnection() -> prepare($sql);

            $size = $r -> getSize();
            $no_of_rooms = $r -> getNoOfRooms();
            $price = $r -> getPrice();
            $location = $r -> getLocation();
            $features = $r -> getFeatures();
            $renter_id = $r -> getRenterId();

            $stmt -> bind_param("sidssi", $size, $no_of_rooms, $price, $location, $features, $renter_id);
            $res = $stmt -> execute() or die($stmt -> error);

        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return $res;

    }

    public function showRoomDetails() {
        $sql = "select *, photo_name
                from rooms r, photos p
                where r.room_id = p.room_id";

        try {

            $stm = $this -> getConnection() -> prepare($sql);
            $stm -> execute() or die($stm -> error);
            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return mysqli_fetch_all($res);

    }

    public function getRenterDetails($id) {
        $sql = "select customer_id, first_name, last_name, contact from customer where customer_id = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $customer_id = $id;
            $stm -> bind_param("i", $customer_id);
            $stm -> execute() or die($stm -> error);
            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex->getMessage();
        }

        return mysqli_fetch_all($res);
    }

    public function getRoom(Room $c) {
        $sql = "select * from rooms where renter_id = ?";

         try {
            $stm = $this -> getConnection() -> prepare($sql);
            $id = $c -> getRenterId();
            $stm -> bind_param("i", $id);
            $stm -> execute() or die($stm -> error);
            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return mysqli_fetch_all($res);
    }

}