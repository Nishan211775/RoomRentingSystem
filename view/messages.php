<?php
session_start();
include_once ("../controller/MessageController.php");
include_once ("../controller/UserController.php");
include_once ("../model/Messaging.php");

if (!$_SESSION['get_access']) {
    header("location: login.php");
}

if ($_SESSION['receiver_id'] = "") {
    $id = 0;
} else {
    $id = $_SESSION['receiver_id'];
}

$username[0] = '';
$receiver_id = 0;
if (isset($_GET['receiver_id'])) {
    $receiver_id = $_GET['receiver_id'];
    $uc = new UserController();
    $username = $uc -> getUsername($receiver_id);
}

if (isset($_GET['id'])) {
    $receiver_id = $_GET['id'];
}

$mes = new Messaging();
$mes -> setSenderId($receiver_id);
$mes -> setReceiverId($_SESSION['customer_id']);

$mescon = new MessageController();
$res = $mescon -> showMessage($mes);
$senders = $mescon -> getSenderName($_SESSION['customer_id']);

    
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/messagning.css">
    <title>Messages</title>
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
                    <li><a class="current" href="messages.php">Messages</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="notification.php">Notification</a></li>
                    <li><a href="room.php">Rooms</a></li>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="content">
        <div style="width: 65%; float: left; border-right: 5px dashed red; padding: 10px;">
            <form method="post" action="message.php">
            <div class="to">
                <p style="float: left; margin-top: 0">TO:</p>
                <textarea style="float: left; margin-left: 50px;" cols="30" name="username" id="username"
                          placeholder="Enter a username"><?php echo $username[0]; ?></textarea>
            </div>
            <div class="message">
                <textarea placeholder="write your message here" name="message" id="message" cols="50" rows="10"></textarea>
                <input type="submit" value="Send" name="send">
            </div>
            <div class="message_log" id="message_log">
                <?php
                    foreach ($res as $rows) {
                        ?>
                            <table>
                                <tr>
                                    <td><?php echo $rows[3]; ?></td><hr>
                                </tr>
                            </table>
                        <?php
                    }
                ?>
            </div>
        </form>
        </div>
        
        <div style="width: 25%; float: left; padding: 10px;">
            <table style="color: yellow;" width=100%>
                <tr style="font-size: 30px; background: red; height: 50px; width: 100%;">
                    <td>Users</td>
                </tr>
                <?php
                    foreach ($senders as $rows) {
                        $id = $mescon -> getId($rows[0]);
                        ?>
                            <tr>
                                <td><a href="?id=<?php echo $id[0] ?>" name="show_message"><?php echo $rows[0]; ?></a></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>