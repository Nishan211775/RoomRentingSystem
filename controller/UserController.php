<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 5/17/2017
 * Time: 9:45 PM
 */

    include_once ('../DBConnection/DBConnection.php');
    include_once ('../model/Customer.php');
    include_once ('../model/photo.php');

    class UserController extends DBConnection
    {

        public function UserController()
        {
            parent::DBConnection();
        }


        public function register(Customer $c)
        {
            $res = 0;

            $sql = "insert into customer(`customer_id`, `first_name`, `last_name`, `username`, `gender`, `contact`, 
                    `address`, `account_type`, `city`, `password`)
                    values (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $stm = $this->getConnection()->prepare($sql);

                $fname = $c->getFirstName();
                $lname = $c->getLastName();
                $uname = $c->getUsername();
                $gender = $c->getGender();
                $con = $c->getContact();
                $add = $c->getAddress();
                $acctype = $c->getAccountType();
                $city = $c->getCity();
                $pass = $c->getPassword();

                $stm->bind_param('sssssssss', $fname, $lname, $uname, $gender, $con, $add, $acctype, $city, $pass);

                $this->$res = $stm->execute();

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return $this->$res;
        }

        public function photo(Photo $p)
        {
            $res = 0;
            $sql = "insert into photos(`photo_id`, `photo_name`, `customer_id`, `room_id`) VALUES (NULL, ?, ?, ?)";

            try {
                $stm = $this->getConnection()->prepare($sql);

                $photo_name = $p->getPhotoName();
                $customer_id = $p->getCustomerId();
                $room_id = $p->getRoomId();

                $stm->bind_param("sii", $photo_name, $customer_id, $room_id);

                $this->$res = $stm->execute();
            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return $this->$res;
        }


        public function showProfile(Customer $c)
        {
            $sql = "select *, photo_name 
                    from customer c, photos p
                    where c.customer_id = p.customer_id 
                    and c.customer_id = ?";

            try {
                $stmt = $this->getConnection()->prepare($sql);
                $id = $c->getId();
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $res = $stmt->get_result();

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return mysqli_fetch_array($res);
        }


        public function login(Customer $c)
        {
            $sql = "select * from customer where username = ? and password = ?";

            try {
                $username = $c->getUsername();
                $password = $c->getPassword();

                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    return true;
                }

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return false;
        }

        public function getUserInfo(Customer $c) {
            $sql = "select * from customer where username = ? and password = ?";

            try {
                $username = $c->getUsername();
                $password = $c->getPassword();

                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();

                $res = $stmt -> get_result();

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return mysqli_fetch_array($res);
        }

        public function updateProfile(Customer $c) {
            $sql = "update customer set first_name = ?, last_name = ?, gender = ?, contact = ?, 
                    address = ? where customer_id = ?";

            try {
                $stm = $this -> getConnection() -> prepare($sql);

                $first_name = $c -> getFirstName();
                $last_name = $c -> getLastName();
                $gender = $c -> getGender();
                $contact = $c -> getContact();
                $address = $c -> getAddress();
                $id = $c -> getId();

                $stm -> bind_param("sssssi", $first_name, $last_name, $gender, $contact, $address, $id);
                $res = $stm -> execute() or die($stm -> error);
            } catch (SQLiteException $e) {
                echo $e;
            }

            return $res;

        }

        public function getRenterId(Customer $c) {
            $sql = "select customer_id from customer where username = ?";

            try {
                $stm = $this -> getConnection() -> prepare($sql);
                $username = $c -> getUsername();

                $stm -> bind_param("s", $username);
                $stm -> execute() or die($stm -> error);
                $res = $stm -> get_result();
            } catch(SQLiteException $ex) {
                echo $ex -> getMessage();
            }

            return mysqli_fetch_array($res);
        }

        public function getUsername($id) {
            $sql = "select username from customer where customer_id = ?";

            try {
                $stm = $this -> getConnection() -> prepare($sql);
                $stm -> bind_param("i", $id);
                $stm -> execute();
                $res = $stm -> get_result();
            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return mysqli_fetch_array($res);
        }

    }