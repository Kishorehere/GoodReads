<?php
	require('server.php');
?>
<?php if(isset($_SESSION['userName'])) : ?>	
<?php
	
	$userName = $_SESSION['userName'];
	$query_1= "SELECT * FROM users";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);


	$query_2 ="SELECT * FROM activity WHERE username ='$userName' ORDER BY id;";
	$result_2 =mysqli_query($conn, $query_2);
	$acts = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
	mysqli_free_result($result_2);




	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Activity</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
   

</head>
<body>

	

		<nav class="navbar navbar-expand-md navbar-dark bg-dark ">
		    <a href="#" class="navbar-brand">Good-Reads</a>
		    <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		      	<li class="nav-item"><a href="shelf.php" class = "nav-link">Book Shelf</a></li>
		        <li class="nav-item"><a href="#" data-toggle="modal" data-target ="#demo" class = "nav-link">Profile</a></li>
		        <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link">Logout</a></li>
		        </ul>
		    </div>
		</nav>
		

		<div class="modal fade" id = "demo">
	      <div class ="modal-dialog">
	        <div class = "modal-content">
	          
	          <div class = "modal-header">
	            <h2 class = "modal-title">Profile</h2>
	            <span type ='button' class = "close" data-dismiss = "modal">&times;</span>
	          </div>
	          <div class = "modal-body">
	          	
	          	<table class="table table-dark">
				  <tbody>
				    <tr >
				      <th scope="row">Name: </th>
				      <td ><?php echo $value['name']; ?></td>
				      
				    </tr>
				    <tr class="bg-primary">
				      <th scope="row">E-mail: </th>
				      <td><?php echo $value['email']; ?></td>
				     
				    </tr>
				    <tr class="bg-danger">
				      <th scope="row">Username: </th>
				      <td><?php echo $userName; ?></td>
				      
				    </tr>
				  </tbody>
				</table>
	         
	          </div>
	          <div class = "row" style ="padding-top: 0;padding-bottom: 1.5rem;padding-left: 1rem;">
		        <div class = "col-md-6 col-sm-6 col-xs-6">
		           <a href="editProfile.php"><button type = "button" class = "btn btn-success" >Edit Profile</button></a>
		        </div>
		        <div class = "col-md-6 col-sm-6 col-xs-6">
	            	 <a href="changePass.php"><button type = "button" class = "btn btn-success" >Change Password</button></a>
	          	</div>
	          </div>

	        </div>
	      </div>
	    </div>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		 


		<div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: black;border-radius: 10px;border-width: 5px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center;">	
			<div class="row justify-content-end">
				<div class="col-md-8">
					<h1 style ="margin-left:30px;color:black;"><strong><u>Activity</u> :</strong></h1>
				</div>

				<div class="col-md-3">

				</div>
			</div>

			
				
			
		<?php for($i = 1;$i<=count($acts);$i++){ ?>	
			<?php $divid = "body".$i; ?>
			<div class="card text-center">
				  <div id="body1" class="card-body">Search for books to start</div>
			</div>
		<?php } ?>
	</div>

		<script>

			<?php $w = 0; ?>

			<?php foreach ($acts as $act) : ?>
				<?php $w=$w + 1; ?>
				var id = "<?php $act['bookid']; ?>"
				$.ajax({
					url:"https://www.googleapis.com/books/v1/volumes/"+id,
					dataType:"json",

					success: function(data){

							 body<?php echo json_encode($w); ?>.innerHTML="<h3>Hello</h3>"

							//body<?php echo $w; ?>.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"
							
							// body<?php echo $w; ?>.innerHTML+="<hr>"
							// body1.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
							// //body1.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br>"
							// body1.innerHTML+="<h3>Status :"+"<?php echo $group['status'];?>"+"</h3><br>"
							// body1.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><hr>"
							// body1.innerHTML+="<h6>Added On:"+"<?php echo $group['time'];?>"+"</h6><hr><br><br>"
					},
					type: 'GET'
				});

			<?php endforeach ; ?>
	
		</script>




	
	

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>



	body<?php echo $w; ?>.innerHTML="<h3>Hello</h3>"

	body<?php echo $w; ?>.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"

	body<?php echo $w; ?>.innerHTML+="<hr>"
	 // body1.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
	 // body1.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br>"
	 // body1.innerHTML+="<h3>Status :"+"<?php echo $group['status'];?>"+"</h3><br>"
	 // body1.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><hr>"
	 // body1.innerHTML+="<h6>Added On:"+"<?php echo $group['time'];?>"+"</h6><hr><br><br>"