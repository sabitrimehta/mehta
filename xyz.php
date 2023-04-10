



<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

	// Validate form data
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$address = trim($_POST['address']);
	$phone = trim($_POST['phone']);

	if(empty($name) || empty($email) || empty($address) || empty($phone)){
		echo "Please fill all fields";
	} else {
		// Validate email format
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Invalid email format";
		} else {
			// Validate phone number format
			if(!preg_match("/^[0-9]{10}$/", $phone)){
				echo "Invalid phone number";
			} else {
				// Connect to database
				$servername = "localhost";
				$username = "your_username";
				$password = "your_password";
				$dbname = "your_database_name";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					// Prepare statement to insert data into database
					$stmt = $conn->prepare("INSERT INTO employees (name, email, address, phone) VALUES (:name, :email, :address, :phone)");

					// Bind values of form fields to prepared statement
					$stmt->bindParam(':name', $name);
					$stmt->bindParam(':email', $email);
					$stmt->bindParam(':address', $address);
					$stmt->bindParam(':phone', $phone);

					// Execute the prepared statement to insert data into database
					$stmt->execute();

					// Display success message to user
					echo "Employee data has been successfully saved.";

				} catch(PDOException $e) {
					// Display error message to user
					echo "Error: " . $e->getMessage();
				}

				$conn = null; // Close database connection
			}
		}
	}
}
?>

<!-- HTML form -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="name">Name:</label>
	<input type="text" name="name" id="name"><br><br>

	<label for="email">Email:</label>
	<input type="text" name="email" id="email"><br><br>

	<label for="address">Address:</label>
	<textarea name="address" id="address"></textarea><br><br>
    
	<label for="phone">Phone:</label>
	<input type="text" name="phone" id="phone"><br><br>

	<input type="submit" name="submit"
</form>
</body>
</html>
