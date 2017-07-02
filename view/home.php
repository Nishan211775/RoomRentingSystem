<?php
    session_start();
    include_once ("../model/Customer.php");
    $account_type = $_SESSION['account_type'];

    if (!$_SESSION['get_access']) {
        header("location: login.php");
    }

    $btn_text = "BOOK THIS ROOM";

    if (isset($_GET['mes'])) {
        ?>
        <script>
            alert("Room Booked\nYou will get email if the booking is accepted");
        </script>
        <?php
    }
?>

<html>
<head>
    <script src="../js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Home page</title>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#opener").click(function (e) {
                $("#post_room").show();

                e.preventDefault();
            });
        });

    </script>
    
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
                    <li><a class="current" href="home.php">Home</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="notification.php">Notification</a></li>
                    <?php
                    if ($account_type == "Owner") {
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
            if ($account_type == "Owner") {
        ?>
                <p class="info">RoomRenting is the largest online roommate community, helping house owner and agent with portfolios of
                rooms, sing+le or multiple rooms for rent. </p>

                <p class="info">This system makes easy for people for search room as they needed with entire information relating to
                room and then book the rooms in precise way that aims to surplus time and money and allows people to
                easily book any room through web surfing.</p>

                <p class="info">It's free to post your available vacant rooms. </p>

                <div class="link">
                    <a href="" class="link" id="opener">Click here to post your room</a>
                </div>

        <?php


            ?>

                <?php
            } else {
        ?>
                <div id="room_details">
                    <div id="picture">

                    </div>
                    <div id="detail">
                        <?php
                            include_once ("../controller/RoomController.php");
                            $rc = new RoomController();
                            $res = $rc -> showRoomDetails();

                            foreach ($res as $row) {
                                $res1 = $rc -> getRenterDetails($row[6]);
                                foreach ($res1 as $data) {
                                ?>
                                    <div class="room_details">
                                        <div class="picture">
                                            <img src="../images/room/<?php echo $row[8];?>">
                                            <form method="post" action="booking.php?renter_id=<?php echo $data[0]?> &
                                                    room_id=<?php echo $row[0] ?>">
                                                <input type="submit" class="button" id="book" name="book" value="<?php echo $btn_text;?>">
                                            </form>
                                            <form method="post" action="messages.php?receiver_id=<?php echo $data[0]?>">
                                                <input type="submit" class="button" name="message" value="MESSAGE">
                                            </form>
                                            <p><?php echo "Contact: ".$data[3] ?></p>
                                        </div>
                                        <div class="detail">
                                            <table width="412" style="color: white;">
                                                <tr>
                                                    <td colspan="3" style="color: red;background: white; text-align: center;">
                                                        <?php echo $data[1]." ".$data[2]; ?></td>
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
                            }}
                        ?>
                    </div>
                </div>

        <?php
            }
        ?>

        <div id="post_room">
            <form method="post" action="save_room.php">
                    <h1>Please provide detail information</h1><hr>
                    <span>
                    <p>Size of Room</p>
                    <input type="text" placeholder="size in meter" name="size" required="required" class="size">
                </span>
                <span>
                    <p>Number of rooms available to rent?</p>
                    <input type="number" placeholder="no of rooms" name="no_of_rooms" required="required" class="size">
                </span>
                <span>
                    <p>Include price</p>
                    <input type="text" placeholder="price of per room in ruppee" name="price" required="required" class="size">
                </span>
                <span>
                    <p>Location of rooms</p>
                    <input type="text" placeholder="location" name="location" required="required" class="size">
                </span>
                <span>
                    <p>Please choose a photo for your room</p>
                    <input type="file" id="photo_sel" name="photo_sel">
                </span>
                <span>
                    <p>Please provide features of your room</p>
                    <textarea rows="8" cols="50" name="features"></textarea><br>
                </span>
                <input type="submit" value="Save" name="save_room" class="size">
            </form>
        </div>
    </div>
</body>
</html>


