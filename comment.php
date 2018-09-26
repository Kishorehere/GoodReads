
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

if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query_2 ="SELECT * FROM comments WHERE bookid ='$id' ORDER BY time DESC;";
		$result_2 =mysqli_query($conn, $query_2);
		$comments = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
		mysqli_free_result($result_2);	
	}

	
if(isset($_POST['comsub'])){	

									$comment = mysqli_real_escape_string($conn, $_POST['comment']);
									$rating= mysqli_real_escape_string($conn, $_POST['rating']);

									if(!empty($comment)){
											
			
											$query = "INSERT INTO comments(bookid,username,comment,rating) VALUES ('$id','$userName','$comment','$rating');";
											$result = mysqli_query($conn, $query);
											$activity = $userName.' commented "'.$comment.'" for : ';
											$query_1 = "INSERT INTO activity(bookid,username,act,public) VALUES ('$id','$userName','$activity','0');";
											$result_1 = mysqli_query($conn, $query_1);
											 

										}

		}


	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query_2 ="SELECT * FROM comments WHERE bookid ='$id' ORDER BY time DESC;";
		$result_2 =mysqli_query($conn, $query_2);
		$comments = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
		mysqli_free_result($result_2);	
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Comments</title>
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
				
			
			<div class="card text-center">

				  
				 
				  <div id="body" class="card-body"></div>
				 

			</div>

	
			<div style="margin-left:5%;margin-top:5%">
					<h1 style ="color:black;"><strong><u>Your comment</u> :</strong></h1>	
			</div>

			
			<form method = "POST" action = "comment.php?id=<?php echo $id;?>" >
					<div class="row justify-content-start" style ="margin-left:130px;margin-top: 70px;">
						    <strong style="margin-top:5px;margin-left:90px;">Comment :</strong>
						    <div class="col-md-3">
						          <textarea class="form-control" name="comment" rows="1"  placeholder="Enter comment" ></textarea>
						    </div>
						    <strong style="margin-top:5px;">Rating :</strong>
						    <div class="col-md-3"> 
							      <select class="custom-select mr-sm-2" name = "rating">
							        <option value="1">1</option>
							        <option value="2">2</option>
							        <option value="3">3</option>
							        <option value="4">4</option>
							        <option value="5">5</option>
							        
							     </select>
						    </div>
							<div class="col-md-3">
					    		<div>
					    			<button type = "submit" class = "btn btn-primary" name ="comsub" >Write</button>
					    		</div>  
					    	</div>
					</div>  	
				</form>
				
			<div style="margin-left:5%;margin-top:5%;">
					<h1 style ="color:black;"><strong><u>Comments</u> :</strong></h1>	
			</div>
				<div style = "width: 80%; margin:auto;margin-top:5%;" >
				<?php foreach($comments as $comment) : ?>

					<div class="card">
						  <div class="card-header">
						   By : <?php echo $comment['username']; ?>
						  </div>
						  <div class="card-body">
						    <h4 class="card-title">Comment : <?php echo $comment['comment']; ?></h4>
						    <h6 class="card-title">Rating : <?php echo $comment['rating']; ?></h6>
						    <p class="card-text">Posted On : <?php echo $comment['time']; ?></p>
						    
						  </div>
					</div>
					<br>
				  
				<?php endforeach ; ?>
				</div>





			   

			</div>
	  <script>

  	var id = "<?php echo $id;?>"
  


	// $.ajax({
	// 	url:"https://www.googleapis.com/books/v1/volumes/"+id,
	// 	dataType:"json",

	// 	success: function(data){

	// 			body.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"
	// 			body.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
	// 			body.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br><br>"
	// 			body.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><br>"
	// 			// body.innerHTML+="<a style ='margin-left:10%;' class='btn btn-warning' href='shelf.php'>Add to Favourites</a><br><br><hr>"
	// 			body.innerHTML+="<h6>Published On:"+data.volumeInfo.publishedDate+"</h6>"
	// 	},
	// 	type: 'GET'
	// });




		var ourRequest = new XMLHttpRequest();
		ourRequest.open('GET',"https://www.googleapis.com/books/v1/volumes/"+id,false);
		ourRequest.onreadystatechange = function() {
			if(ourRequest.status>=200 && ourRequest.status < 400){

				var data = JSON.parse(ourRequest.responseText);
							body.innerHTML+="<h3 class='card-title'>"+data.volumeInfo.title+"</h3><hr><br>"
							body.innerHTML+="<img src="+data.volumeInfo.imageLinks.thumbnail+"><br><br>"		
							body.innerHTML+="<p class='card-text'>"+data.volumeInfo.description+"</p><br><br>"
							body.innerHTML+="<a class='btn btn-primary style ='margin-right:10%;' href="+data.volumeInfo.infoLink+">View in Google Store</a><br><br>"
							body.innerHTML+="<h6>Published On:"+data.volumeInfo.publishedDate+"</h6>"

			}
			else{
				console.log("The server returned an error");
			}
			
		 };

		ourRequest.onerror = function(){
			console.log("Connection Error");
		};
		ourRequest.send();





  </script>
	

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>