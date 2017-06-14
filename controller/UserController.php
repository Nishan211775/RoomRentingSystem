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

            $sql = "insert into customer(`customer_id`, `first_name`, `last_name`, `username`, `gender`, `contact`, 
                    `address`, `account_type`, `city`, `password`)
                    values (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $stm = $this -> getConnection() -> prepare($sql);

                $fname = $c -> getFirstName();
                $lname = $c -> getLastName();
                $uname = $c -> getUsername();
                $gender = $c -> getGender();
                $con = $c -> getContact();
                $add = $c -> getAddress();
                $acctype = $c -> getAccountType();
                $city = $c -> getCity();
                $pass = $c -> getPassword();

                $stm -> bind_param('sssssssss', $fname, $lname, $uname, $gender, $con, $add, $acctype, $city, $pass);
                
                $this -> $res = $stm -> execute();

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return $this -> $res;
        }

        public function photo(Photo $p) {
            $res = 0;
            $sql = "insert into photos(`photo_id`, `photo_name`, `customer_id`, `room_id`) VALUES (NULL, ?, ?, ?)";

            try {
                $stm = $this -> getConnection() -> prepare($sql);

                $photo_name  = $p -> getPhotoName();
                $customer_id = $p -> getCustomerId();
                $room_id = $p -> getRoomId();

                $stm -> bind_param("sii", $photo_name, $customer_id, $room_id);

                $this -> $res = $stm -> execute();
            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return $this -> $res;
        }


        public function showProfile(Customer $c) {
            $sql = "select first_name, last_name, username, gender, contact, address, photo_name 
                    from customer c, photos p
                    where c.customer_id = p.customer_id 
                    and c.customer_id = ?";

            try {
                $stmt = $this -> getConnection() -> prepare($sql);
                $id = $c -> getId();
                $stmt -> bind_param("i", $id);
                $stmt -> execute();

                $res = $stmt -> get_result();

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return mysqli_fetch_array($res);
        }


        public function login(Customer $c) {
            $sql = "select * from customer where username = ? and password = ?";

            try {
                $username = $c -> getUsername();
                $password = $c -> getPassword();

                $stmt = $this -> getConnection() -> prepare($sql);
                $stmt -> bind_param('ss', $username, $password);
                $stmt -> execute();

                while ($row = $stmt -> fetch()) {
                    return true;
                }

            } catch (SQLiteException $ex) {
                echo $ex;
            }

            return false;
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

        /*public function showProfile($customer_id) {
            $column = "first_name, last_name, username, gender, contact, address, account_type, city, photo_name";
            $table_name = "customer, photos";
            $where_clause = "customer.coustomer_id = photos.customer_id and customer_id = ".$customer_id;

            $res = parent::select($table_name, $column, $where_clause);

            return $res;
        }*/
    }
