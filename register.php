<?php
session_start();
include_once("connect.php");
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=425px, user-scalable=no">

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <title>Rézozio registration</title>
</head>
<body style="margin-left:20px;width:300px;zoom:125%;">
  <form action="register.php" method="POST" role="form" style="width:300px;">
    <h3>Rézozio registration</h3>
    <h4>Create your account</h4>
<?php
if($_POST['btn']=="submit-register-form"){
  if($_POST['username']!="" && $_POST['password']!="" && $_POST['confirm-password']!=""){
    if($_POST['password']==$_POST['confirm-password']){
      include 'connect.php';
      $username = strtolower($_POST['username']);
      $address="SELECT username FROM users where username='$unseraname'"; //where username=$unseraname
      $query = pg_query($address);
      pg_close($conn);
      if(!(pg_num_rows($query)>=1)){
          $password = md5($_POST['password']);
          include 'connect.php';
          pg_query("INSERT INTO users(username, password)
                       VALUES ('" . $username . "','" . $password . "')");
          pg_close($conn);
          echo "<div class='alert alert-success'>Your account has been created!</div>";
          echo "<a href='.' style='width:300px;' class='btn btn-info'>Go Home</a>";
          exit;

      }
      else{
        $error_msg="Username already exists please try again";
      }
    }
    else{
      $error_msg="Passwords did not match";
    }
  }
  else{
      $error_msg="All fields must be filled out";
  }
}
?>
    <div class="input-group" style="margin-bottom:10px;">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>">
    </div>
    <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Password" name="password">
    <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Confirm Password" name="confirm-password">
    <?php
    if($error_msg){
        echo "<div class='alert alert-danger'>".$error_msg."</div>";
    }
    ?>
    <button type="submit" style="width:300px; margin-bottom:5px;" class="btn btn-success" name="btn" value="submit-register-form">Register</button>
    <a href="." style="width:300px;" class="btn btn-info">Back</a>
  </form>
  <br>
</body>
</html>
