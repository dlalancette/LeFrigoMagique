<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Frigo Magique</title>
    </head>
    <body>

        <?php 
            include('user.php');
            require('/classes/utilities.php');

            $username = $_SESSION['username'];
            $lstIngr = mysqli_query($conn, "SELECT *
                                            FROM tblingredients
                                            ORDER BY NameIngredient");

            $result =  mysqli_query($conn, "SELECT F.IdFridge
                                                FROM tblusers U
                                                INNER JOIN tblfridge F
	                                                ON F.IdUser = U.IdUser
                                                WHERE U.UserName = '" . $username . "'
                                                LIMIT 1");

            $fridgeId = mysqli_fetch_assoc($result)["IdFridge"];

            $_SESSION["fridgeId"] = $fridgeId;
            $_SESSION["ingrIdx"] = $_POST['ingrIdx'];
        ?>

        <div id="container">

            <span>
                <select multiple id="lstIngredients">
                    <?php
                        while($Ingr = $lstIngr->fetch_assoc()) {
                            utilities::utf8_encode_deep($Ingr);
                    ?>
                        <option value=<?php print_r($Ingr["IdIngredient"]) ?>> <?php print_r($Ingr["NameIngredient"]) ?> </option>
                    <?php } ?>
                </select>
            </span>

            <div class="divSearchButton">
                <input type="button" id="btnSearch" class="elem form-control"/>
            </div>

            <div class="divSearchButton">
                <h4 class="elem">Ou chercher à partir de votre frigo....</h4>
                <input type="button" id="btnSearchFrigo" class="elem form-control" />
            </div>

            <table id="datatableIngredients" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Ingrédients</th>
                        <th>Nb. d'étapes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            </table>

        </div>

        <?php include 'footer.php'; ?>

        <script>
            $(function(){
                $('#lstIngredients').select2();
            });

            $.extend(true, $.fn.dataTable.defaults, {
                "searching": false,
                "info": false
            });

            $("#btnSearch").click(function () {
                //$("#datatableIngredients").DataTable().fnDestroy();
                $.post("/home.php", { "ingrIdx": $("#lstIngredients").val() });
                RefreshTable("controller/GetRecipesByIngr.php");
            });

            $("#btnSearchFrigo").click(function () {
                RefreshTable("controller/GetRecipes.php");
            });

            $(document).ready(function() {
                RefreshTable("controller/GetRecipes.php");
            });

            function RefreshTable (controllerURL) {

                $('#datatableIngredients').DataTable({
                    "bDestroy": true,
                    "ajax": controllerURL,
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        $('td:eq(0)', nRow).html('<a href="recipe.php?idx=' + aData[0] + '"><img src="/img/view.png" alt="View" width="16" height="16"> </img></a>');
                        return nRow;
                    },
                    language: {
                        "sProcessing": "Traitement en cours...",
                        "sSearch": "Rechercher&nbsp;:",
                        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix": "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sPrevious": "Pr&eacute;c&eacute;dent",
                            "sNext": "Suivant",
                            "sLast": "Dernier"
                        },
                        "oAria": {
                            "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                    }
                });
            }
        </script>

    </body>
</html>
