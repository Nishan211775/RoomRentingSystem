<?php

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 5/20/2017
 * Time: 4:30 PM
 */
class Photo {

    private $photo_id;
    private $photo_name;
    private $customer_id;
    private $room_id;

    public function Photo() {

    }

    public function setPhotoId($photo_id) {
        $this->photo_id = $photo_id;
    }

    public function getPhotoId() {
        return $this->photo_id;
    }

    public function setPhotoName($photo_name) {
        $this->photo_name = $photo_name;
    }

    public function getPhotoName() {
        return $this->photo_name;
    }

    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function getCustomerId() {
        return $this->customer_id;
    }


    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }
}