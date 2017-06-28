<?php

    session_start();

    include_once ("../controller/UserController.php");
    include_once ("../model/Customer.php");

    $message = '';

    if (isset($_POST['login'])) {
        $c = new Customer();
        $c -> setUsername($_POST['username']);
        $c -> setPassword($_POST['password']);

        $u = new UserController();
        $res = $u -> login($c);
        $profile = $u -> getUserInfo($c);


        if ($res) {
            header('location: ../index.php');
            $_SESSION['get_access'] = true;
            $_SESSION['customer_id'] = $profile[0];
            $_SESSION['username'] = $profile[3];
            $_SESSION['password'] = $profile[9];
            $_SESSION['account_type'] = $profile[7];
        } else {
            $message = "Either username or password is wrong";
        }
    }
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
                <p class="message"><?php echo $message;  ?></p>
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