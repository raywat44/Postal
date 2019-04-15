<?php
	session_start();
	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="";
	$dbname="";

	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
		or die ('Could not connect to the database server' . mysqli_connect_error());


		$email = "john.doe@gmail.com";
		$_SESSION['email'] = $email;
		$email = $_SESSION['email'];


		/*
		$query = "SELECT FName, MInit, LName, Email, State, City, ZIP, Street FROM postaldb.customer WHERE Email = \"mysql_real_escape_string($email)\"";
		$resQuery = mysqli_query($con, $query) or die('error?');
		$user = mysqli_fetch_assoc($resQuery);
		*/

		$query = "SELECT FName, MInit, LName, Email, State, City, ZIP, Street	FROM postaldb.customer WHERE Email=$email";

		$ApartmentNo = NULL;
if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($FName, $MInit, $LName, $Email, $State, $City, $ZIP, $Street);
    $stmt->close();
}

?>
	<html>
		<head>
			<title>Profile Page</title>
		</head>
		<body>
			<form align="center" method="post" action="error.php">
                <label for="FName">First Name</label>
								<?php echo $Email; ?>
                <input type="text" name="firstname" value="<?php echo $FName; ?>" contenteditable="true">
                <br>

								<label for="MInit">Middle Initial</label>
                <input type="text" name="middleinitial" value="<?php echo $MInit; ?>" contenteditable="true">
                <br>

                <label for="LName">Last Name</label>
                <input type="text" name="lastname" value="<?php echo $LName; ?>" contenteditable="true">
                <br>

                <label for="Email">Email</label>
                <input type="text" name="email" value="<?php echo $Email; ?>" contenteditable="false">
                <br>

								<label for="State">State</label>
                <input type="text" name="state" value="<?php echo $State; ?>" contenteditable="true">
                <br>

								<label for="City">City</label>
                <input type="text" name="city" value="<?php echo $City; ?>" contenteditable="true">
                <br>

								<label for="ZIP">Zip Code</label>
                <input type="text" name="zip" value="<?php echo $ZIP; ?>" contenteditable="true">
                <br>

                <label for="Street">Address</label>
                <input type="text" name="street" value="<?php echo $Street; ?>" contenteditable="true">
                <br>

								<label for="ApartmentNo">Apartment Number</label>
                <input type="text" name="apartmentnumber" value="<?php echo $ApartmentNo; ?>" contenteditable="true">
                <br>

								<button type = "submit" class = "buttonStyle" name="submit">Submit</button>
                <button type = "reset" class= "buttonStyle" name="reset">Reset</button>
			</form>
		</body>
	</html>

<?php $con->close(); ?>
