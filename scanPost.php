<?php
	session_start();
	include "connectBD.php";
	$message = $_SESSION['valueTit'];
	
	$result = $db->query("SELECT * FROM `posts` WHERE posts.titul = '$message' ");
 	$row = $result->fetch_assoc();
	$idPost = $row['id'];
	
	$likes = $db->query("SELECT * FROM `likes` WHERE likes.post_id = '$idPost' ");
	$like = 0;
	while($arrLikes = $likes->fetch_assoc()){
			if($arrLikes['value'] = 1){
				$like = $like + 1;
			}else{
				$like = $like - 1;
			}
	}
	if(!empty($_POST)){
		//$nNewText = $_POST['newComment'];
		$nNewText = $_POST['myText'];
		if($nNewText != NULL){
			
		
		$NewText = $db->real_escape_string($nNewText);
		$NewAuthorId = $_SESSION['IdUser'];
		$NewPostId = $idPost;
		
		$resultComment = $db->query("INSERT INTO `comments` (`post_id`,`author_id`,`text`,`created_at`) VALUES ('$NewPostId','$NewAuthorId','$NewText', NOW())");
		json_encode(array('success' => 1));
		}
	}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Пост </title>
	<script src="js/jquery-3.5.1.min.js"></script>
</head>

<form>
	<div class=title><?php echo $_SESSION['valueTit'];?></div><br/>
	<div class=mainText><?php echo $row['content'];  ?></div><br/>
	<div class=like>
		<?php
			// 0 - negativ like
			// 1 - positiv like
			echo "<input type=submit name='"."negativ"."' id='"."negativId"."' value='-'>  ";
			$valueLike = 0 + $like;
			echo $valueLike . "  ";
			echo "<input type=submit name='" ."positiv" ."' id='" ."positivId" ."' value='+'>  ";
		?>
	</div><br/>
	<script type="text/javascript">
		var name=$_SESSION['IdUser'];
		var post=$idPost;
		$('#negativId').submit(function(){
		$.ajax({
			type: "GET",
			url: 'negativ.php',
			data: name,post,
			success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    location.href = 'scanPost.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
		})
	</script>
	
	<script type="text/javascript">
		var name=$_SESSION['IdUser'];
		var post=$idPost;
		$('#positivId').submit(function(){
		$.ajax({
			type: "GET",
			url: 'positiv.php',
			data: {name ,post},
			success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    location.href = 'scanPost.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
		})
	</script>
	
	
	<div class=bottom>
		<input type=text name='newComment' placeholder='Новый комментарий' id="textId" autocomplete='off'>
		<input type=submit name="SendCom" id='SendComId' value='Опубликовать'>
		
	<script type="text/javascript">
		var name=$_SESSION['IdUser'];
		var post=$idPost;
		//var text=$("#textId").value;
		var myText = $("input[id='textId']").value;
		
		$('#SendComId').submit(function(){
		$.ajax({
			type: "POST",
			url: 'scanPost.php',
			data: {name ,post, myText},
			success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    location.href = 'scanPost.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
		})			
		</script>
	
		<div class=comment>
			<?php
				$resComment = $db->query("SELECT * FROM `comments`, `users` WHERE comments.post_id = '$idPost' AND comments.author_id=users.id");
				while($rowCom = $resComment->fetch_assoc()){
				echo "<label>" .$rowCom['username']. "</label><br/>";
				echo "<label>" .$rowCom['text']. "</label><br/><br/>";
				}
			?>	
		</div>
	</div>
	
	<div class=leftTols>
		<a href="http://127.0.0.1/MainPost.php">Вернуться назад</a><br/><br/>
	</div>
</form>

</html>