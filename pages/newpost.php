

	<h1> Neuen Post erstellen </h1><br>
	<table>
		<form method="post" action="" enctype="multipart/form-data">
	
			<!-- Titel -->
			<tr>
				<td>
					<label>Titel:</label>
				</td>
				<td>
  					<input id="input" name="posttitle" type="text" />
				</td>
			</tr>
			
			<!-- Inhalt -->
			<tr>
				<td>
					<label>Inhalt: </label>
				</td>
				<td>
  					<textarea rows="3" cols="50" name = "postcontent"> </textarea>
				</td>
			</tr>
			
			<!-- Bild -->
			<tr>
				<td>
					<label>Bild hochladen: </label>
				</td>
				<td>
  					<input type="file" name="datei">
				</td>
			</tr>
			
			<!-- Submit-Button -->
			<tr>
				<td>
					<input type = "submit" name = "initData" value = "Speichern" onclick = "initPost()"> &nbsp; </input>
				</td>
			</tr>
		
	
		</form>
	</table>
	
	<form method="post"action="http://localhost/MyTwitter/">
	<input type="submit" name="addpost" value="Zurück zur Startseite">
</form>
<?php
   
   if(isset($_POST['initData'])){
     initPost();
   }
  
  
  function initPost(){
	  
	  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		  $title = $_POST['posttitle'];
		  $beschreibung = $_POST['postcontent'];
		  $img = $_FILES['datei'];
		  $folder = "uploads/";
		  
		  $upload_folder = '../uploads/'; //Das Upload-Verzeichnis
		  $filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
		  $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
		  
		  $new_path = $upload_folder.$filename.'.'.$extension;
		  
		  move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
		  echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';
		  
		  
		$pdo = new PDO('mysql:host=localhost;dbname=mytwitter', 'root', '');
		 
		$statement = $pdo->prepare("INSERT INTO post (Benutzerid,Titel,Inhalt,Image,Likes) VALUES (?, ?, ?, ?, ?)");
		$statement->execute(array('1', $title, $beschreibung,$folder.$filename.".jpg",0));   
		
		echo $folder.$filename;

	  }	  
  }	
	  
  
?>