<!DOCTYPE html>

<html lang="en">
    <?php require('logheader.php');?>

    <body>
            <div class="container">
            <div class="jumbotron">
                <div class="contrainer">
                    <h1>Recettes conseillées</h1>
                    <p class="lead">Choississez les aliments que vous aimeriez manger, on se charge de trouver la meilleur recettes pour vous</p>
                </div>
             </div>
                 <div class="col-lg-6">
                         
                    <table class="table">
                        <tr> 
                            <th>Produits à péremption proche</th>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Steack de boeuf
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2">Saumon
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Lait
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox4" value="option4"> Soupe à la tomate
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Dinde
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
            

         
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>

            <?php require 'footer.php';?>
        </div>
    </body>
    
</html>