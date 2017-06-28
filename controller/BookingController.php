<?php
include_once ("../DBConnection/DBConnection.php");
include_once ("../model/Booking.php");
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/20/2017
 * Time: 12:22 AM
 */
class BookingController extends DBConnection {

    public function BookingController() {
        parent::DBConnection();
    }

    public function bookRoom(Booking $b) {
        $sql = "insert into booking(`booking_id`, `customer_id`, `renter_id`, `room_id`) values(NULL, ?, ?, ?)";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $customer_id = $b -> getCustomerId();
            $renter_id = $b -> getRenterId();
            $room_id = $b -> getRoomId();

            $stm -> bind_param("iii", $customer_id, $renter_id, $room_id);
            $res = $stm -> execute() or die($stm -> error);

        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return $res;
    }

    public function viewBooking($customer_id) {
        $sql = "select * from booking where renter_id = ? and booking_status = 0";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $stm -> bind_param("i", $customer_id);
            $stm -> execute() or die($stm -> error);

            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return mysqli_fetch_all($res);
    }

    public function getCustomerName($customer_id) {
        $sql = "select first_name, last_name from customer where customer_id = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $stm -> bind_param("i", $customer_id);
            $stm -> execute() or die($stm -> error);

            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        $row = mysqli_fetch_array($res);

        return $row[0]." ".$row[1];
    }

    public function getPhotoName($room_id) {
        $sql = "select photo_name from photos where room_id = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $stm -> bind_param("i", $room_id);
            $stm -> execute();
            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        $row = mysqli_fetch_row($res);
        return $row[0];
    }

    public function acceptBooking(Booking $b) {
        $sql = "update booking set booking_status = 1 where booking_id = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $booking_id = $b -> getBookingId();
            $stm->bind_param("i", $booking_id);
            $res = $stm -> execute() or die($stm->error);
        } catch (SQLiteException $ex) {
            echo $ex->getMessage();
        }

        return $res;
    }

    public function declineBooking(Booking $b) {
        $sql = "delete from booking where booking_id = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $booking_id = $b -> getBookingId();
            $stm->bind_param("i", $booking_id);
            $res = $stm -> execute() or die($stm->error);

        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return $res;
    }

    public function notifyUser(Booking $b) {
        $sql = "select renter_id, room_id from booking where customer_id = ? and booking_status = 1";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $customer_id = $b -> getCustomerId();

            $stm -> bind_param("i", $customer_id);
            $stm -> execute() or die($stm -> error);
            $res = $stm -> get_result();
        } catch (SQLiteException $ex) {
            echo $ex -> getMessage();
        }

        return mysqli_fetch_all($res);
    }
}