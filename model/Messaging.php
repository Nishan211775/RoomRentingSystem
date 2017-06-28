<?php

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/25/2017
 * Time: 9:54 AM
 */
class Messaging {

    private $message_id;
    private $sender_id;
    private $receiver_id;
    private $message;

    public function Messaging() {

    }

    public function setMessageId($message_id) {
        $this->message_id = $message_id;
    }

    public function getMessageId() {
        return $this->message_id;
    }

    public function setSenderId($sender_id) {
        $this->sender_id = $sender_id;
    }

    public function getSenderId() {
        return $this->sender_id;
    }

    public function setReceiverId($receiver_id) {
        $this->receiver_id = $receiver_id;
    }

    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getMessage() {
        return $this->message;
    }

}