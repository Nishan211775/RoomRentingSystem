<?php
    include_once ('../controller/UserController.php');
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile_css.css">
    <title>Messages</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1>Room Renting System</h1>
            <a id="login" href="login.php">Login</a>
            <a id="logout" href="#">Logout</a>
        </div>
        <div class="nav">
            <nav>
                <ul class="navigation">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a class="current" href="profile.php">Profile</a></li>
                </ul>
            </nav>
            <div class="search">
                <input type="text" id="searchBox" placeholder="searh not available">
                <button type="submit" id="searchButton">
                    <img src="../images/search.png" alt="search image"/><b>Search</b>
                </button>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="photo">

        </div>
        <?php
            $user = new UserController();
            $cus = new Customer();
            $cus -> setId(1);
            $data = $user -> showProfile($cus);

            print_r($data);
        ?>
    </div>
</body>
</html>