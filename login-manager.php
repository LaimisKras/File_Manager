<?php session_start(); 	

    $message = ['username' => 'password', 'username1' => 'password1','username2' => 'password2'];
	if(isset($_POST['Submit'])){
		$logins = array('Laimis' => '123456', 'username1' => 'password1','username2' => 'password2');
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';		
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			$_SESSION['UserData']['Username']=$logins[$Username];
			header("location:index-manager.php");
			exit;
		} else {
			$message['username'] = 'Wrong Username or Password!!!';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <style>       
        <?php 
            include 'css/login-manager.css' 
        ?>
    </style>

    <title>Admin Window</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-title">
                    WINDOW FOR ADMIN
                </div>
                <div class="col-lg-12 login-form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="Login_Form">
                        <div class="form-group">
                            <label class="form-control-label">USERNAME</label>
                            <input name="Username" type="text" class="form-control" placeholder="Laimis">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">PASSWORD</label>
                            <input name="Password" type="password" class="form-control" placeholder="123456">
                        </div>
                        <div class="col-lg-12">
                            <?php if (isset($message['username']) && $message['username'] !== 'password'){?>
                                <div class="col-lg-6 login-btn login-text">
                                    <?php echo $message['username']?>
                                </div>
                                <?php } ?>
                            <div class="col-lg-6 login-btn login-button">
                                <button name="Submit" type="submit" value="Login" class="btn btn-outline">LOGIN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>