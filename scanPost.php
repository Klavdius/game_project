<?php
session_start();
include "connectBD.php";
if (!empty($_POST)) {
    $postFromPost = $_POST['post'];
    $nNewText = $_POST['myText'];
    if ($nNewText != NULL) {
        $NewText = $db->real_escape_string($nNewText);
        $NewAuthorId = $_SESSION['IdUser'];
        $resultComment = $db->query("INSERT INTO `comments` (`post_id`,`author_id`,`text`,`created_at`) VALUES ('$postFromPost','$NewAuthorId','$NewText', NOW())");
        echo json_encode(['success' => 1]);
        exit();
    }
}	
//$message = $_SESSION['valueTit'];
$postId = $_GET['id'];

//$result = $db->query("SELECT * FROM `posts` WHERE posts.titul = '$message' ");
$result = $db->query("SELECT * FROM `posts` WHERE posts.id = '$postId' ");
$row = $result->fetch_assoc();


$likes = $db->query("SELECT * FROM `likes` WHERE likes.post_id = '$postId' ");
$like = 0;
while ($arrLikes = $likes->fetch_assoc()) {
    if ($arrLikes['value'] == 1) {
        $like = $like + 1;
    } else {
        $like = $like - 1;
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Пост </title>
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
</head>

<form>
    <!--<div class=title><?php // echo $message; ?></div> -->
    <br/>
    <div class=mainText><?php echo $row['content']; ?></div>
    <br/>
    <div class=like>
        <?php
        // 0 - negativ like
        // 1 - positiv like
        echo "<input type=submit name='" . "negativ" . "' id='" . "negativId" . "' value='-'>  ";
        $valueLike = 0 + $like;
        echo $valueLike . "  ";
        echo "<input type=submit name='" . "positiv" . "' id='" . "positivId" . "' value='+'>  ";
        ?>
    </div>
    <br/>
    
	<script type="text/javascript">
		var post = '<?= $postId ?>';
		var valueMin = 0;
		$('#negativId').on('click', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '/rating.php',
				data: {post : post, value : valueMin},
				success: function(response){
					var jsonData = JSON.parse(response);
					if (jsonData.success == "1"){
						location.reload();
					}else{
						alert('Invalid Credentials');
					}						
				}
			});
		});
	</script>
	
	<script type="text/javascript">
		//var post = '<?= $postId ?>';
		var valuePlus = 1;
		$('#positivId').on('click', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '/rating.php',
				data: {post : post, value : valuePlus},
				success: function(response){
					var jsonData = JSON.parse(response);
					if (jsonData.success == "1"){
						location.reload();
					}else{
						alert('Invalid Credentials');
					}						
				}
			});
		});
	</script>
	
    <div class=bottom>
        <input type="text" name="newComment" placeholder="Новый комментарий" id="textId" autocomplete="off">
        <button id="SendComId">Опубликовать</button>

        <script type="text/javascript">
            var post = '<?= $postId ?>';
            $('#SendComId').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/scanPost.php',
                    data: {post : post, myText : $('#textId').val()},
                    success: function (response) {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success == "1") {
                            location.reload();
                        } else {
                            alert('Invalid Credentials!');
                        }
                    }
                });
            });
        </script>

        <div class=comment>
            <?php
            $resComment = $db->query("SELECT * FROM `comments`, `users` WHERE comments.post_id = '$postId' AND comments.author_id=users.id");
            while ($rowCom = $resComment->fetch_assoc()) {
                echo "<label>" . $rowCom['username'] . "</label><br/>";
                echo "<label>" . $rowCom['text'] . "</label><br/><br/>";
            }
            ?>
        </div>
    </div>

    <div class=leftTols>
        <a href="/MainPost.php">Вернуться назад</a><br/><br/>
    </div>
</form>

</html>