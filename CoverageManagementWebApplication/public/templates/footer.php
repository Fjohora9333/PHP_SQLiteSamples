</body>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
   // var elems = document.getElementsByClassName('confirmation');
   $(document).ready(function()
   {
	   //var elems = $(".confirmation");

		
		
		//when its in the index page then only we'll have the #tableGrid element
		if($("#tableGrid").length)
		{
			loadGridData();
		}
		
		if($("#coverageForm").length){
			$("#coverageForm").submit(function(event){
				//var x=$("#cost").val();
				//alert(x);
			
				if($("#coverageName").length){
					var x=$("#coverageName").val();
					var y=$("#cost").val();
					
					console.log(y);
					if(x!="Auto" && x!="Property" && x!="Legal Expense"){
						event.preventDefault();
						alert("Name must be Auto or Property or Legal Expense");
					}
					if(y<=0){
						event.preventDefault();
						alert("Cost must be a positive integer");
					}
				}
			//event.preventDefault();
		});
		}
		//check integer on submit click
		
		

		//$( ".confirmation").on( "click", confirmIt );
		
		// for (var i = 0, l = elems.length; i < l; i++) {
			// console.log(elems[i].id);
		   //elems[i].addEventListener('click', confirmIt, false);
		   
	
	
	});
	function deleteRow(idn){
		console.log("deleteid: "+idn);
		$.ajax({
			type:'Post',
			url:'delete.php',
			data:{
				id:idn
			},
			success: function(result){
				loadGridData();
			}
		});
	}
	
	function loadGridData()
	{
		//var confirmIt = function (e) {
			//if (!confirm('Are you sure?')) e.preventDefault();
		//};
		$.ajax({
			async: true, 
			type: 'Post',
		url : 'tableGridRow.php',
		success : function(data) {
		    $('#tableGrid').html(data);
			//$( ".confirmation").on( "click", confirmIt );
			$(".delButton").click(function(e){
				if (!confirm('Are you sure?')){
				e.preventDefault();
				}
				else{
				deleteRow($(this).attr('id'));
				}
		});
		}
	    });
	}
	
	
</script>
</html>