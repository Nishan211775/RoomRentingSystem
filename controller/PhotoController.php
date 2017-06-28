<?php

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/14/2017
 * Time: 7:30 AM
 */
include_once ("../model/photo.php");

class PhotoController extends DBConnection {

    public function PhotoController() {
        parent::DBConnection();
    }

    public function insertImage(Photo $p) {
        $res = 0;
        $sql = "insert into photos(`photo_id`, `photo_name`, `customer_id`, `room_id`) VALUES (NULL, ?, ?, ?)";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $photo_name  = $p -> getPhotoName();
            $customer_id = $p -> getCustomerId();
            $room_id = $p -> getRoomId();

            $stm -> bind_param("sii", $photo_name, $customer_id, $room_id);

            $this -> $res = $stm -> execute();
        } catch (SQLiteException $ex) {
            echo $ex;
        }

        return $this -> $res;
    }
}