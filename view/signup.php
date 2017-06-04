<?php

    include_once("../model/Customer.php");
    include_once ("../model/photo.php");
    include_once ("../controller/UserController.php");

    if(isset($_POST['submitButton'])) {
        //$image_name = $_FILES['image_upload']['name'];
        //$image = addslashes(file_get_contents($_FILES['image_upload']['tmp_name']));

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

        $p = new Photo();
        $p -> setPhotoId(NULL);
        $p -> setPhotoName($image_name);
        $p -> setCustomerId(1);
        $p -> setRoomId(NULL);

        $c = new UserController();
        $res = $c -> register($r);
        $res1 = $c -> photo($p);

         if (move_uploaded_file($_FILES['image_upload']['tmp_name'], $target)) {
             //echo "Successfull";
         } else {
             echo error_reporting(E_ALL);
         }

         if ($res > 1 || $res1 > 1) {
             ?>
             <script>
                 alert("Successfull");
             </script>
             <?php

         } else {
             echo $res1;
             ?>
             <script>
                 alert("Unable to signup");
             </script>
             <?php
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
                <input class="size" type="text" placeholder="username" name="username">
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