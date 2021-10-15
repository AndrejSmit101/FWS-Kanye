<?php
    require_once('includes/Models/database.php');
    require_once('includes/Controllers/controller.php');
	if(isset($_POST['submit'])) {
		$token = $_POST['token'];
        $controller->checkToken($token);
		header("Location: index.html");
	}
?>
<head>
	<title>Kanye Quotes</title>
	<style>
	body {
    text-align: center;
}
	.form {
    display: inline-block;
}
	</style>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="/favicon.png" />
</head>
<body>

<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $message; ?></h4>

<form class="form" id="login-id" action="" method="post">

<div class="form-group">
	<input type="text" class="form-control" placeholder="Token" name="token" value="<?php echo htmlentities($token); ?>" >

</div>

<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>
</div>
</body>