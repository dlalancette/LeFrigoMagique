<?php 
include('header.php');
include('config.php');
?>

<?php

if(!empty($_SESSION['loggedin']) && !empty($_SESSION['username']))
{
     redirect("user.php");    ?>
        
     <h1>Member Area</h1>
     <p>Thanks for logging in! You are <code><?=$_SESSION['username']?></code>.</p>
      
     <?php
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
     
    $checklogin = mysqli_query($conn, "SELECT * FROM users WHERE UserName = '$username' AND Password = '$password'");
    
    if(mysqli_num_rows($checklogin) == 1)
    {
        $row = mysqli_fetch_array($checklogin);
        $email = $row['Email'];
         
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = 1;
         
        echo "<h1>Succes</h1>";
        echo "<p>Nous vous redirigeons vers votre frigo</p>";
        echo "<meta http-equiv='refresh' content='2;user.php' />";
    }
    else
    {
        echo "<h1>Erreur</h1>";
        echo "<p>Desoler, votre compte ne peut être trouve. SVP <a href=\"index.php\">cliquer ici pour essayer de nouveau</a>.</p>";
    }
}
else
{
?>
<div class="container">
    <form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Vous connectez</h2>

        <!--<label for="inputusername" class="sr-only">Email address</label>-->
        <input type="text" name ="username" class="form-control" placeholder="Nom d'utilisateur"/>
        
        <!--<label for="inputPassword" class="sr-only">Password</label>-->
        <input type="password" name ="password" class="form-control" placeholder="Mot de passe"/>
       
        <input type="submit" class="btn btn-lg btn-success btn-block" value="Se connecter"/>
    </form>
    <div align="center"> <a href="register.php">Vous n'etes pas inscrit?</a></div>
</div>
     
   <?php
}
/*
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //username and password sent from form

    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM users WHERE UserName = '$myusername' AND Password = '$mypassword'";

    if ($result = mysqli_query($conn, $sql)) {
        
        $row = mysqli_fetch_array($result, MYSQL_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);

        if($count == 1){
            session_register("UserName");
            $_SESSION['login_user'] = $myusername;
            redirect("welcome.php");
        } else {
            $error = "Votre nom d'usager ou votre mot de passe sont invalide";
        }

    } else {
        echo "FAILURE";
    }


    //$result = mysqli_query($conn,$sql);
   //$row = mysqli_fetch_array($result, MYSQL_ASSOC);
    //$active = $row['active'];

    //$count = mysqli_num_rows($result);

    //if result matched $username and $password, table row must be 1 row

    //if($count == 1){
     //   session_register("username");
    //    $_SESSION['login_user'] = $myusername;
   
    //    header("location: welcome.php");
    //} else {
    //    $error = "Your Login Name or Password is invalid";
    //}
}
*/
?>
<?php include 'footer.php'; ?>
