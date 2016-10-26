<?php
require('header.php');
require('config.php');
?>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['email'])&& !empty($_POST['password'])) {

$myusername = $_POST['username'];
$mynameuser = $_POST['nameuser'];
$myfirstname = $_POST['firstname'];
$myemail = $_POST['email'];
$mypassword = $_POST['password'];

$sql = "INSERT INTO users (UserName, NameUser, FirstName, Email, Password) VALUE ('$myusername', '$mynameuser', '$myfirstname', '$myemail', '$mypassword')";

if ($conn->query($sql) === TRUE) {
    redirect("login.php");
} else {
    $message="L'inscription n'a pas fonctionne";
    echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
    redirect("index.php");
}
$conn->close();
}
?>

<div class="container">
    <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Vous inscrire</h2>

        <input type="text" name="firstname" class="form-control" placeholder="Prenom" />
        <input type="text" name="nameuser" class="form-control" placeholder="Nom" />
        <!--<label for="inputusername" class="sr-only">Email address</label>-->
        <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" />
        <input type="email" name="email" class="form-control" placeholder="Email" />
        <!--<label for="inputPassword" class="sr-only">Password</label>-->
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" />

        <input type="submit" name="add" class="btn btn-lg btn-success btn-block" value="S'inscrire" />
    </form>
     <div align="center"> <a href="login.php">Deja inscrit?</a></div>

</div>