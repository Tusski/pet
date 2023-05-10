<?php

require "config.php";

use App\Pet;

// Save the Pet information, and automatically redirect to index

try {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$breed = $_POST['breed'];
	$birthdate = $_POST['birthdate'];
	$ownerName = $_POST['ownername'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$contact_number = $_POST['contact_number'];

	$result = Pet::update($id, $name, $breed, $birthdate, $ownerName, $gender, $address, $email, $contact_number);

	if ($result) {
		header('Location: index.php');
	}

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}
