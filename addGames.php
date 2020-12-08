<a href="http://127.0.0.1/MainPost.php">На главную</a><br/><br/>

<?php
	include 'connectBD.php';
	
	if(!empty($_POST)){
		$nNewTitle = $_POST['title_game'];
		$NewDevel = $_POST['select_devel']; //   должен быть выбор из разработчиков
		$NewPubli = $_POST['select_publish']; //   так же поле издателей. или сделать всё 
		$NewGenres = $_POST['select_genres'];
		$nNewDes = $_POST['description'];
		$NewReleaseDate = $_POST['release'];
		
		
		$NewTitle = $db->real_escape_string($nNewTitle);
		$NewDes = $db->real_escape_string($nNewDes);
		$result = $db->query("INSERT INTO `games` (`title`, `developer_id`, `publisher_id`, `genres`, `description`, `release_date`, `created_at`) 
		VALUES ('$NewTitle','$NewDevel','$NewPubli','$NewGenres','$NewDes', '$NewReleaseDate', NOW())");
			
	}
	// start html
?>
<html>
<head>
	<meta charset="UTF-8">
    <title>Новая игра! </title>
		<script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
		</script>
</head>	
	<form method='POST' action='addGames.php'>
		<input name='title_game' type=text placeholder='Введите название игры'> <br/><br/>
		<label> Выберите разработчика </label> <br/>
		<select name="select_devel">
<?php	
	$getDevel = $db->query("SELECT * FROM `developers` ");
	while($row = $getDevel->fetch_assoc() )
	{
		echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
	}
?>	
		</select><br/>
			<input name='NewGame' id='IdNewGame' type=submit value='Не нашли разработчика?' style='display:block' onclick='return false'><br/>
			<input name='tuNewGame' id='SelectIdNewGame' type=submit value='Добавить' style='display:none' onclick='return false'><br/>
			<input type=text id='TextNewGame' placeholder='Новый разработчик' autocomplete='off' style='display:none'><br/>
			
			<script type="text/javascript">
				$('#IdNewGame').on('click', function(){
					tar = document.getElementById('TextNewGame');
					tar.style.display = 'block';
					tar2 = document.getElementById('SelectIdNewGame');
					tar2.style.display = 'block';
					tar3 = document.getElementById('IdNewGame');
					tar3.style.display = 'none';
				});
			</script>
			
			<script type="text/javascript">
				
				
				$('#SelectIdNewGame').on('click', function(){
					var postDev = document.getElementById('TextNewGame').value;
					document.getElementById('TextNewGame').style.display = 'none';
					document.getElementById('IdNewGame').style.display = 'block';
					$.ajax({
						type: 'POST',
						url: '/add_developers.php',
						data: {post: postDev},
						success: function(response){
							var jsonData = JSON.parse(response);
							if (jsonData.success == "1"){
								location.reload();
							}else{
								alert('Введите разработчика перед добавлением!');
							}
						}
					});
					document.getElementById('SelectIdNewGame').style.display = 'none';
				});
				
			</script>
		
		
			<label> Издатель </label> <br/>
		<select name="select_publish">';
<?php	
	$getPublish = $db->query("SELECT * FROM `publishers`");
	while($row = $getPublish->fetch_assoc())
	{
		echo "<option value='" . $row['id'] . "'>" . $row['name']. "</option>";
	}
?>		
		</select>
		<br/>
			<input name='NewPub' id='IdNewPub' type=submit value='Не нашли издателя?' style='display:block' onclick='return false'><br/>
			<input name='tuNewPub' id='SelectIdNewPub' type=submit value='Добавить' style='display:none' onclick='return false'><br/>
			<input type=text id='TextNewPub' placeholder='Новый издатель' autocomplete='off' style='display:none'><br/>
			
			<script type="text/javascript">
				$('#IdNewPub').on('click', function(){
					tar = document.getElementById('TextNewPub');
					tar.style.display = 'block';
					tar2 = document.getElementById('SelectIdNewPub');
					tar2.style.display = 'block';
					tar3 = document.getElementById('IdNewPub');
					tar3.style.display = 'none';
				});
			</script>
			
			<script type="text/javascript">
				
				
				$('#SelectIdNewPub').on('click', function(){
					var postPub = document.getElementById('TextNewPub').value;
					document.getElementById('TextNewPub').style.display = 'none';
					document.getElementById('IdNewPub').style.display = 'block';
					$.ajax({
						type: 'POST',
						url: '/add_publish.php',
						data: {post: postPub},
						success: function(response){
							var jsonData = JSON.parse(response);
							if (jsonData.success == "1"){
								location.reload();
							}else{
								alert('Введите издателя перед добавлением!');
							}
						}
					});
					document.getElementById('SelectIdNewPub').style.display = 'none';
				});
				
			</script>
		<label> Игра в жанре </label> <br/>
		<select name="select_genres">
<?php
	$getGenres = $db->query("SELECT * FROM `genres` ");
	while($row = $getGenres->fetch_assoc()){
		echo "<option value='".$row['id']."'>". $row['name'] ."</option>";
	}
?>
		</select>
		<br/>
			<input name='NewGen' id='IdNewGen' type=submit value='Новый жанр?' style='display:block' onclick='return false'><br/>
			<input name='tuNewPub' id='SelectIdNewGen' type=submit value='Добавить' style='display:none' onclick='return false'><br/>
			<input type=text id='TextNewGen' placeholder='жанр' autocomplete='off' style='display:none'><br/>
			
			<script type="text/javascript">
				$('#IdNewGen').on('click', function(){
					tar = document.getElementById('TextNewGen');
					tar.style.display = 'block';
					tar2 = document.getElementById('SelectIdNewGen');
					tar2.style.display = 'block';
					tar3 = document.getElementById('IdNewGen');
					tar3.style.display = 'none';
				});
			</script>
			
			<script type="text/javascript">
				
				
				$('#SelectIdNewGen').on('click', function(){
					var postGen = document.getElementById('TextNewGen').value;
					document.getElementById('TextNewGen').style.display = 'none';
					document.getElementById('IdNewGen').style.display = 'block';
					$.ajax({
						type: 'POST',
						url: '/addGenres.php',
						data: {post: postGen},
						success: function(response){
							var jsonData = JSON.parse(response);
							if (jsonData.success == "1"){
								location.reload();
							}else{
								alert('Введите жанр перед добавлением!');
							}
						}
					});
					document.getElementById('SelectIdNewGen').style.display = 'none';
				});
				
			</script>
		<input name='description' type=text placeholder='Описание игры' autocomplete='off'> <br/><br/> 
		
		<input type=date name="release"> <br/><br/> 

		<input type=submit value="Создать запись">
</form>

</html>