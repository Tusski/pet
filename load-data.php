<?php

require "config.php";

use App\Pet;

try {
	Pet::register('Richard', 'Doberman', 'Rich');
	header("Location: index.php");
	echo "<li>Added 1 pet</li>";

	$pets = [
		[
			'name' => 'Albert',
			'breed' => 'Chihuahua',
			'owner_name' => 'Eins'
		],
		[
			'name' => 'Pol',
			'breed' => 'Askal',
			'owner_name' => 'Paul'
		]
	];
	Pet::registerMany($pets);
	echo "<li>Added " . count($pets) . " more pets</li>";
	echo "<br /><a href='index.php'>Proceed to Index Page</a>";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

?>