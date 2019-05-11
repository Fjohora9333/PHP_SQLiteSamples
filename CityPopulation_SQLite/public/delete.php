<?php

if (isset ( $_GET ['id'] )) {
	
	try {
		
		require "config2.php";
		require "../common.php";
		
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		//YOUR CODE HERE	
		 $sql = "DELETE FROM CityPopulation WHERE id = :id";
		$id = $_GET ['id'];
        $statement = $connection->prepare ( $sql );
        $statement->bindParam(':id', $id);
        $statement->execute ();		
		
		
	} catch ( PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage ();
	}
	
	echo "<br>City Successfully Deleted!<br>";
	
	
}
?>
<br>
<a href="index.php">Back to home</a>



<?php require "templates/footer.php"; ?>