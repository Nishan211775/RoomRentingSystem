<?php
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 5/17/2017
 * Time: 1:38 PM
 */
    include("../DBConnection/DBConnection.php");
    class Action extends DBConnection{
        private $conn;

        public function Action() {
            parent::DBConnection();
            $this -> conn = parent::getConnection();
        }

        /**
         * @param $table_name
         * @param $value
         * @return bool|mysqli_result|string
         */

        /**
         * Associative array = it is an abstract data type composed of a collection of (key, value) pairs, such
         * that each possible key appears at most once in the collection.
         * 1 trim() = The trim() function is used to remove the white spaces and other predefined
         * characters from left and right sides of a string
         * 2 array_keys() = Return all the values of an array
         * 3 implode() = The implode() function returns a string from the elements of an array.
         * implode(seperator, array)
         * 3.1 seperator = Optional. Specifies what to put between the array elements. Default is ""(an empty string)
         * 3.2 array = required. The array to join to a string
         * 4 substr() = returns a part of a string
         * 5 strtoupper() = converts a string into uppercase
         */

        public function insert($table_name, $value) {
            $column = array_keys($value);
            $data = array_values($value);

            $sql = "INSERT INTO ".$table_name."(`".implode('` , `', $column)."`) VALUES('".implode("','", $data)."')";

            return parent::getConnection() -> query($sql);
        }

        /*public function insert($table_name, $value) {
            $res = 0;
            $column = array_keys($value);
            $array = array_values($column);
            $count = sizeof($value);
            $qnm = array();

            for($i = 0; $i < $count; $i++) {
                $qnm[] = '?';
            }

            $sql = "INSERT INTO ".$table_name."(`".implode('` , `', $column)."`) VALUES(NULL, '".implode("','", $qnm)."')";
            try {

                $stmt = $this -> conn -> prepare($sql);
                $stmt -> bind_param("sss", $fa);
                $res = $stmt -> execute();

            } catch (Exception $e) {
                echo $e;
            }
            return $res;
        }*/

        public function select($table_name, $value, $where_clause) {
            $table_name1 = array($table_name);
            $value1 = array($value);
            $whereSQL = '';
            if(!empty($where_clause)) {
                if(substr(strtoupper(trim($where_clause)), 0, 5 != 'WHERE')) {
                    $this -> $whereSQL = " WHERE ".$where_clause;
                } else {
                    $this -> $whereSQL = " ".trim($where_clause);
                }
            }

            $sql = "SELECT ".implode(', ',$value1)." FROM ".implode(', ', $table_name1).$whereSQL;

            if($sql) {
                return $this -> conn -> query($sql) -> fetch_assoc();
            } else {

            }
        }


        public function update($table_name, $value, $where_clause='') {
            //check for optional where clause
            $whereSQl = '';
            if(!empty($where_clause)) {
                //check to see if the 'where' keyboard exists
                if(substr(strtoupper(trim($where_clause)), 0, 5 != 'WHERE')) {
                    //not found, add key word
                    $this -> $whereSQL = " WHERE ".$where_clause;
                } else {
                    $this -> $whereSQl = " ".trim($where_clause);
                }
            }
            //start the actual SQL statement
            $sql = "UPDATE ".$table_name." SET ";

            //loop and build the column
            $sets = array();
            foreach($value as $column => $data) {
                $sets[] = "`".$column."` = '".$data."'";
            }

            $sql .= implode(', ', $sets);

            //append the where statement
            $sql .= $whereSQl;

            //run and return the query result
            return $this -> conn -> query($sql);
        }
    }
