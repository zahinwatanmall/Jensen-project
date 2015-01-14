<?php   
    if(isset($_POST["submit"])){
        try{
        require_once("db_connect.php");
        $firstname = $_POST["firstname"];
        $lastname  = $_POST["lastname"];
        $username  = $_POST["username"];
        $email     = $_POST["email"];
        $password  = $_POST["password"];
            
            $pass = password_hash($password, PASSWORD_BCRYPT);
            
            $query  = "INSERT INTO users (first_name, last_name, user_name, email, password) ";
            $query .= "VALUES (:fname, :lname, :user, :email, :pass)";
            
            $ps = $db->prepare($query);
            $result = $ps->execute(
                array(
					'fname'  => $firstname,
                    'lname'  => $lastname,
                    'user'   => $username,
                    'email'  => $email,
                    'pass'   => $pass,
                ));
            
            
            if($result){										
				header("Location: index.php?signup=true");		
			}else {												
				echo "Signup failed";							
			}
		}catch(Exception $exception) { 							
           
			echo "Query failed, see below: <br><br>"; 
			echo $exception."<br /><br />";  									
		}
	}
			
     ?>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title></title>
</head>

<body>
   <div class="container">
    <div class="row">
        <img  src="image/logo.png"/>
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">skapa konto</h1>
            <div class="account-wall">
                <form  action="signup.php" method="POST" class="form-signin">
                <input type="text" class="form-control" name="firstname" placeholder="Förnamn" required autofocus>
                <input type="text" class="form-control" name="lastname" placeholder="Efternamn" required>
                <input type="text" class="form-control" name="username" placeholder="Användernamn" required>
                <input type="email" class="form-control" name="email" placeholder="E-Mail" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>    
                
                    
                <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
                
                </form>
            </div>
            <a href="login.php" class="text-center new-account"><span>Logga in</span> </a>
        </div>
    </div>
</div>
        
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
