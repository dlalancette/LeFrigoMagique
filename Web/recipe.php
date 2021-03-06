<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Recette</title>
</head>
<body>

    <?php
        include('user.php');
        require('/classes/facade.php');

        $recetteId = $_GET['idx'];

        $recette = facade::GetRecetteById($conn, $recetteId);
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-7">


                <!-- Preview Image -->
                <img class="img-responsive" src="/img/recipe_background.png" alt="" />

                <hr />

                <!-- Post Content -->
                <p class="lead"><?php echo $recette->description; ?></p>

                <ol>
                <?php
                    foreach ($recette->etapes as $key=>$etape) {
                        echo "<li><p>" . $etape->Description() . "</p></li>";
                    }
                ?>
                </ol>
                

            </div>

            <div class="col-md-5">

                <div class="well">
                    <h4>Ingredients</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                    foreach ($recette->ingredients as $key=>$ingr) {
                                        echo "<li>" . $ingr->Nom() . "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                    foreach ($recette->ingredients as $key=>$ingr) {
                                        echo "<li>" . $ingr->Quantite() . "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>
</html>