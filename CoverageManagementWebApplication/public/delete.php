<?php

if (isset ( $_POST ['id'] )) {
	
	try {
		
		require "config2.php";
		require "../common.php";
		
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		//YOUR CODE HERE	
		 $sql = "DELETE FROM Coverage WHERE id = :id";
		$id = $_POST ['id'];
        $statement = $connection->prepare ( $sql );
        $statement->bindParam(':id', $id);
        $statement->execute ();		
		
		
	} catch ( PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage ();
	}
	
	echo "<br>Coverage Name Successfully Deleted!<br>";
	
	
}
?>
<br>
<a href="index.php">Back to home</a>



<?php require "templates/footer.php"; ?>