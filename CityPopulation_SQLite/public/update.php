<?php
require "templates/header.php";

if (isset ( $_POST ['submit'] )) {
	try {
		
		require "config2.php";
		require "../common.php";
		
		//YOUR CODE HERE	
		// $connection = new PDO ( $dsn, $username, $password, $options );
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		//echo $dsn;
		
		$cityName = $_POST ['cityName'];
		$population = $_POST ['population'];
		$id=$_GET['id'];
		
		$sql = "update CityPopulation set cityName = :cityName , population = :population where id=:id";

// 		echo "<h3>SQL:" . $sql . "</h3>";
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':cityName', $cityName);
		$statement->bindParam ( ':population', $population);
		
		$statement->bindParam ( ':id', $id);
		
		// $statement->execute ( $new_user );
		$statement->execute ();
		
		
	} catch ( PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage ();
	}
	echo "</br></br><h3>City" . $cityName . " updated successfully!</h3>";
	echo "</br><a href='index.php'>Back to home</a>";
	exit();
}
if (isset ( $_GET ['id'] )) {
	
	try {
		
		require "config2.php";
		require "../common.php";
		
		$connection = new PDO ( $dsn);
		
		$sql = "SELECT * FROM CityPopulation WHERE id = :id";
		
		// $location = $_POST ['location'];
		$id = $_GET ['id'];
		
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':id', $id );
		$statement->execute ();
		
		$result = $statement->fetchAll ();
	} catch ( PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage ();
	}
}
?>
		
		
		
<?php
if ($result) {
	?>

<form method="post">
	<?php
	foreach ( $result as $row ) {
		?>
	<label for="cityName">City Name</label> 
	<input type="text" name="cityName" id="cityName" value="<?php echo escape($row["cityName"]); ?>"> 
	<label for="population">Population</label>
	<input type="text" name="population" id="population" value="<?php echo escape($row["population"]); ?>"> 
	</br></br>
	<input type="hidden" name="id" id="id" value="<?php echo escape($row["id"]); ?>"> 
	<input type="submit" name="submit" value="Update">
	</br>
</form>
<?php
	}
	?>
<?php
} else {
	?>
<blockquote>No results found for <?php echo escape($_GET['id']); ?>.</blockquote>
<?php
}

?>
</br>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>