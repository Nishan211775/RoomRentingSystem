<?php
session_start();
include_once ('../model/Booking.php');
include_once ('../controller/BookingController.php');
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/22/2017
 * Time: 2:19 PM
 */

$booking_id = $_GET['id'];
$_SESSION['booking_id'] = $booking_id;

$booking = new Booking();
$booking -> setBookingId($booking_id);

echo $_SESSION['booking_id'];

$bc = new BookingController();
$bc -> acceptBooking($booking);

header("location: ../controller/send_mail.php");

//header("location: notification.php");