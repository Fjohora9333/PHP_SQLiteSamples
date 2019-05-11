<?php
require "templates/header.php";

		
require "config2.php";
require "../common.php";

if (isset ( $_POST ['submit'] )) {
	try {
		
		
		//YOUR CODE HERE	
		// $connection = new PDO ( $dsn, $username, $password, $options );
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		//echo $dsn;
		
		$coverageName = $_POST ['coverageName'];
		$cost = $_POST ['cost'];
		$id=$_GET['id'];
		//-----------
		// Check if coverage cost combination already exist
		$sql = "SELECT * FROM Coverage WHERE CoverageName = :coverageName and Cost=:cost";
		
		
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':coverageName', $coverageName);
		$statement->bindParam ( ':cost', $cost);
		$statement->execute ();
		
		$result = $statement->fetchAll ();
		
		
		
		if ($result){
			echo "<div class='container' style=\"background-color:lightyellow \"><div class=\"row\"><div class=\"col-xs-6 col-md-offset-3\"><h3>Cost $cost for $coverageName already exists.</h3></div></div></div>";
		}
		else{
		
		//---------
		
		$sql = "update Coverage set CoverageName = :coverageName , Cost = :cost where id=:id";

// 		echo "<h3>SQL:" . $sql . "</h3>";
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':coverageName', $coverageName);
		$statement->bindParam ( ':cost', $cost);
		
		$statement->bindParam ( ':id', $id);
		
		// $statement->execute ( $new_user );
		$statement->execute ();
		
		//put email logic
		
		//$email='zisa92@yahoo.com';
		//$from = 'Demo Contact Form';
		$to = 'Coverages@fredcohen.com​';
		$message="hello";
		$subject = 'Message from Contact Demo ';
		
		 $header = "From:someOne@yahoo.com \r\n";
        if (mail($to, $subject,$message,$header)) {
            //if (mail($to, $subject, $body, $from)) {
            $result = '<div class="alert alert-success">Thank You! I will be in touch</div>';
        } 
		echo "<div class='container' style=\"background-color:lightgreen \"><div class=\"row\"><div class=\"col-xs-6 col-md-offset-3\"><h3>CoverageName " . $coverageName . " updated successfully!</h3></div></div></div>";
	
		}
	} catch ( PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage ();
	}

	//exit();
}
if (isset ( $_GET ['id'] )) {
	
	try {
		
		$connection = new PDO ( $dsn);
		
		$sql = "SELECT * FROM Coverage WHERE id = :id";
		
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
	<div>
	</div>
<div class="container" style="background-color:lightblue ">
<br /> <br /> <br />
	<div class="row">
		<div class="col-xs-4 col-md-offset-4">
<form method="post" id="coverageForm" >
	<?php
	
	$className = "'confirmation'";
	foreach ( $result as $row ) {
		?>
		<input class="BtnBack" type="button" onclick="location.href='index.php';" value="Back to home">
		<br/>
		<h2>Update a Coverage</h2>
		<br><br>
	<label for="coverageName">Coverage Name</label> 
	<input type="text" name="coverageName" id="coverageName" value="<?php echo escape($row["CoverageName"]); ?>"> 
	<br><br>
	<label for="cost">Cost</label>
	<input type="number" name="cost" id="cost" value="<?php echo escape($row["Cost"]); ?>"> 
	<br/><br/><br>
	<input type="hidden" name="id" id="id" value="<?php echo escape($row["id"]); ?>"> 
	<input class="BtnSubmit" type="submit" class=$className name="submit" value="Update">
	<br/>
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


</div>
</div>
</div>

<?php require "templates/footer.php"; ?>