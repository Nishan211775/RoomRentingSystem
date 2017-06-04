<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 5/17/2017
 * Time: 1:22 PM
 */
    class DBConnection {

        private $host;
        private $user;
        private $pass;
        private $database;
        private $conn;

        public function DBConnection() {
            $this -> host = 'localhost';
            $this -> user = 'root';
            $this -> pass = '';
            $this -> database = 'room_renting_system';
        }

        public function getConnection() {
            $this -> conn = new mysqli($this -> host, $this -> user, $this -> pass, $this -> database) or
                die($this -> conn->error);

            return $this -> conn;
        }

    }
?>