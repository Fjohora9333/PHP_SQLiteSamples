
<?php
try {

    require "config2.php";
    require "../common.php";

    // $connection = new PDO ( $dsn, $username, $password, $options );
    $connection = new PDO($dsn);

    $sql = "SELECT * FROM Coverage";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>
<?php
	$className = "'confirmation'";
	foreach ($result as $row) {
?>
		<tr>
			<td><?php echo escape($row["id"]); ?></td>
			<td><?php echo escape($row["CoverageName"]); ?></td>
			<td><?php echo escape($row["Cost"]); ?></td>
			<td><button type="button" class="btn btn-primary"><?php echo "<a href="."update.php?id=".($row["id"]).">Update"; ?></button> </td>
			<td><button type="button" id="<?php echo $row["id"] ?>" class="btn btn-primary delButton confirmation ">Delete</button> </td>
		</tr>
<?php

	}
?>