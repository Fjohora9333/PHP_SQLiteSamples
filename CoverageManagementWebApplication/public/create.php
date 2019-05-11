<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
 require "templates/header.php";
 
 $errCost="";
 
if (isset ( $_POST ['submit'] )) {
	
	require "config2.php";
	require "../common.php";
	
	try {
		// $connection = new PDO ( $dsn, $username, $password, $options );
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		//echo $dsn;
		
		$coverageName = $_POST ['coverageName'];
		$cost = $_POST ['cost'];
		//-----------
		
		if(!$_POST ['cost']){
			$errCost="Please enter a cost";
		}
		
		//-----------
		
		//validation for input name
		if($coverageName!="Auto" && $coverageName!="Property" && $coverageName!="Legal Expanse"){
			echo "Please enter Auto or Property or Legal Expanse";
			exit();
		}
		
		// Check if coverage cost combination already exist
		$sql = "SELECT * FROM Coverage WHERE CoverageName = :coverageName and Cost=:cost";
		
		
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':coverageName', $coverageName);
		$statement->bindParam ( ':cost', $cost);
		$statement->execute ();
		
		$result = $statement->fetchAll ();
		
		if ($result){
			echo "<div class='container' style=\" background-color:lightyellow\" ><div class=\"col-xs-6 col-md-offset-3\"><h3>Cost $cost for $coverageName already exists.<h3></div></div>";
		}
		else{
			
		
		
			//doing the insert
			$sql = "INSERT INTO Coverage (CoverageName,Cost) VALUES (:coverageName,:cost)";
	
			$statement = $connection->prepare ( $sql );
			$statement->bindParam ( ':coverageName', $coverageName);
			$statement->bindParam ( ':cost', $cost);
			
			// $statement->execute ( $new_user );
			$statement->execute ();
			//put email logic
			
			$to = 'Coverages@fredcohen.com​';
			$message="hello";
			$subject = 'Message from Contact Demo ';
			
			 $header = "From:someOne@yahoo.com \r\n";
			if (mail($to, $subject,$message,$header)) {
				//if (mail($to, $subject, $body, $from)) {
				$result = '<div class="alert alert-success">Thank You! I will be in touch</div>';
			} 
			
			echo "<div class='container' style=\"background-color:lightgreen \"><div class=\"row\"><div class=\"col-xs-6 col-md-offset-3\"><h3>CoverageName " . $coverageName ." successfully added!</h3></div></div></div>";
		}
	} catch ( PDOException $error ) {
		echo "<h1>Error Creating Coverage: </br></h1>";
		echo $sql . "<br>" . $error->getMessage ();
		exit ();
	}
}
?>



<?php
if (isset ( $_POST ['submit'] ) && $statement) {
	?>

<?php
}
?>
<div class="container" id="homeBody" style="background-color:lightblue">
<br /> 
	<div class="row">
		<div class="col-xs-4 col-md-offset-4">
		<br><br>
			<input class="BtnBack" type="button" onclick="location.href='index.php';" value="Back to home" >
		<br/>
<h2 style="text-align:center;">Add a Coverage</h2>
<br><br>
<form method="post" id="coverageForm">
	<label for="coverageName">Coverage Name</label> 
	<input type="text" name="coverageName" id="coverageName">
	<br><br>
	<label for="cost">Cost</label>
	<input type="number" name="cost" id="cost">
     <br><br><br>
	<input class="BtnSubmit" type="submit" name="submit" value="Submit"></br><br>

	
						<?php echo "<p class='text-danger'>$errCost</p>"; ?>	
</form>
</br>


</div>
</div>
</div>

<?php require "templates/footer.php"; ?>