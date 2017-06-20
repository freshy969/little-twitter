<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<?php
if($user_id){
	if($_POST['tweet']!=""){
		$tweet = htmlentities($_POST['tweet']);
		$timestamp = time();
		include 'connect.php';
		$query = pg_query("SELECT username
					 		  FROM users
				     		  WHERE id ='$user_id'
				    		");
		$row = pg_fetch_assoc($query);
		$username = $row['username'];
		pg_query("INSERT INTO tweets(username, user_id, tweet)
				     VALUES ('$username', '$user_id', '$tweet')
				    ");
		pg_query("UPDATE users
					 SET tweets = tweets + 1
					 WHERE id='$user_id'
					");
		pg_close($conn);
		header("Location: .");
	}
}
?>
