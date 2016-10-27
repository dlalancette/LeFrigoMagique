<?php 
require('user_header.php');
?>


<div class="container">
  <h1>Frigo de <?=$_SESSION['firstname'];?></h1>

  <h2>Ajouter des aliments: </h2>
  <form>
    <div class="row">
      <div class="col-md-2">
      <input type="text" name="name-fridge" class="form-control" placeholder="Nom du frigo" />
      </div>
      <div class="col-md-6">
      <input type="text" name="description-fridge" class="form-control" placeholder="Description" />
      </div>
      <div class="col-md-1">
      <button class="btn btn-success btn-block" type="submit" name="add-fridge">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
      </div>
    </div>
  </form>
</div>
