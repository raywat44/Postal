<?php session_start();
  $host="localhost";
  $port=3306;
  $socket="";
  $user="root";
  $password="";
  $dbname="postaldb";

  $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die ('Could not connect to the database server' . mysqli_connect_error());

  $email = $_SESSION['email'];

  if(isset($_POST['submit']))
  {
    $first = $_POST['firstname'];
    $middle = $_POST['middleinitial'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $street = $_POST['street'];
    $apartment = $_POST['apartmentnumber'];

  $query = "SELECT * FROM customer WHERE Email='$email'";
  $result = mysqli_query($con, $query);
  $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $success = true;

//check if empty
  if(empty($first) || empty($middle) || empty($last)|| empty($email) || empty($state) || empty($city) || empty($zip) || empty($street)){
      mysqli_close($con);
			echo "One of the fields was left empty";
      $success = false;
		}
    elseif(!preg_match("/^[0-9]{5}$/",$zip)){
      mysqli_close($con);
      echo "Zipcode is too long";
      $success = false;
    }
    elseif(!preg_match("/[0-9]/",$zip)){
      mysqli_close($con);
			echo "Zipcode must contain only numbers";
      $success = false;
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      mysqli_close($con);
      echo "Must be a valid email";
      $success = false;
    }

    if($success)
    {
      echo "Update successful! <br>";
      $upquery = "UPDATE customer
      SET FName = '$first', MInit = '$middle', LName = '$last', Email = '$email', State = '$state', City = '$city', ZIP = '$zip', Street = '$street', ApartmentNo = '$apartment'
      WHERE Email = '$email'";
    }

    $result = mysqli_query($con, $upquery);
    mysqli_close($con);

  }

?>

<html>
  <head>
    <title>Errors?</title>
  </head>
  <body>
    <a href="profile_page.php">Back</a>
  </body>
</html>
