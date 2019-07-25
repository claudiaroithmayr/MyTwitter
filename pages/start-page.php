<?php


?>
<div id="hauptbox">
<center>
<div id="box">
<div id="header">
<h1 id="ueberschrift"> MyTwitter </h1>
<hr id="hr1">

	<form id="form1" method="post"action="http://localhost/MyTwitter/pages/newpost.php">
		<input type="submit" name="addpost" value="Add new post" id="newpost">
	</form>
</div>

	
	<?php
	
	$pdo = new PDO('mysql:host=localhost;dbname=mytwitter', 'root', '');
		
		$sql = "SELECT * FROM post";
		foreach ($pdo->query($sql) as $row) {
			$aktpost = $row['PostID'];
			$img = $row['Image'];
			$anz_likes = $row['Likes'];
			
			?>
			<div id="post">
				
				<div id="title">
					<?php
					echo "<b>".$row['Titel']."</b>";
					?>
				</div>
			
				<div id="inhalt">
					<?php
					echo "<br />"."<br />"." ".$row['Inhalt']."<br />";
					?>
				</div>
				
				
					<?php
					if($img != ""){
					?>
					<img id="img"src = "<?php echo $img; ?>">
					<?php
					}
					?>
				
				
				<div id="likes">
					<?php
					echo "Likes:" ." ".$anz_likes;
					
					?>
					<form method="post" >
						<input id="aktpost" type="text" name="akt" value="<?php echo $aktpost; ?>"> </input>
						<input id="aktpost" type="text" name="aktlikes" value="<?php echo $anz_likes; ?>"> </input>
						<input id="like_button" type="submit" name="like" value="Like" />
					</form>
					
				</div>
			
		</div>
		<?php
		}
		
		
		
	?>
	</div>
	
<?php


	if(isset($_POST['like'])){
		liken();
	}
					
	function liken(){
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$aktpost = $_POST['akt'];
			$aktLikes = $_POST['aktlikes'];
			$newLikes = $aktLikes+1;
			
			
			$pdo = new PDO('mysql:host=localhost;dbname=mytwitter', 'root', '');
			
			$statement = $pdo->prepare("UPDATE post SET Likes=:like_neu WHERE PostID=:id");
			$statement-> execute(array('like_neu' => $newLikes,'id' => $aktpost));
			header("Location:".$_SERVER['REQUEST_URI']);
	}
	}
	
	
	
?>
</div>	
			