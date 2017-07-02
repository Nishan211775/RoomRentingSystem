<?php
include_once ("../controller/BookingController.php");
include_once ("../controller/UserController.php");
include_once ("../model/Customer.php");
include_once ("../model/Booking.php");
include_once ("../controller/RoomController.php");

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/21/2017
 * Time: 2:45 PM
 */

session_start();

if (!$_SESSION['get_access']) {
    header("location: login.php");
}

$b = new Booking();
$b -> setCustomerId($_SESSION['customer_id']);

$bc = new BookingController();
$res = $bc -> viewBooking($_SESSION['customer_id']);
$not = $bc -> notifyUser($b);

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/notification.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <title>Notification</title><!-- 
    <script type="text/javascript">
        $(function () {
            $("#show_profile").click(function (e) {
                $("#user_profile").dialog({
                    title: "Profile is here",
                    width: 1220,
                    height: 900,
                    resizable: true,
                    position:['middle',150],
                    modal: true,

                    button: {
                        Close: function () {
                            $(this).dialog('close');
                        }
                    }
                });
                e.preventDefault();
            });
        });

    </script> -->
</head>
<body>
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
                <li><a href="profile.php">Profile</a></li>
                <li><a class="current" href="notification.php">Notification</a></li>
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
<?php if(!isset($_GET['id'])){ ?>
<div class="content">
    <?php
        if ($_SESSION['account_type'] == "Owner") {
            foreach ($res as $row) {
                $booking_id = $row[0];
                $customer_id = $row[1];
                $renter_id = $row[2];
                $room_id = $row[3];

                $customer_name = $bc -> getCustomerName($customer_id);
                $photo_name = $bc -> getPhotoName($room_id);
                ?>
                <div class="booking">
                    <div class="info">
                        <div class="pic">
                            <img src="../images/room/<?php echo $photo_name; ?>">
                        </div>
                        <div class="information">
                            <form method="post">
                                <!--<p style="color: white;">Your room having id = <?php//echo $room_id; ?>
                                    is booked by <br><a id="show_profile" href="#?id=<?php //echo $customer_id; ?>">
                                        <?php //echo $customer_name; ?></a></p>-->
                                <p style="color: white;">Your room having id = <?php echo $room_id; ?>
                                    is booked by <br>
                                        <a id="show_profile" href="notification.php?id=<?php echo $customer_id; ?>">
                                        <?php echo $customer_name; ?></a></p>
                            </form>
                        </div>
                    </div><hr>

                    <div class="conformation">
                        <div class="sure">
                            <p>Are you sure want to accept this booking?</p>
                        </div>
                        <div class="activity">
                            <form method="post" action="accept_booking.php?id=<?php echo $booking_id; ?>">
                                <input type="submit" class="buttons" value = "ACCEPT">
                            </form>
                            <form method="post" action="decline_booking.php?id=<?php echo $booking_id; ?>">
                                <input type="submit" class="buttons" value="DECLINE">
                            </form>
                        </div>
                    </div>
                </div>

                <?php
            }
        } elseif  ($_SESSION['account_type'] == "Seeker") {
            if ($not) {
                //$renter_id = $not[0];
                //$room_id = $not[1];

                $r = new RoomController();


                foreach ($not as $row) {
                    $res = $r -> getRenterDetails($row[1]);
                    foreach ($res as $rows) {
                        ?>
                        <div style="width: 700px; height: 50px; margin-left: auto; margin-right: auto;">
                            <p>Your room bookig has been accepted. Please check your <a href="http://www.gmail.com">email</a></p>
                        </div><hr>
                    <?php
                    }
                }

            } else {
                echo "You have no new notification";
            }

        }

    ?>
</div>
<?php } 
else { ?>
    
<div id="user_profile" name="user_profile" style="display: block; background: rgb(37, 37, 37);">

    <?php
    $user = new UserController();
    $cus = new Customer();
        $cus -> setId($_GET['id']);
    $data = $user -> showProfile($cus);

    ?>

    <div class="photo">
        <img style="width: 100%" class="pic" src="../images/<?php echo $data[11]?>">
    </div>
    <div class="profile">
        <table style="font-size: 30px; color: #afd9ee;">
            <tr>
                <td colspan="3" class="first-row"><?php echo $data[1]." ".$data[2]; ?></td>
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
        </table>
    </div>
</div>
<?php } ?>

</body>
</html>
