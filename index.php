<html>
<head>
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
            <div class="search">
                <input type="text" id="searchBox" placeholder="search by city">
                <button type="submit" id="searchButton">
                    <img src="images/search.png" alt="search image"/><b>Search</b>
                </button>
            </div>
        </div>
    </div>
    
    <div class="content">
        <?php
            echo "This is home page"."<br />";
            echo "Hello nishan";
        ?>
    </div>
</body>
</html>