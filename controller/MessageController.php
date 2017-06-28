<?php
include_once("../model/Messaging.php");
include_once ("../DBConnection/DBConnection.php");
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/25/2017
 * Time: 9:23 AM
 */
class MessageController extends DBConnection {

    public function MessageController() {
        parent::DBConnection();
    }

    public function sendMessage(Messaging $m) {
        $sql = "insert into message(`message_id`, `sender_id`, `receiver_id`, `messages`) values(NULL, ?, ?, ?)";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $sender_id = $m -> getSenderId();
            $receiver_id = $m -> getReceiverId();
            $message = $m -> getMessage();

            $stm -> bind_param("iis", $sender_id, $receiver_id, $message);
            $res = $stm -> execute();
        } catch (SQLiteException $e) {
            echo $e -> getMessage();
        }

        return $res;
    }

    public function showMessage(Messaging $m) {
        $sql = "select * from message where sender_id = ? and receiver_id = ? order by message_id desc";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $customer_id = $m -> getSenderId();
            $renter_id = $m -> getReceiverId();

            $stm -> bind_param("ii", $customer_id, $renter_id);
            $stm -> execute();
            $res = $stm -> get_result();

        } catch (SQLiteException $e) {
            echo $e -> getMessage();
        }

        return mysqli_fetch_all($res);
    }

    public function showMessage1(Messaging $m) {
        $sql = "select * from message where sender_id = ? and receiver_id = ? order by message_id desc";

        try {
            $stm = $this -> getConnection() -> prepare($sql);

            $customer_id = $m -> getSenderId();
            $renter_id = $m -> getReceiverId();

            $stm -> bind_param("ii", $customer_id, $renter_id);
            $stm -> execute();
            $res = $stm -> get_result();

        } catch (SQLiteException $e) {
            echo $e -> getMessage();
        }

        return mysqli_fetch_all($res);
    }

    public function getSenderName($receiver_id) {
        $sql = "select sender_id from message where receiver_id = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $stm -> bind_param("i", $receiver_id);
            $stm -> execute() or die($stm -> error);
            $res = $stm -> get_result();
        } catch (SQLiteException $e) {
            echo $e -> getMessage();
        }

        $res1 = mysqli_fetch_array($res);

        $sql1 = "select first_name from customer where customer_id = ?";

        try {
            $stm1 = $this -> getConnection() -> prepare($sql1);
            $stm1 -> bind_param("i", $res1[0]);
            $stm1 -> execute() or die($stm1 -> error);
            $res2 = $stm1 -> get_result();
        } catch (SQLiteException $e) {
            echo $e -> getMessage();
        }

        return mysqli_fetch_all($res2);

    }

    public function getID($name) {
        $sql = "select customer_id from customer where first_name = ?";

        try {
            $stm = $this -> getConnection() -> prepare($sql);
            $stm -> bind_param("s", $name);
            $stm -> execute() or die($stm -> error);
            $res = $stm -> get_result();
        } catch (SQLiteException $e) {
            echo $e -> getMessage();
        }

        return mysqli_fetch_array($res);
    }
}