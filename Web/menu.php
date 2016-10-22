<?php

?>
<!-- The justified navigation menu is meant for single line per list item.
        Multiple lines will require custom code not provided by Bootstrap. -->
<div class="masthead">
    <!--<h3 class="text-muted">Le Frigo Magique</h3>-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Le Frigo Magique</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="blog.php">Blog</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
                <!--Si pas connecter afficher les boutons insciption et connexion. 
                    Si connecter afficher un menu dropdown avec les fonctionnailité inventaire, recette deconnexion, etc.
                -->
                <ul class="nav nav-pills navbar-right">
                    <li role="presentation">
                        <a class="btn btn-success" role="button" href="#">Inscription</a>
                    </li>
                    <li role="presentation">
                        <a class="btn btn-default" role="button" href="login.php">Connexion</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
