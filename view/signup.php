<?php

    include_once("../model/Customer.php");
    include_once ("../model/photo.php");
    include_once ("../controller/UserController.php");
    include_once ("../DBConnection/DBConnection.php");

    $d = new DBConnection();
    $sql = "select MAX(customer_id) from customer";
    $sql1 = "select username from customer";
    $res = $d -> getConnection() -> query($sql);
    $res1 = $d -> getConnection() -> query($sql1);
    $row = mysqli_fetch_row($res);
    $row1 = mysqli_fetch_row($res1);

    $message = "";
    $message_username = '';

    if(isset($_POST['submitButton'])) {
        if (!in_array($_POST['username'], $row1)) {
            if ($_POST['password'] == $_POST['repassword']) {
                $target = "../images/".basename($_FILES['image_upload']['name']);
                $image_name = $_FILES['image_upload']['name'];

                $r = new Customer();
                $r -> setId(NULL);
                $r -> setFirstName($_POST['firstname']);
                $r -> setLastName($_POST['lastname']);
                $r -> setUsername($_POST['username']);
                $r -> setGender($_POST['gender']);
                $r -> setContact($_POST['contact']);
                $r -> setAddress($_POST['address']);
                $r -> setAccountType($_POST['accounttype']);
                $r -> setCity($_POST['city']);
                $r -> setPassword($_POST['password']);

                $p = new Photo();
                $p -> setPhotoId(NULL);
                $p -> setPhotoName($image_name);
                $p -> setCustomerId($row[0]+1);
                $p -> setRoomId(NULL);

                $c = new UserController();
                $res = $c -> register($r);
                $res1 = $c -> photo($p);

                if (move_uploaded_file($_FILES['image_upload']['tmp_name'], $target)) {
                    //echo "Successfull";
                } else {
                    echo error_reporting(E_ALL);
                }

                if ($res > 0 || $res1 > 0) {
                    header('location: ../index.php');
                } else {
                    echo $res."<br>";
                    echo $res1;
                    ?>
                    <script>
                        alert("Unable to signup");
                    </script>
                    <?php
                }
            } else {
                $message = "Password mismatch";
            }
        } else {
            $message_username = 'Username already exists';
        }

    }
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/signupStyle.css">
    <title>Signup</title>
</head>
<body>
    <img src="../images/signup_background.jpg" alt="background photo">
    <div class="wrap">
        <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <h1>Fill the form</h1><hr>
                <p>First Name</p>
                <input class="size" type="text" placeholder="first name" name="firstname">
                <p>Last Name</p>
                <input class="size" type="text" placeholder="last name" name="lastname">
                <p>username</p>
                <input class="size" type="email" placeholder="email" name="username">
                <p class="message"><?php echo $message_username; ?></p>
                <P>Select gender</P>
                <input type="radio" value="Male" name="gender" required="required"><b>Male</b>
                <input type="radio" value="Female" name="gender" required="required"><b>Female</b>
                <p>Address</p>
                <input class="size" type="text" placeholder="address" name="address">
                <p>Contact</p>
                <input class="size" type="text" placeholder="contact" name="contact">
                <P>Choose account type</P>
                <input type="radio" value="Owner" name="accounttype" required="required"><b>Owner</b>
                <input type="radio" value="Seeker" name="accounttype" required="required"><b>Seeker</b>
                <p>Choose a city for room</p>
                <select name="city">
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Panchkhal">Panchkhal</option>
                    <option value="Dipayel">Dipayel</option>
                    <option value="Birendranagar">Birendranagar</option>
                    <option value="Butwal">Butwal</option>
                    <option value="Dharan">Dharan</option>
                    <option value="Hetauda">Hetauda</option>
                    <option value="Bhaktapur">Bhaktapur</option>
                </select>
                <p>Enter a new password</p>
                <input class="size" type="password" placeholder="password" name="password" required="required">
                <p>Re-enter your password</p>
                <input class="size" type="password" placeholder="retype password" name="repassword" required="required">
                <p class="message"><?php echo $message; ?></php></p>
                <p>Choose your profile picture</p>
                <div class="image">
                    <input type="file" value="Choose picture" id="choose" name="image_upload" accept="image/png, image/jpeg">
                </div>
                <input class="size" type="submit" value="Create Account" id="create" name="submitButton">
            </form>

            <div class="info"> 
                <?php
                    echo "Hello this is nishan";
                ?>
            </div>
        </div>
    </div>    
</body>
</html>