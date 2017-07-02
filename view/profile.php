<?php
    session_start();
    if (!$_SESSION['get_access']) {
        header("location: login.php");
    }

    include_once ('../controller/UserController.php');
    include_once ('../model/Customer.php');

    $uc = new UserController();
    $c= new Customer();
    $c -> setUsername($_SESSION['username']);
    $c -> setPassword($_SESSION['password']);
    $res = $uc -> getUserInfo($c);

    $id = $res[0];
    $first_name = $res[1];
    $last_name = $res[2];
    $username = $res[3];
    $gender = $res[4];
    $contact = $res[5];
    $address = $res[6];
    $account_type = $res[7];
    $city = $res[8];
    $password = $res[9];

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script type="text/javascript">
        $(function () {
            $("#change_profile").click(function () {
                $("#update_profile").dialog({
                    title: "Update your profile here",
                    width: 650,
                    height: 420,
                    resizable: true,
                    position:['middle',180],
                    modal: true,

                    buttons: {
                        Close: function () {
                            $(this).dialog('close');
                        }
                    }
                });
            });
        });
    </script>

    <title>Profile</title>
</head>
<body>

    <div id="update_profile" style="display: none;">
        <table width="650">
            <form method="post" action="update_userinfo.php">
                <tr>
                    <td><p>First Name</p></td>
                    <td><input type="text" id="fname" name="fname" value=<?php echo $first_name; ?>> </td>
                </tr>
                <tr>
                    <td><p>Last Name</p></td>
                    <td><input type="text" id="lname" name="lname" value=<?php echo $last_name; ?>> </td>
                </tr>
                <tr>
                    <td><p>Gender</p></td>
                    <td><input type="text" id="gender" name="gender" value=<?php echo $gender; ?>> </td>
                </tr>
                <tr>
                    <td><p>Contact</p></td>
                    <td><input type="text" id="con" name="con" value=<?php echo $contact; ?>> </td>
                </tr>
                <tr>
                    <td><p>Address</p></td>
                    <td><input type="text" id="add" name="add" value=<?php echo $address; ?>> </td>
                </tr>
                <tr>
                    <td colspan="2"><center><button type="submit" name="updateProfile">Update</button></center></td>
                </tr>
            </form>
        </table>
    </div>

    <div class="header">
        <div class="logo">
            <h1>Room Renting System</h1>

            <a id="logout" href="logout.php">Logout</a>
        </div>
        <div class="nav">
            <nav>
                <ul class="navigation">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a class="current" href="profile.php">Profile</a></li>
                    <li><a href="notification.php">Notification</a></li>
                    <?php
                    if ($_SESSION['account_type'] == "Owner") {
                        ?>
                        <li><a href="room.php">Rooms</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="content">

        <?php
        $user = new UserController();
        $cus = new Customer();
        $cus -> setId($_SESSION['customer_id']);
        $data = $user -> showProfile($cus);

        ?>

        <div class="photo">
            <img class="pic" src="../images/<?php echo $data[11]?>">
        </div>

        <div class="profile">
           <table style="font-size: 30px; color: #afd9ee;">
                <tr>
                    <td colspan="3" class="first-row"><?php echo $data[1]." ".$data[2];?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="second-row">Username</td>
                    <td>&#x21D2</td>
                    <td><?php echo $data[3];?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>&#x21D2</td>
                    <td><?php echo $data[4];?></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>&#x21D2</td>
                    <td><?php echo $data[5];?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>&#x21D2</td>
                    <td><?php echo $data[6];?></td>
                </tr>
                <tr>
                    <td colspan="3"><button type="button" id="change_profile">Update your profile here</button></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>