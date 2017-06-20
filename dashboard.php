<?php

	if($user_id){
		include "connect.php";
		$query = pg_query("SELECT username, followers, following, tweets
                              FROM users
                              WHERE id='$user_id'
                             ");
		pg_close($conn);
		$row = pg_fetch_assoc($query);
		$username = $row['username'];
		$tweets = $row['tweets'];
		$followers = $row['followers'];
		$following = $row['following'];
		echo "
		<h6><a href='logout.php'>Logout</a></h6>
		<table style='margin-bottom:100px;'>
			<tr>
				<td>
					<img src='./default.jpg' style='width:35px;'alt='display picture'/>
				</td>
				<td valign='top' style='padding-left:8px;'>
					<h6><a href='./$username'>@$username</a></h6>
					<h6 font=2 style='margin-top:-10px;'>Tweets: <a href='#'>$tweets</a> | Followers: <a href='#'>$followers</a> | Following: <a href='#'>$following</a></h6>
				</td>
			</tr>
		</table>
		<form action='tweet.php' method='POST'
		style='margin-top:100px;'>
			<textarea class='form-control' placeholder='Type your message' name='tweet'></textarea>
			<button type='submit' style='float:right;margin-top:3px;' class='btn btn-warning'>Post a message</button>
		</form>
		<br>
		<br>
		";
		include "connect.php";
		$tweets = pg_query("SELECT username, tweet, created_at
							   FROM tweets
							   WHERE user_id = $user_id OR (user_id IN (SELECT user2_id FROM following WHERE user1_id='$user_id'))
							   ORDER BY created_at DESC
							   LIMIT 10");
		while($tweet = pg_fetch_array($tweets)){
			echo "<div class='well' style='padding-top:4px;padding-bottom:8px; margin-bottom:8px; overflow-y:scroll;'>";
			echo "<table>";
			echo "<tr>";
			echo "<td valign=top style='padding-top:4px;overflow:scroll;'>";
			echo "<img src='./default.jpg' style='width:35px;'alt='display picture'/>";
			echo "</td>";;
			echo "<td style='padding-left:5px;word-wrap: break-word;' valign=top>";
			echo "<a style='font-size:12px;' href='./".$tweet['username']."'>@".$tweet['username']."</a>";
			$new_tweet = preg_replace('/@(\\w+)/','<a href=./$1>$0</a>',$tweet['tweet']);
			$new_tweet = preg_replace('/#(\\w+)/','<a href=./hashtag/$1>$0</a>',$new_tweet);
			echo "<div style='font-size:10px; margin-top:-3px;'>".$new_tweet."</div>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
		}
		pg_close($conn);
	}
?>
</div>
