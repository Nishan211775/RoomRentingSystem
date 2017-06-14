<?php
    include_once ("model/photo.php");
    session_start();
    $account_type = $_SESSION['account_type'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Home page</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1>Room Renting System</h1>
            <a id="login" href="view/login.php">Login</a>
            <a id="logout" href="#">Logout</a>
        </div>
        <div class="nav">
            <nav>
                <ul class="navigation">
                    <li><a class="current" href="index.php">Home</a></li>
                    <li><a href="view/messages.php">Messages</a></li>
                    <li><a href="view/profile.php">Profile</a></li>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="content">
        <?php
            if ($account_type == 'Owner') {
        ?>
                <p class="info">RoomRenting is the largest online roommate community, helping house owner and agent with portfolios of
                rooms, single or multiple rooms for rent. </p>

                <p class="info">This system makes easy for people for search room as they needed with entire information relating to
                room and then book the rooms in precise way that aims to surplus time and money and allows people to
                easily book any room through web surfing.</p>

                <p class="info">It's free to post your available vacant rooms. </p>

                <div class="link">
                    <a href="" class="link" id="opener">Click here to post your room</a>
                </div>

        <?php
            if (isset($_POST['save_room'])) {

                $target = "images/room" . basename($_FILES['photo_selector']['name']);
                $image_name = $_FILES['photo_selector']['name'];

                $size = $_POST['size'];
                $no_of_rooms = $_POST['no_of_rooms'];
                $price = $_POST['price'];
                $location = $_POST['location'];
                $photo = $_POST['photo_selector'];
                $features = $_POST['features'];

                $photo = new Photo();
                $room = new Room();
                $room_controller = new RoomController();
                $photo_controller = new PhotoController();

                $room->setRoomId(NULL);
                $room->setSize($size);
                $room->setNoOfRooms($no_of_rooms);
                $room->setPrice($price);
                $room->setLocation($location);
                $room->setFeatures($photo);
                $room->setRenterId($features);

                $photo->setPhotoId(NULL);
                $photo->setPhotoName($image_name);
                $photo->setCustomerId(NULL);
                $photo->setRoomId(NULL);

                $room_controller->createRoom($room);
                $photo_controller->insertImage($photo);

                move_uploaded_file($_FILES['photo_selector']['tmp_name'], $target);
            }
            ?>

                <?php
            } else {
        ?>


        <?php
            }
        ?>

        <div id="post_room">
            <form method="post" action="">
                <h1>Please provide detail information</h1><hr>
                <span>
                    <p>Size of Room</p>
                    <input type="text" placeholder="size in meter" name="size" required="required" class="size">
                </span>
                <span>
                    <p>Number of rooms available to rent?</p>
                    <input type="text" placeholder="no of rooms" name="no_of_rooms" required="required" class="size">
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
                    <input type="file" id="photo_selector" name="photo_selector">
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#opener").click(function (e) {
            $("#post_room").show();

            e.preventDefault();
        });
    });
</script>
