<?php include "templates/header.php"; ?>

<div class="container" id="homeBody" style="background-color:lightblue">
<br /> <br /> <br />
	<div class="row">
		<div class="col-xs-6 col-md-offset-3">
		<div id="createBtn">
		<button type="button" class="btn btn-primary"><a href="create.php" style="color:white">Create a coverege</a></button>
		</div>
			<table class="table table-hover">
				<h3>Coverage and Cost Table</h3>
				<thead>
				<tr>
				<th>ID</th>
				<th>Coverage Name</th>
				<th>Cost</th>
				</tr>
			</thead>
			<tbody id="tableGrid">
			<tr><td> loading ... </td></tr>

			</tbody>
			</table>
		</div>
	</div>
</div>


<?php include "templates/footer.php"; ?>