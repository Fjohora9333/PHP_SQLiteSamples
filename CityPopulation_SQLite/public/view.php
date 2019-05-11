<?php
require "templates/header.php";

try {

    require "config2.php";
    require "../common.php";

    // $connection = new PDO ( $dsn, $username, $password, $options );
    $connection = new PDO($dsn);

    $sql = "SELECT * FROM CityPopulation";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>




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
	$className = "'confirmation'";
	foreach ($result as $row) {
?>
			<tr>
			<td><?php echo escape($row["id"]); ?></td>
			<td><?php echo escape($row["cityName"]); ?></td>
			<td><?php echo escape($row["population"]); ?></td>
			<td><?php echo "<a class=$className href="."update.php?id=".($row["id"]).">Update"; ?> </td>
			<td><?php echo "<a href="."delete.php?id=".($row["id"]).">Delete"; ?> </td>
		</tr>
<?php
	}
?>
		</tbody>
</table>
<?php
// }

?>


<a href="index.php">Back to home</a>

<?php require "templates/footer.php";?>