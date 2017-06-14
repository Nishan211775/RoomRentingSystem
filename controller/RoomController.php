<?php
include_once ("../DBConnection/DBConnection.php");
include_once ("../model/Room.php");
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/13/2017
 * Time: 9:38 PM
 */
class RoomController extends DBConnection {

    public function RoomController() {
        parent::DBConnection();
    }

    public function createRoom(Room $r) {
        $res = 0;

        $sql = "INSERT INTO Rooms (`room_id`, `size`, `no_of_rooms`, `price`, `location`, `features`, `renter_id`) VALUES(NULL, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->getConnection() -> prepare($sql);

            $size = $r -> getSize();
            $no_of_rooms = $r -> getNoOfRooms();
            $price = $r -> getPrice();
            $location = $r -> getLocation();
            $features = $r -> getFeatures();
            $renter_id = $r -> getRenterId();

            $stmt -> bind_param("sifssi", $size, $no_of_rooms, $price, $location, $features, $renter_id);
            $this -> $res = $stmt -> execute();

        } catch (SQLiteException $ex) {
            echo $ex;
        }

        return $this -> $res;
    }

}