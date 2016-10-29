<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Frigo Magique</title>
    </head>
    <body>

        <?php 
            include('header.php');
            include('config.php');
            include('user.php');

            $lstIngr = mysqli_query($conn, "SELECT *
                                            FROM tblingredients
                                            ORDER BY NameIngredient");

            $lstIngrFridge = mysqli_query($conn, "SELECT *
                                                  FROM tblusers
                                                    INNER JOIN tblfridge
                                                        ON tblfridge.IdUser = tblusers.IdUser
                                                    INNER JOIN tblingredientsfridge
                                                        ON tblingredientsfridge.IdFridge = tblfridge.IdFridge
                                                    INNER JOIN tblingredients
                                                        ON tblingredientsfridge.IdIngredient = tblingredients.IdIngredient
                                                  WHERE UserName =" + $_SESSION['username'] +
                                                 "ORDER BY NameIngredient");
        ?>

        <div id="container">

            <select multiple id="lstIngredients" style="width:300px">
                <?php
                while($Ingr = $lstIngr->fetch_assoc()) {
                ?>
                <option value=<?php print_r($Ingr["IdIngredient"]) ?>> <?php print_r($Ingr["NameIngredient"]) ?> </option>
                <?php } ?>
            </select>

            <br />

            <div id="divSearchButton">
                <input type="button" id="btnSearch" class="elem form-control" value="Rechercher" />
                <h4 class="elem">Ou chercher � partir du frigo....</h4>
                <input type="button" id="btnSearchFrigo" class="elem form-control" value="Frigo" />
            </div>

        </div>

        <?php include 'footer.php'; ?>

        <script>
            $(function(){
              // turn the element to select2 select style
                $('#lstIngredients').select2();
            });
        </script>

    </body>
</html>
