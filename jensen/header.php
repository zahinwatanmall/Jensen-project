
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
        
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
		exit;
	}
    
    ?>
    <div class="container">
        <div class="row">
            <div id="welcome">
    
     <h3> VÄLKOMEN :  <?php echo $_SESSION['username'] ?></h3>
    
     <a href="logout.php" class="btn btn-danger">logga ut</a>
            </div>
        </div>
    </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</body>
</html>
