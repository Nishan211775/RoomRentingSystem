<?php
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
            } else {
        ?>


        <?php
            }
        ?>

        <div id="post_room">
            <form method="post" action="">
                <h1>Please provide detail information</h1>
                <p>Size of your room</p>
                <input type="text" placeholder="size" required="required">
                <p>How many rooms do you want to rent?</p>
                <input type="text" placeholder="no of rooms" required="required">
                <p>Include price</p>
                <input type="text" placeholder="price of per room" required="required">
                <p>Location of rooms</p>
                <input type="text" placeholder="location" required="required">
                <p>Please provide features of your room</p>
                <textarea  rows="8" cols="50"
            </form>
        </div>

    </div>
</body>
</html>

<div id="post_room">
    <form action="" method="post">
        Enter your room name<input type="text">
        <input type="button" id="save" value="save">
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        /*$("#opener").click(function (e) {
            $("#post_room").show();

            e.preventDefault();
        });*/

        $("#post_room").$dialog({
            autoOpen: false,
            height: 500,
            width: 500,
            modal: true

            button: [
                {
                    text: "Cancel",
                    click: function () {
                        $(this).$dialog("close");
                    }
                }
                {
                    text: "Submit",
                    click: function () {
                        $("#post_room").submit();
                    }
                }
            ]
        });

        $("#opener").click(function () {
            $("#post_room").$dialog("open");
        });
    });
</script>
