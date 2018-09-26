<?php
	define ('DB_Host','localhost');
	define ('DB_User','root');
	define ('DB_Password','123456');

	$conn = mysqli_connect(DB_Host,DB_User,DB_Password,'books');
	if(!$conn){
		die("connection error".mysql_error());
		$dbcr="create database books";
		if(!(mysqli_query($conn,$dbcr))){
			echo "Error creating the Database";
		}
	}
	$table="select * from users";
	if(!(mysqli_query($conn,$table))){
		$create1="create table users(id int(11) NOT NULL AUTO_INCREMENT,username varchar(255) NOT NULL,email varchar(255) NOT NULL, password varchar(255) NOT NULL, name varchar(255), firstName varchar(255), lastName varchar(255), PRIMARY KEY(id))";
		$ok1=mysqli_query($conn,$create1);
		$create2="create table activity(id int(11) NOT NULL AUTO_INCREMENT, bookid varchar(255) NOT NULL,username varchar(255) NOT NULL,public int(11) NOT NULL DEFAULT 0, act text NOT NULL, time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))";
		$ok2=mysqlia_query($conn,$create2);
		$create3="create table comments(id int(11) NOT NULL AUTO_INCREMENT, bookid varchar(255) NOT NULL, username varchar(255) NOT NULL, comment text NOT NULL, rating int(11) NOT NULL, time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))";
		$ok3=mysqli_query($conn,$create3);
		$create4="create table shelf(id int(11) NOT NULL AUTO_INCREMENT, bookid varchar(255) NOT NULL, username varchar(255) NOT NULL,name varchar(255), status varchar(255) NOT NULL,fav int(11) NOT NULL, time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))";
		$ok4=mysqli_query($conn,$create4);
		if((!ok1)||(!ok2)||(!ok3)||(!ok4)){
			echo "Error in creating tables";
		}

	}
?>