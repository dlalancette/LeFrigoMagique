<?php

include("etape.php");
include("ingredient.php");
include("recette.php");
include("utilities.php");

class facade
{
    public static function GetRecetteByFridge($conn, $fridgeID)
    {
        return facade::_GetRecetteByFridge($conn, $fridgeID);
    }

    public static function GetRecetteByMultipleIngrId($conn, $IngrId)
    {
        return facade::_GetRecetteByMultipleIngrId($conn, $IngrId);
    }

    public static function GetRecetteById($conn, $recipeId)
    {
        $query = "SELECT R.IdRecipe, R.NameRecipe, R.Description
                                        FROM tblingredients I
                                        INNER JOIN tblingredientsrecipes IR
	                                        ON IR.IdIngredient = I.IdIngredient
                                        INNER JOIN tblrecipes R
	                                        ON IR.IdRecipe = R.IdRecipe
                                        WHERE R.IdRecipe = " . $recipeId . "
                                        ORDER BY R.NameRecipe";

        $result = mysqli_query($conn, $query);
        $rowRec = mysqli_fetch_assoc($result);

        $recette = new recette($rowRec["IdRecipe"],
                               $rowRec["NameRecipe"],
                               $rowRec["Description"],
                               facade::GetEtapeByRecetteId($conn, $recipeId),
                               facade::GetIngrByRecipeId($conn, $recipeId));

        utilities::utf8_encode_deep($recette);

        return $recette;
    }

    private static function GetEtapeByRecetteId($conn, $RecetteId)
    {
        $lstEtape = mysqli_query($conn, "SELECT S.IdStep, S.NumberStep, S.NameStep, S.Description
                                        FROM tblrecipes R
                                        INNER JOIN tblsteps S
	                                        ON S.IdRecipe = R.IdRecipe
                                        WHERE R.IdRecipe = '" . $RecetteId . "'
                                        ORDER BY S.NumberStep");

        $rowsEtape = [];
        while($rowEtape = mysqli_fetch_array($lstEtape))
        {
            utilities::utf8_encode_deep($rowEtape);
            $rowsEtape[] = new etape($rowEtape["IdStep"], $rowEtape["NumberStep"],
                                         $rowEtape["NameStep"], $rowEtape["Description"]);
        }

        return $rowsEtape;
    }

    private static function _GetRecetteByFridge($conn, $FridgeId) {
        $arrIngrId = facade::GetIngrByFridgeId($conn, $FridgeId);
        $strIngrIds = "(" . implode(",", array_map(function ($item) {
            return $item->Id();
        }, $arrIngrId)) . ")";

        return facade::_GetRecetteByMultipleIngrId($conn, $strIngrIds);
    }

    private static function _GetRecetteByMultipleIngrId($conn, $strIngrIds)
    {


        $query = "SELECT DISTINCT(R.IdRecipe), R.NameRecipe, R.Description
                                    FROM tblingredients I
                                    INNER JOIN tblingredientsrecipes IR
	                                    ON IR.IdIngredient = I.IdIngredient
                                    INNER JOIN tblrecipes R
	                                    ON IR.IdRecipe = R.IdRecipe
                                    WHERE I.IdIngredient IN " . $strIngrIds . "
                                    ORDER BY R.NameRecipe";

        $lstRecette = mysqli_query($conn, $query);

        $rowsRec = [];
        while($rowRec = mysqli_fetch_array($lstRecette))
        {
            $IngrName = implode(",", array_map(function ($item) {
                                        return $item->Nom();
                                        }, Facade::GetIngrByRecipeId($conn, $rowRec["IdRecipe"])));

            $nbStep = strval(count(Facade::GetEtapeByRecetteId($conn, $rowRec["IdRecipe"])));

            $rowsRec[] = new recette($rowRec["IdRecipe"],
                                        $rowRec["NameRecipe"],
                                        $rowRec["Description"],
                                        $IngrName,
                                        $nbStep);
        }

        return $rowsRec;
    }

    private static function GetIngrByFridgeId($conn, $FridgeId)
    {
        $lstIngr = mysqli_query($conn, "SELECT I.IdIngredient, I.NameIngredient, I.DaysFreezerMaxDuration,
                                               I.DaysFridgeMaxDuration
                                            FROM tblusers U
                                            INNER JOIN tblfridge F
	                                            ON F.IdUser = U.IdUser
                                            INNER JOIN tblingredientsfridge IFR
	                                            ON IFR.IdFridge = F.IdFridge
                                            INNER JOIN tblingredients I
	                                            ON IFR.IdIngredient = I.IdIngredient
                                            WHERE F.IdFridge = '" . $FridgeId . "'
                                            ORDER BY I.NameIngredient");

        $rowsIngr = [];
        while($rowIngr = mysqli_fetch_array($lstIngr))
        {
            $rowsIngr[] = new ingredient($rowIngr["IdIngredient"], $rowIngr["NameIngredient"],
                                         $rowIngr["DaysFreezerMaxDuration"], $rowIngr["DaysFreezerMaxDuration"], "");
        }

        return $rowsIngr;
    }

    private static function GetIngrByRecipeId($conn, $RecipeId)
    {
        $query = "SELECT I.IdIngredient, I.NameIngredient, I.DaysFreezerMaxDuration, I.DaysFridgeMaxDuration, IR.Quantity
                                        FROM tblingredients I
                                        INNER JOIN tblingredientsrecipes IR
	                                        ON IR.IdIngredient = I.IdIngredient
                                        INNER JOIN tblrecipes R
	                                        ON IR.IdRecipe = R.IdRecipe
                                        WHERE R.IdRecipe = '" . $RecipeId . "'
                                        ORDER BY I.NameIngredient";

        $lstIngr = mysqli_query($conn, $query);

        $rowsIngr = [];
        while($rowIngr = mysqli_fetch_array($lstIngr))
        {
            utilities::utf8_encode_deep($rowIngr);
            $rowsIngr[] = new ingredient($rowIngr["IdIngredient"], $rowIngr["NameIngredient"],
                                         $rowIngr["DaysFreezerMaxDuration"], $rowIngr["DaysFreezerMaxDuration"], $rowIngr["Quantity"] );
        }

        return $rowsIngr;
    }
}