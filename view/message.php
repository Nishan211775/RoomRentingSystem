<?php
include_once ("../model/Messaging.php");
include_once ("../controller/MessageController.php");
include_once ("../controller/UserController.php");
include_once ("../model/Customer.php");
session_start();
/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 6/25/2017
 * Time: 11:27 AM
 */

if (isset($_POST['send'])) {
	$username = $_POST['username'];
	$message = $_POST['message'];
}

if (!(is_null($username) || is_null($message))) {
	$cus = new Customer();
	$cus -> setUsername($username);

	$cuscon = new UserController();
	$res = $cuscon -> getRenterId($cus);

	$mes = new Messaging();
	$mes -> setMessageId(NULL);
	$mes -> setSenderId($_SESSION['customer_id']);
	$mes -> setReceiverId($res[0]);
	$mes -> setMessage($message);

	$mescon = new MessageController();
	$res = $mescon -> sendMessage($mes);

	if ($res > 0) {
		$_SESSION['receiver_id'] = $res[0];
	}

	header("location: messages.php");

} else {
	?>
	<script type="text/javascript">
		alert("Please enter all the field");
	</script>
	<?php
}



