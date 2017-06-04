<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 5/17/2017
 * Time: 9:45 PM
 */

    include_once ('Action.php');
    include_once ('../model/Customer.php');
    include_once ('../model/photo.php');

    class UserController extends DBConnection {

        public function UserController() {
            parent::DBConnection();
        }


        public function register(Customer $c) {
            $res = 0;

            $sql = "insert into customer(`customer_id`, `first_name`, `last_name`, `username`, `gender`, `contact`, `address`, `account_type`, `city`)
                    values (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $stm = parent::getConnection() -> prepare($sql);
                $stm -> bind_param("sss", $customer_id, $fname, $lname, $uname, $gender, $con, $add, $acctype, $city);
                $this -> $fname = $c -> getFirstName();
                $this -> $lname = $c -> getLastName();
                $this -> $uname = $c -> getUsername();
                $this -> $gender = $c -> getUsername();
                $this -> $con = $c -> getGender();
                $this -> $add = $c -> getAddress();
                $this -> $acctype = $c -> getAccountType();
                $this -> $city = $c -> getCity();

                $this -> $res = $stm -> execute();

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return $res;
        }

        public function photo(Photo $p) {
            $res = 0;
            $sql = "insert into photo(`photo_id`, `photo_name`, `customer_id`, `room_id`) VALUES (NULL, ?, ?, ?)";

            try {
                $stm = parent::getConnection() -> prepare($sql);
                $stm -> bind_param("sss", $photo_name, $customer_id, $room_id);
                $this -> $photo_name  = $p -> getPhotoName();
                $this -> $customer_id = $p -> getCustomerId();
                $this -> $room_id = $p -> getRoomId();

                $this -> $res = $stm -> execute();
            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return $res;
        }


        /*public function photo(Photo $p) {
            $photos_array = array (
                'photo_id' => $p -> getPhotoId(),
                'photo_name' => $p -> getPhotoName(),
                'customer_id' => $p -> getCustomerId(),
                'room_id' => $p -> getRoomId()
            );

            $res = parent::insert('photos', $photos_array);

            if($res > 1) {
                return $res;
            } else {
                return $res;
            }
        }*/

        /*public function register(Customer $r) {
    $array_data = array(
        'customer_id' => $r -> getId(),
        'first_name' => $r -> getFirstName(),
        'last_name' => $r -> getLastName(),
        'username' => $r -> getUsername(),
        'gender' => $r -> getGender(),
        'contact' => $r -> getContact(),
        'address' => $r -> getAddress(),
        'account_type' => $r -> getAccountType(),
        'city' => $r -> getCity()

    );

    $res = parent::insert('customer', $array_data);

    if($res > 1) {
        return $res;
    } else {
        //throw new SQLiteException();
    }
}*/


        /*public function photo(Photo $p) {
            $sql = "insert into photos(`photo_id`,`photo_name`,`customer_id`,`room_id`) values (NULL, ?, ?, ?)";
            $stm = parent::getConnection() -> prepare($sql);
            $stm -> bind_param('sss', $photo_name, $customer_id, $room_id);

            $this -> $photo_name = $p -> getPhotoName();
            $this -> $customer_id = $p -> getCustomerId();
            $this -> $room_id = $p -> getRoomId();

            $res = $stm -> execute();

            return $res;
        }*/

        /*public function login($username, $password) {
            $column = "username, password";
            $table_name = "customer";
            $where_clause = "";

            $res = parent::select($table_name, $column, $where_clause);

            if ($res -> fetch_assoc()) {
                if($res['username'] == $username && $res['password'] == $password) {
                    return true;
                } else {
                    return false;
                }
            }
        }*/

        public function showProfile($customer_id) {
            $column = "first_name, last_name, username, gender, contact, address, account_type, city, photo_name";
            $table_name = "customer, photos";
            $where_clause = "customer.coustomer_id = photos.customer_id and customer_id = ".$customer_id;

            $res = parent::select($table_name, $column, $where_clause);

            return $res;
        }
    }
