 <?php
session_start() ;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X_UA_compatible" content="ie=edge">
	<title>navigation</title>
	<style>
		.body{
			font-family: montserrat;

		}
		.navbar{
			background: #0082e6;
			border-radius: 30px;
			height: 60px;
			width: 100%
		}
		.navbar ul{
			overflow: auto;
		}
		.navbar li{
			float: left;
			list-style: none;
			margin: 13px 20px;


		}
		.navbar li a{
			padding:3px 3px;
			text-decoration: none;
			color: white;
		}
		.navbar li a:hover{
			color: red;
		}
		.search{
			float: right;
			color: white;
			padding:12px 75px;
		}
		.navbar input{
			border:2px solid black;
			border-radius: 14px;
			padding:3px 17px;
			width: 139px;

		}
		
	</style>
</head>
<body>
	<header>
		
		
		<nav class="navbar">
			<ul>
				<li><a href="navbar.php">Employee Details</a></li>
				<li><a href="address.php">Employee Address</a></li>
				<li><a href="academic.php">Employee Academic</a></li>
				<li><a href="department.php">Employee Department</a></li>
				<li><a href="personal_details.php">Employee Personal Details</a></li>
				<div class="search">
					<input type="text" name="search" id="search" placeholder="Search">
					
				</div>
			</ul>
			<div class="image">
			<img src="employee.jpg"  style="  height: 100%; width: 100%;">
			</div>
		</nav>
	</header>
	
	

<?php
include("connection1.php");
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Details</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<div class="center">

		<form action="#" method="POST">

		<h1>Employee Academic Qualification</h1>
		<div class="form">
			
            <?php 
	        $level_res = mysqli_query($conn, "SELECT * FROM level");
             ?>
			<select class="textfield" name="level" required>
				<option value=""></option>
				<?php while($level= mysqli_fetch_array($level_res)){?>
					<option value="<?php echo $level['level_id'];?>"><?php echo $level['level_name'];?></option>
			 <?php } ?>
			</select>

			<?php 
	        $board_res = mysqli_query($conn, "SELECT * FROM board");
             ?>

			<select class="textfield" name="board" required>
				<option value=""></option>
				<?php while($board= mysqli_fetch_array($board_res)){?>
					<option value="<?php echo $board['board_id'];?>"><?php echo $board['board_name'];?></option>
			    <?php } ?> 

			</select>
			
			<input type="text" name="institute_name" class="textfield" placeholder="Name Of The Institute" required>

			<input type="text" name="passed_year" class="textfield" placeholder="Passed Year" required>

			<input type="text" name="division" class="textfield" placeholder="GPA/Percentage" required>

			<input type="submit" name="submit" value="submit" name="" class="btn">
			
			
			
		</div>
		</form>
		
	</div>
	

</body>
</html>



<?php
include("connection1.php");
if(isset($_POST['submit'])){
	 $e_id      = $_SESSION["employee_id"];
	$level      = $_POST['level'];
	$board      = $_POST['board'];
	$institute  = $_POST['institute_name'];
	$passed_year= $_POST['passed_year'];
	$division   = $_POST['division'];

	
	$query = "INSERT INTO academic (e_id,level_id,board_id,institute_name,passed_year,division) VALUES($e_id, $level, $board, '$institute', $passed_year, '$division')";
      
     $data = mysqli_query($conn, $query);
      // var_dump("$data");die();
     if ($data) {
		echo "Data inserted into Database";
	}

	 else{
	 echo "failed to save data";
	}

}
?>

</body>
</html>





