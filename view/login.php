<?php
include_once ("../controller/UserController.php");

    /*$msg = "";

    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $l = new UserController();
        $lo = $l -> login($username, $password);

        if ($lo) {
            header("location: ../index.php");
        } else {
            $msg = "invalid username or password";
        }
    }*/

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
    <title>Login page</title>
</head>
<body>
    <div class="content">
        <form method="post">
            <fieldset>
                <legend>Login here</legend>
                <h1>Please login</h1>
                <hr>
                <p class="label">Username</p>
                <input type="text" placeholder="username" id="username" name="username"><br>
                <p><?php echo $msg; ?></p>
                <p class="label">Password</p>
                <input type="password" placeholder="password" id="password" name="password"><br><br>
                <input type="submit" value="Login" id="loginButton" name="login"><br>
                <p class="noaccount">Don't have an account yet?</p>
                <input type="submit" value="Signup" id="signupButton" name="signup">
            </fieldset>
        </form>
    </div>
</body>
</html>