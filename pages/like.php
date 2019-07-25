<?php

	
	$aktpost = $_POST['akt'];
	$aktLikes = $_POST['aktlikes'];
	$newLikes = $aktLikes+1;
	echo $newLikes;
		
		
		$pdo = new PDO('mysql:host=localhost;dbname=mytwitter', 'root', '');
		
		$statement = $pdo->prepare("UPDATE post SET Likes=:like_neu WHERE PostID=:id");
		$statement-> execute(array('like_neu' => $newLikes,'id' => $aktpost));
		
		
		
	
	
?>