<?php
include_once ('../model/Booking.php');
include_once ('../controller/BookingController.php');
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/22/2017
 * Time: 2:20 PM
 */

$booking_id = $_GET['id'];

$booking_id = $_GET['id'];
$booking = new Booking();
$booking -> setBookingId($booking_id);

$bc = new BookingController();
$bc -> declineBooking($booking);

header("location: notification.php");