<?php

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/20/2017
 * Time: 12:14 AM
 */
class Booking {

    private $booking_id;
    private $customer_id;
    private $renter_id;
    private $room_id;
    private $booking_status;

    public function Booking() {

    }

    public function setBookingId($booking_id) {
        $this->booking_id = $booking_id;
    }

    public function getBookingId() {
        return $this->booking_id;
    }

    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function getCustomerId() {
        return $this->customer_id;
    }

    public function setRenterId($renter_id) {
        $this->renter_id = $renter_id;
    }

    public function getRenterId() {
        return $this->renter_id;
    }

    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function setBookingStatus($booking_status) {
        $this->booking_status = $booking_status;
    }

    public function getBookingStatus() {
        return $this->booking_status;
    }
}