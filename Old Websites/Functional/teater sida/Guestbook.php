<html>
	<head>
		<title>GästBok</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/guestbookStyle.css">
		<link rel="stylesheet" href="css/Footer.css">
		<link rel="stylesheet" href="css/Header.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/Javascript.js"></script>

	</head>

	<body>

				<!--PHP-->
		<!--******************************************************-->

		<?php

			error_reporting(E_ALL ^ E_NOTICE);
			//connect to mysql
			$con = mysqli_connect("localhost", "root", "password");
			mysqli_select_db($con, "guestbook");


			//add Stuff

			if($_POST['postbtn']){
				$name = strip_tags($_POST['name']);
				$email = strip_tags($_POST['email']);
				$message = strip_tags($_POST['message']);

				if($name && $email && $message){
					
					$time = date("h:i A");
					$date = date("F d, Y");
					$ip = $_SERVER['REMOTE_ADDR'];

					$query = "INSERT INTO guestbook (name,email,message,time,date) VALUES ('$name','$email','$message','$time','$date')";

					$result = mysqli_query($con, $query);
				}else
					echo "You did not enter all the required fields!";
			}
			//close
			mysqli_close($con);
		?>

		<div class="container-fluid wrapper">

			<!-- Header -->
			<div class="header-nav" id="topnav">
				<a href="Guestbook.php" class="active">Gästbok</a>
				<a href="kontakt.html">Kontakta oss</a>
				<a href="Shower.html">Shower</a>
				<a href="index.php">Startsida</a>
				<a href="javascript:void(0);" class="icon" onclick="navbarMenuToggle()">&#9776;</a>
				<a ref="index.php" id="logo"><img class="img-responsive img-fluid" src="Bilder/Logo.png"></a>
			</div>
            
            <div class="main-content">

            	<div id="Guestbook-header" class="col-sm-12">
            		<h1>GästBok</h1>
            		<p>Läs vad andra tycker om våran teater och/eller lämna en egen åsikt!</p>
            	</div>

				<form id="postForm" action='Guestbook.php' method='post' class="col-md-8 col-md-offset-2">
					<h2>Lämna din åsikt!</h2>
					<table style="width: 100%">
						<tr>
							<td><input type="text" name="name" placeholder="Namn" maxlength="25"/></td>
						</tr>
						<tr>
							<td><input type="text" name="email" placeholder="Email" maxlength="50"/></td>
						</tr>
						<tr>
							<td><textarea name="message" placeholder="Meddelande" maxlength="1000" ></textarea></td>
						</tr>
						<tr>
							<td><input type="submit" name="postbtn" value="Skicka"/></td>
						</tr>
					</table>
				</form>

				<div class="col-xs-12 col-md-10 col-md-offset-1 commentsbox">

					<h2 style="text-align: center;">Kommentarer</h2>

					<table class="col-xs-12">
						<?php
							
							$con = mysqli_connect("localhost", "root", "password");
							mysqli_select_db($con, "guestbook");
							$results = mysqli_query($con,"SELECT * FROM guestbook ORDER BY id DESC");
							if (mysqli_num_rows($results) == 0){
								echo "<p style='color: white; font-size: 20px; text-align:center'>Det finns inga kommentarer för tillfället, var det första till att kommentera!</p>";
							}
								while ($row = mysqli_fetch_assoc($results)) : ?>
							 
							 		<tr class="col-xs-12 commentheader $class">
										<td id="name"><?= $row['name'] ?></td>
										<td id="time"><?= $row['time'] ?></td>
										<td id="date"><?= $row['date'] ?></td>
									</tr>

									<tr class="col-xs-12 commentrow $class">
										<td id="text"><?= $row['message'] ?></td>
									</tr>

						<?php endwhile ?>
					</table>
				</div>
            </div>

            <!-- Footer -->
			<div class="col-md-12 col-sm-12 footer" style="padding: 0;">
				<!-- Footer text -->
				<div class="col-md-12 col-sm-12 footer-block" style="padding: 0;">
                    <p>&copy; 2017 Universal Teatern. All rights reserved | Universal Teatern<i class="fa fa-facebook-square" aria-hidden="true"></i></p>
                </div>
                <div class="col-md-12 col-sm-12 sponsors">
                	<ul>
                		<li><a href=""><img src="bilder/Facebook.png"></a></li>
                		<li><a href=""><img src="bilder/Facebook.png"></a></li>
                		<li><a href=""><img src="bilder/Facebook.png"></a></li>
                		<li><a href=""><img src="bilder/Facebook.png"></a></li>
                		<li><a href=""><img src="bilder/Facebook.png"></a></li>
                		<li><a href=""><img src="bilder/Facebook.png"></a></li>
                	</ul>
                </div>
			</div>

		</div>

	</body>
</html>