<?php 
include('header.php');
include('config.php');
?>

<?php

if(!empty($_SESSION['loggedin']) && !empty($_SESSION['username']))
{
     redirect("home.php");
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $checklogin = mysqli_query($conn, "SELECT * FROM tblusers WHERE UserName = '$username' AND Password = '$password'");

    if(mysqli_num_rows($checklogin) == 1)
    {
        //Prendre les informations dans la base de données pour la personne qui se connecte.
        $row = mysqli_fetch_array($checklogin);
        $firstname = $row['FirstName'];
        $nameuser = $row['NameUser'];
        $email = $row['Email'];
        $mypassword = $row['Password'];

        //Accès au prenom, nom, email, nom d'usager, mot de passe.
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['nameuser'] = $nameuser;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $mypassword;
        $_SESSION['loggedin'] = 1;

        redirect("home.php");
    }
    else
    {
        echo "<h1>Erreur</h1>";
        echo "<p>Desoler, votre compte ne peut être trouve. SVP <a href=\"login.php\">cliquer ici pour essayer de nouveau</a>.</p>";
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
?>
<?php include 'footer.php'; ?>
