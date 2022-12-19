
<?php include('config.php'); 
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="indexstyle.css">
</head>
<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Login here to EstateX</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Ingame Tag" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
	
  </form>
  
  <?php
	if (isset($_POST['login']))
		{
			$usertag = $_POST['user'];
			$password = md5($_POST['pass']);
			
			session_start(); 
			$_SESSION['user'] = $_POST['user']; 
			
			$query 		= mysqli_query($db, "SELECT * FROM userS WHERE  password='$password' and IG_Tag='$usertag'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
			
			if ($num_row > 0) 
				{			
					$_SESSION['user_id']=$row['AccID'];
					header('location:home.php');
					
				}
			else
				{
					echo 'Invalid Username and Password Combination';
				}
		}
  ?>
  <div class="reminder">
    <p>Not a member? <a href="signup.php">Sign up now</a></p>
    <p><a href="#">Forgot password?</a></p>
  </div>
  
</div>

</body>
</html>