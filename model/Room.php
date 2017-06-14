<?php

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/13/2017
 * Time: 9:43 PM
 */
class Room {

    private $room_id;
    private $size;
    private $no_of_rooms;
    private $price;
    private $location;
    private $features;
    private $renter_id;

    public function Room() {

    }

    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function setNoOfRooms($no_of_rooms) {
        $this->no_of_rooms = $no_of_rooms;
    }

    public function getNoOfRooms() {
        return $this->no_of_rooms;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setFeatures($features) {
        $this->features = $features;
    }

    public function getFeatures() {
        return $this->features;
    }

    public function setRenterId($renter_id) {
        $this->renter_id = $renter_id;
    }

    public function getRenterId() {
        return $this->renter_id;
    }

}