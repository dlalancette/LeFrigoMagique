<?php require('user_header.php'); ?>

<?php
/*
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
*/
?>

<div class="container">
  <h2>Vos Paramètres</h2>
  <div class="row">
    <div class= "col-md-6">
    <h3>Prénom: <?=$_SESSION['firstname'];?></h3>
    </div>
  </div>
  <div class="row">
    <form class="form-firstname" action="" method="POST">
      <div class= "col-md-4">
      <input type="text" name="firstname" class="form-control" placeholder="Prenom" />
      </div>
      <div class= "col-md-2">
      <input type="submit" name="change-firstname" class="btn btn-success btn-block" value="Modifier" />
      </div>
    </form>
  </div>

  <div class="row">
    <div class= "col-md-6">
    <h3>Nom: <?=$_SESSION['nameuser'];?></h3>
    </div>
  </div>
  <div class="row">
    <form class="form-nameuser" action="" method="POST">
      <div class= "col-md-4">
      <input type="text" name="nameuser" class="form-control" placeholder="Nom" />
      </div>
      <div class= "col-md-2">
      <input type="submit" name="change-nameuser" class="btn btn-success btn-block" value="Modifier" />
      </div>
    </form>
  </div>

  <div class="row">
    <div class= "col-md-6">
    <h3>Nom d'utilisateur: <?=$_SESSION['username'];?></h3>
    </div>
  </div>
  <div class="row">
    <form class="form-username" action="" method="POST">
      <div class= "col-md-4">
      <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" />
      </div>
      <div class= "col-md-2">
      <input type="submit" name="change-username" class="btn btn-success btn-block" value="Modifier" />
      </div>
    </form>
  </div>

  <div class="row">
    <div class= "col-md-6">
    <h3>Email: <?=$_SESSION['email'];?></h3>
    </div>
  </div>
  <div class="row">
    <form class="form-email" action="" method="POST">
      <div class= "col-md-4">
      <input type="email" name="email" class="form-control" placeholder="Email" />
      </div>
      <div class= "col-md-2">
      <input type="submit" name="change-email" class="btn btn-success btn-block" value="Modifier" />
      </div>
    </form>
  </div>

  <div class="row">
    <div class= "col-md-6">
    <h3>Mot de passe: <?=$_SESSION['password'];?></h3>
    </div>
  </div>
  <div class="row">
    <form class="form-password" action="" method="POST">
      <div class= "col-md-4">
      <input type="text" name="password" class="form-control" placeholder="Password" />
      </div>
      <div class= "col-md-2">
      <input type="submit" name="change-password" class="btn btn-success btn-block" value="Modifier" />
      </div>
    </form>
  </div>

</div>