<?php 

      session_start();
     require_once("db_connect.php");
     ?>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Jensen Online</title>
</head>

<body>
    
    <?php
	$msg = "";
	if(isset($_POST["submit"])){													
		try{								
			$username = trim($_POST["username"]);									
			$password = trim($_POST["password"]);									
			
			
			$query  = "SELECT * FROM users ";									
			$query .= "WHERE user_name = :username";							 

			$ps = $db->prepare($query);												
			$ps->execute(															
				array(								
					'username' => $username,										
				)); 
			 
			$user = $ps->fetch(PDO::FETCH_ASSOC);									

			if($user){		
				if (password_verify($password, $user["password"])) {
				
					$_SESSION["id"] = $user['id'];									
					$_SESSION["username"] = $user["username"];
					$_SESSION["username"] = $_POST["username"];
					
					header("Location: home.php");									
					exit;
					
				} else {
					$msg = "Username/password not found.<br /><br />";
				}
			} else {										
				$msg = "Username/password not found.<br /><br />";
			}
			
		}catch(Exception $exception) {  											
			echo "Query failed, see below: <br><br>"; 
			echo $exception."<br /><br />"; 										
		}
	}
?>
    
    
   <div class="container">
       
    <div class="row">
        <img  src="image/logo.png"/>
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Logga in</h1>
            <div class="account-wall">
                <form class="form-signin" action="login.php" method="POST">
                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">
                    Logga in</button>
                
                
                </form>
            </div>
            <a href="signup.php" class="text-center new-account"><span>Skapa ett konto</span> </a>
        </div>
    </div>
</div>
        
    <div class="alert alert-danger" role="alert"><?php echo $msg; ?></div><br />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
