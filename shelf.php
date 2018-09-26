<?php
	require('server.php');
?>
<?php if(isset($_SESSION['userName'])) : ?>	
<?php
	$set = 0;//check if inserted
	$home = 1;
	
	
	$userName = $_SESSION['userName'];
	$query_1= "SELECT * FROM users";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);

if(isset($_GET['id'])){
		$id = $_GET['id'];
		$home = 0;
	}
	
	

if(isset($_POST['addshelf'])){	

		$status = mysqli_real_escape_string($conn, $_POST['status']);
		$fav = 0;
		if(isset($_POST['fav'])){
			$fav = 1;
		}

		if(!empty($status)){
				

				$query = "INSERT INTO shelf(bookid,username,status,fav) VALUES ('$id','$userName','$status','$fav');";
				$result = mysqli_query($conn, $query);
				$set = 1;
				switch($status){
						case 'want to read':
							$activity=$userName." wants to read";
							break;
						case 'currently reading':
							$activity=$userName." is currently reading";
							break;
						case 'finished reading':
							$activity=$userName." finished reading";
							break;
						
						}
						   
			
				$query = "INSERT INTO activity(bookid,username,act,public) VALUES ('$id','$userName','$activity','0');";
				$result = mysqli_query($conn, $query);

			}

	}
	
		$query_2 ="SELECT * FROM shelf WHERE username ='$userName' ORDER BY id;";
		$result_2 =mysqli_query($conn, $query_2);
		$groups = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
		mysqli_free_result($result_2);	



if(isset($_GET['favo']))
{	
				$query_2 ="SELECT * FROM shelf WHERE username ='$userName' AND fav = '1' ORDER BY id;";
				$result_2 =mysqli_query($conn, $query_2);
				$groups = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
				mysqli_free_result($result_2);
					

	}

	


?>

<!DOCTYPE html>
<html>
<head>
	<title>Book Shelf</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

   

</head>
<body>

	

		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		    <a href="#" class="navbar-brand">Good-Reads</a>
		    <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		      	<li class="nav-item"><a href="index.php"class = "nav-link">Home</a></li>
		      	<li class="nav-item"><a href="activity.php"class = "nav-link">Activity</a></li>
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


		<div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: black;border-radius: 10px;border-width: 5px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center;">	
				
		<?php if($set == 0 && $home == 0) :?>	
			

			<div class="card text-center">
				  <div id="body" class="card-body"></div> 
			</div>

			
			<form method = "POST" action = "shelf.php?id=<?php echo $id;?>" >
					<div style="margin-left:12%;margin-top:5%">
							<h1 style ="color:black;"><strong><u>Add</u> :</strong></h1>	
					</div>
					<div class="row justify-content-start" style ="margin-left:130px;margin-top: 70px;">
						    <strong style="margin-top:5px;margin-left:90px;">Add to Favourites ?</strong>
						    <div class="col-md-2">
						           <input type="checkbox" style="margin-top:12px;" id="defaultCheck1" name="fav">
									 <label class="form-check-label" for="defaultCheck1">
									   Yes 
									  </label>
				
						    </div>
						    <strong style="margin-top:5px;">Status :</strong>
						    <div class="col-md-3"> 
							      <select class="custom-select mr-sm-2" name = "status">
							        <option value="want to read">want to read</option>
							        <option value="currently reading">currently reading</option>
							        <option value="finished reading">finished reading</option>
							        
							     </select>
						    </div>
							<div class="col-md-3">
					    		<div>
					    			<button type = "submit" class = "btn btn-primary" name ="addshelf" >Add to shelf</button>
					    		</div>  
					    	</div>
					</div> 
					<br><br>
					<hr>
					 	
				</form>


				
		<?php endif; ?>


			<div class="row justify-content-end" style ="margin-top: 5%;">

				<div class="col-md-8">
					<h1 style ="margin-left:30px;color:black;"><strong><u>Your Shelf</u> :</strong></h1>
				</div>

				<div class="col-md-3">
					<a href="shelf.php?favo='1'" class="btn btn-primary">Favourites</a>
					<a href="shelf.php" style = "width:100px;" class="btn btn-primary">All</a>

				</div>
			</div>

			<!-- <div style="margin-left:5%;margin-top:5%;">
					<h1 style ="color:black;"><strong><u>Your Shelf</u> :</strong></h1>	
			</div> -->
			<div style = "width: 80%; margin:auto;margin-top:5%;" >
			<div class="card text-center">
				  <div><br><br></div>
				  <div id="body1" class="card-body"></div>
			</div>
		</div>




			   

	</div>




<script>

  	<?php if(isset($_GET['id'])) : ?>
		
  	var id = "<?php echo $id;?>"
  	console.log("there!");
  	
  	var ourRequest = new XMLHttpRequest();
	ourRequest.open('GET',"https://www.googleapis.com/books/v1/volumes/"+id,false);
	// ourRequest.onload = function(){
	ourRequest.onreadystatechange = function() {
		
		if(ourRequest.status>=200 && ourRequest.status < 400){

			var data = JSON.parse(ourRequest.responseText);
			renderHTML1(data);

			
		}
		else{
			console.log("The server returned an error");
		}
		
	};

	ourRequest.onerror = function(){
		console.log("Connection Error");
	};
	ourRequest.send();

	function renderHTML1(data){
			body.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"
			body.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
			body.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br><br>"
			body.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><hr>"
			body.innerHTML+="<h6>Published On:"+data.volumeInfo.publishedDate+"</h6>"
		}

	// $.ajax({
	// 	url:"https://www.googleapis.com/books/v1/volumes/"+id,
	// 	dataType:"json",

	// 	success: function(data){

	// 			body.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"
	// 			body.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
	// 			body.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br><br>"
	// 			body.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><hr>"
	// 			body.innerHTML+="<h6>Published On:"+data.volumeInfo.publishedDate+"</h6>"
	// 	},
	// 	type: 'GET'
	// });

	<?php endif; ?>

	<?php foreach($groups as $group) : ?>

			var id = "<?php echo $group['bookid']; ?>";
			console.log("<?php echo $group['bookid']; ?>");
 


			var ourRequest = new XMLHttpRequest();


			ourRequest.open('GET',"https://www.googleapis.com/books/v1/volumes/"+id+"?key=AIzaSyB1Baxv_J7o14-pvRV_AXRJ_aWn0MiFcw0",false);
			// ourRequest.onload = function(){
				ourRequest.onreadystatechange = function() {
				
				if(ourRequest.status>=200 && ourRequest.status < 400){

					var data = JSON.parse(ourRequest.responseText);
					renderHTML(data);

					
				}
				else{
					console.log("The server returned an error");
				}
				
			};

			ourRequest.onerror = function(){
				console.log("Connection Error");
			};
			ourRequest.send();
			
		
		function renderHTML(data){
					
						
		 				body1.innerHTML+="<hr>"
		 				body1.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"
		 				body1.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
		 				//body1.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br>"
		 				body1.innerHTML+="<h3>Status :"+"<?php echo $group['status'];?>"+"</h3><br>"
		 				body1.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><hr>"
		 				body1.innerHTML+="<h6>Added On:"+"<?php echo $group['time'];?>"+"</h6><hr><br><br>"
						
					

		 }
		
		 <?php endforeach ; ?>

	

  </script>
	

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>