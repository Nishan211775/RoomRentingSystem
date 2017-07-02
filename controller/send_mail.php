<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 7/1/2017
 * Time: 1:05 PM
 */
session_start();
include_once ("../PHPMailer-master/PHPMailerAutoload.php");
include_once ("../DBConnection/DBConnection.php");

    $booking_id = $_SESSION['booking_id'];
    //echo $booking_id;
    $sender_id = $_SESSION['customer_id'];

    $database = new DBConnection();
    $booking = "select * from booking where booking_id=$booking_id";
    $result = $database -> getConnection() -> query($booking);
    $res = $result -> fetch_array();
    //var_dump($res);

    $customer_id = $res[1];
    $renter_id = $res[2];
    $room_id = $res[3];
    $booking_status = $res[4];


    $sender = "select * from customer where customer_id = $sender_id";
    $sender_result = $database -> getConnection() -> query($sender);
    $sender_res = $sender_result -> fetch_array();

    $sender_first_name = $sender_res[1];
    $sender_last_name = $sender_res[2];
    $sender_contact = $sender_res[5];

    $user = "select * from customer where customer_id = $customer_id";
    $user_result = $database -> getConnection() -> query($user);
    $user_res = $user_result -> fetch_array();
    //var_dump($user_result);

    $receiver_first_name = $user_res[1];
    $receiver_last_name = $user_res[2];
    $receiver_email = $user_res[3];

    //echo "NIshan<br>Dhungana";

    $room = "select * from rooms where room_id=$room_id";
    $room_result = $database -> getConnection() -> query($room);
    $room_res = $room_result -> fetch_array();
    //var_dump($room_res);

    $room_id = $room_res[0];
    $room_size = $room_res[1];
    $total  = $room_res[2];
    $price  = $room_res[3];
    $location = $room_res[4];
    $features  = $room_res[5];


    /*$mailto = $_GET['email'];

    $sql = "select * from booking where customer_id = $customer_id";
    $res = querySelect($sql);
    $row = mysqli_fetch_array($res);

    $mailSub = "Your booking has been accepted";*/
    $mailMsg = "Dear ".$receiver_first_name." ".$receiver_last_name."<br>
        As per your request, ".$sender_first_name." ".$sender_last_name." has accepted your request. The room detail of your request is<br>
        Room Id = ".$room_id."<br>
        Room Size = ".$room_size."<br>
        No of rooms = ".$total."<br>
        Price = ".$price."<br>
        Location = ".$location."<br>
        Features = ".$features."<br>
        Please contact ".$sender_contact." for further information<br>
        Thank You!";



    $mail = new PHPMailer();
    $mail ->IsSmtp();
    $mail ->SMTPDebug = 0;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'ssl';
    $mail ->Host = "smtp.gmail.com";
    $mail ->Port = 465; // or 587;
    $mail ->IsHTML(true);
    $mail ->Username = "nishandhungana41@gmail.com";
    $mail ->Password = "N983008d";
    $mail ->SetFrom("Room Renting System");
    $mail ->Subject = $mailSub;
    $mail ->Body = $mailMsg;
    $mail ->AddAddress($receiver_email);

   if(!$mail->Send()) {
       echo "Mail Not Sent";
   }
   else {
       ?>
       <script>
           alert("Email has been send");
           window.location.href = '../view/home.php';
       </script>
       <?php
   }









