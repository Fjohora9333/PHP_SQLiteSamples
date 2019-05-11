<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) 
{
	
	try 
	{
		
		require "config2.php";
		require "../common.php";

// 		$connection = new PDO($dsn, $username, $password, $options);
		$connection = new PDO ( $dsn );

		$sql = "SELECT * 
						FROM CityPopulation
						WHERE cityName = :cityName";

		$cityName = $_POST['cityName'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':cityName', $cityName, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) 
{
	if ($result) 
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>City Name</th>
					<th>Population</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["cityName"]); ?></td>
				<td><?php echo escape($row["population"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['cityName']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Find population based on city Name</h2>

<form method="post">
	<label for="cityName">City Name</label>
	<input type="text" id="cityName" name="cityName">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>