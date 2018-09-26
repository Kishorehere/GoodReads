// $(document).ready(function(){

// 	$("#myform").submit(function(){
// 		var search = $("#books").val();
// 		console.log("search");
// 		if(search ==""){
// 			alert("Field Empty");

// 		}else{
// 			var url ="";
// 			var img ="";
// 			var title ="";
// 			var author ="";

// 			$.get("https://www.googleapis.com/books/v1/volumes?q="+search,function(response){
// 					console.log(response);
// 			});


// 		}
// 	});

// img=$('<img class ="" id =""><br><a href ='+response.items[i].volumeInfoLink+'>');
// title = $('<h5 class ="card-text">'+response.items[i].volumeInfo.title+'</h5>');

// 	return false;
// });

// var $img ="";
// title.appendTo('#divname');

// var id =""
// var btn =""
// function bookSearch(){
// 	var search = document.getElementById('books').value
// 	document.getElementById('body').innerHTML=""
// 	console.log(search)

// 	$.ajax({
// 		url:"https://www.googleapis.com/books/v1/volumes?q="+search,
// 		dataType:"json",

// 		success: function(data){
// 			for(i=0;i<data.items.length;i++){
// 				var id = data.items[i].id
				
// 				body.innerHTML+="<h5>Book: "+(i+1)+"</h5><hr>"
// 				body.innerHTML+="<h3 class='card-title'>"+data.items[i].volumeInfo.title+"</h3><br>"
// 				body.innerHTML+="<img src="+data.items[i].volumeInfo.imageLinks.thumbnail+"><br><br>"		
// 				body.innerHTML+="<p class='card-text'>"+data.items[i].volumeInfo.description+"</p><br><br>"
// 				body.innerHTML+="<a class='btn btn-primary' href="+data.items[i].volumeInfo.infoLink+">View in Google Store</a>"
// 				// body.innerHTML+="<button style='margin-left:10%;margin-right:10%;' class = 'btn btn-primary'id ="+btn+">Like</button>"
// 				body.innerHTML+="<a class='btn btn-primary' style='margin-left:10%;margin-right:10%;'  href=shelf.php?id="+id+">Move to Bookshelf</a>"
// 				body.innerHTML+="<a class='btn btn-success' href=comment.php?id="+id+">Comments</a><br><hr>"

// 				body.innerHTML+="<h6>Published On:"+data.items[i].volumeInfo.publishedDate+"<hr><br><hr></h6>"

				
// 			}
// 		},
// 		type: 'GET'
// 	});
// }


function bookSearch(){
	var search = document.getElementById('books').value
	document.getElementById('body').innerHTML=""
	console.log(search)

	var ourRequest = new XMLHttpRequest();

	ourRequest.open('GET',"https://www.googleapis.com/books/v1/volumes?q="+search,false);

	ourRequest.onload = function(){
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
}
function renderHTML(data){
	for(i=0;i<data.items.length;i++){
				var id = data.items[i].id
				
				body.innerHTML+="<h5>Book: "+(i+1)+"</h5><hr>"
				body.innerHTML+="<h3 class='card-title'>"+data.items[i].volumeInfo.title+"</h3><br>"
				body.innerHTML+="<img src="+data.items[i].volumeInfo.imageLinks.thumbnail+"><br><br>"		
				body.innerHTML+="<p class='card-text'>"+data.items[i].volumeInfo.description+"</p><br><br>"
				body.innerHTML+="<a class='btn btn-primary' href="+data.items[i].volumeInfo.infoLink+">View in Google Store</a>"
				// body.innerHTML+="<button style='margin-left:10%;margin-right:10%;' class = 'btn btn-primary'id ="+btn+">Like</button>"
				body.innerHTML+="<a class='btn btn-primary' style='margin-left:10%;margin-right:10%;'  href=shelf.php?id="+id+">Move to Bookshelf</a>"
				body.innerHTML+="<a class='btn btn-success' href=comment.php?id="+id+">Comments</a><br><hr>"

				body.innerHTML+="<h6>Published On:"+data.items[i].volumeInfo.publishedDate+"<hr><br><hr></h6>"

				
			}

}
document.getElementById('button').addEventListener('click',bookSearch,false);

// function likefun(){
// 					console.log("liked")
// 					btn.innerHTML="Liked"
					
// 				}
// document.getElementById(btn).addEventListener('click',likefun,false);

// 	document.getElementById('body').innerHTML=""
// 	console.log(search)

// 	$.ajax({
// 		url:"https://www.googleapis.com/books/v1/volumes/"+id,
// 		dataType:"json",

// 		success: function(data){
// 			for(i=0;i<data.items.length;i++){

// 				body.innerHTML+="<h5>Book: "+(i+1)+"</h5><hr>"
// 				body.innerHTML+="<h3 class='card-title'>"+data.items[i].volumeInfo.title+"</h3><br>"
// 				body.innerHTML+="<img src="+data.items[i].volumeInfo.imageLinks.thumbnail+"><br><br>"		
// 				body.innerHTML+="<p class='card-text'>"+data.items[i].volumeInfo.description+"</p><br><br>"
// 				body.innerHTML+="<a class='btn btn-primary' href="+data.items[i].volumeInfo.infoLink+">Read More</a>"
// 				body.innerHTML+="<a style ='margin-left:10%;margin-right:10%;' class='btn btn-warning' href="+data.items[i].volumeInfo.infoLink+">Add to Favourites</a>"
// 				body.innerHTML+="<h6>Published On:"+data.items[i].volumeInfo.publishedDate+"<hr><br><hr></h6>"
// 			}
// 		},
// 		type: 'GET'
// 	});
// }
// document.getElementById('book').addEventListener('click',bookFind,false);
 