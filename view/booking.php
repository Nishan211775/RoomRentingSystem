<?php
session_start();
include_once ('../model/Booking.php');
include_once ('../controller/BookingController.php');

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/20/2017
 * Time: 6:59 PM
 */

$customer_id = $_SESSION['customer_id'];
$renter = $_GET['renter_id'];
$room_id = $_GET['room_id'];

$booking = new Booking();
$booking -> setBookingId(NULL);
$booking -> setCustomerId($customer_id);
$booking -> setRenterId($renter);
$booking -> setRoomId($room_id);

$bc = new BookingController();
$res = $bc -> bookRoom($booking);

header("location: home.php?btn_text=CANCEL BOOKING");
