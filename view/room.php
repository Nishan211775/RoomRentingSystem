<?php
    session_start();
    include_once("../model/Room.php");
    include_once("../controller/RoomController.php");

    $room = new Room();
    $room -> setRenterId($_SESSION['customer_id']);

    $romcon = new RoomController();
    $res = $romcon -> getRoom($room);

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Rooms</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1>Room Renting System</h1>
            <a id="login" href="login.php">Login</a>
            <a id="logout" href="logout.php">Logout</a>
        </div>
        <div class="nav">
            <nav>
                <ul class="navigation">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="notification.php">Notification</a></li>
                    <li><a class="current" href="room.php">Rooms</a></li>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="content">
        <?php
                            $rc = new RoomController();
                            $res = $rc -> showRoomDetails();

                            foreach ($res as $row) {
                                $res1 = $rc -> getRenterDetails($row[6]);
                                ?>
                                    <div class="room_details">
                                        <div class="picture">
                                            <img src="../images/room/<?php echo $row[8];?>">
                                            <form method="post" action="booking.php?renter_id=<?php echo $res1[0]?> &
                                                    room_id=<?php echo $row[0] ?>">
                                                <input type="submit" class="button" id="book" name="book" value="<?php echo $btn_text;?>">
                                            </form>
                                            <form method="post" action="messages.php?receiver_id=<?php echo $res1[0]?>">
                                                <input type="submit" class="button" name="message" value="MESSAGE">
                                            </form>
                                            <p><?php echo "Contact: ".$res1[3] ?></p>
                                        </div>
                                        <div class="detail">
                                            <table width="412" style="color: white;">
                                                <tr>
                                                    <td colspan="3" style="color: red;background: white; text-align: center;">
                                                        <?php echo $res1[1]." ".$res1[2]; ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Size of room</td>
                                                    <td>&#8594</td>
                                                    <td><?php echo $row[1]." meter"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No of rooms</td>
                                                    <td>&#8594</td>
                                                    <td><?php echo $row[2]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Location</td>
                                                    <td>&#8594</td>
                                                    <td><?php echo $row[4]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="color:yellow; text-align: center; background: green;
                                                    margin-top:15px; border: 2px solid blue;" colspan="3">
                                                        <?php echo "Price: Rs ".$row[3]?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="color: #FAEBD7; text-align: justify; font-size: 15px">
                                                        &#8226<?php echo $row[5]; ?></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                            }
                        ?>
   </div>
</body>
</html>


