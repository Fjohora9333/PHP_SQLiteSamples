<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

if (isset ( $_POST ['submit'] )) {
	
	require "config.php";
	require "../common.php";
	
	try {
		// $connection = new PDO ( $dsn, $username, $password, $options );
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		echo $dsn;
		
		$cityName = $_POST ['cityName'];
		$population = $_POST ['population'];
		
		$sql = "INSERT INTO CityPopulation (cityName,population) VALUES (:cityName,:population)";
// 		echo "<h3>SQL:" . $sql . "</h3>";
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':cityName', $cityName);
		$statement->bindParam ( ':population', $population);
		
		// $statement->execute ( $new_user );
		$statement->execute ();
	} catch ( PDOException $error ) {
		echo "<h1>Error Creating City: </br></h1>";
		echo $sql . "<br>" . $error->getMessage ();
		exit ();
	}
}
?>

<?php require "templates/header.php"; ?>

<?php
if (isset ( $_POST ['submit'] ) && $statement) {
	?>
<blockquote><?php echo $_POST['cityName']; ?> successfully added.</blockquote>
<?php
}
?>

<h2>Add a city</h2>

<form method="post">
	<label for="cityName">City Name</label> 
	<input type="text" name="cityName" id="cityName">
	
	<label for="population">Population</label>
	<input type="INTEGER" name="population" id="population">
	
	
	<input type="submit" name="submit" value="Submit"></br>
</form>
</br>
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>