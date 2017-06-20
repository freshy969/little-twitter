<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<?php
if($_GET['userid']  && $_GET['username']){
	if($_GET['userid']!=$user_id){
		$follow_userid = $_GET['userid'];
		$follow_username = $_GET['username'];
		include 'connect.php';
		$query = pg_query("SELECT id
							   FROM following
							   WHERE user1_id='$user_id' AND user2_id='$follow_userid'
							  ");
		pg_close($conn);
		if(!(pg_num_rows($query)>=1)){
			include 'connect.php';
			pg_query("INSERT INTO following(user1_id, user2_id)
						 VALUES ('$user_id', '$follow_userid')
						");
			pg_query("UPDATE users
						 SET following = following + 1
						 WHERE id='$user_id'
						");
			pg_query("UPDATE users
						 SET followers = followers + 1
						 WHERE id='$follow_userid'
						");
			pg_close($conn);
		}
		header("Location: ./".$follow_username);
	}
}
?>
