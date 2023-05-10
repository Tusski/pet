<?php

require "config.php";

use App\Pet;

$pet_id = $_GET['id'];

$pet = Pet::getById($pet_id, $conn);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Pet</title>
</head>
<body>
	<h1>Edit Pet</h1>

	<form action="save-changes.php?id=<?php echo $pet->getId(); ?>" method="POST">
		<div>
			<label>Name</label><br>
			<input type="text" name="name" placeholder="Name" value="<?php echo $pet->getName();?>" />	
		</div>
		<div>
			<label>Breed</label><br>
			<input type="text" name="breed" placeholder="Breed" value="<?php echo $pet->getBreed();?>" />	
		</div>
		<div>
			<label>Birthdate</label><br>
			<input type="text" name="birthdate" placeholder="Birthdate" value="<?php echo $pet->getBirthdate();?>" />	
		</div>
		<div>
			<label>Owner Name</label><br>
			<input type="text" name="ownername" placeholder="Owner Name" value="<?php echo $pet->getOwnerName();?>" />	
		</div>
		<div>
			<label>Gender</label><br>
			<input type="text" name="gender" placeholder="Gender" value="<?php echo $pet->getGender();?>" />	
		</div>
		<div>
			<label>Address</label><br>
			<input type="text" name="address" placeholder="Address" value="<?php echo $pet->getAddress();?>" />	
		</div>
		<div>
			<label>email</label><br>
			<input type="text" name="email" placeholder="Email" value="<?php echo $pet->getEmail();?>" />	
		</div>
		<div>
			<label>Contact Number</label><br>
			<input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $pet->getContactNumber();?>" />	
		</div>
		<div>
			<button type="submit">
				Save
			</button>
			<a href="index.php">Cancel</a>
		</div>
	</form>
</body>
</html>
