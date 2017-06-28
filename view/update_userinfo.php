<?php
session_start();
include_once ("../controller/UserController.php");
include_once ("../model/Customer.php");
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/18/2017
 * Time: 1:31 PM
 */

if (isset($_POST['updateProfile'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gen = $_POST['gender'];
    $con = $_POST['con'];
    $add = $_POST['add'];

    $c = new Customer();
    $c -> setId($_SESSION['customer_id']);
    $c -> setFirstName($fname);
    $c -> setLastName($lname);
    $c -> setGender($gen);
    $c -> setContact($con);
    $c -> setAddress($add);

    $uc = new UserController();
    $uc -> updateProfile($c);

    if ($uc > 0) {
        ?>
        <script>
            alert("Update Successfull")
        </script>

        <?php
        header("location: profile.php");
    } else {
        ?>
        <script>
            alert("Unable to update your info");
        </script>
        <?php
        header("location: profile.php");
    }
}