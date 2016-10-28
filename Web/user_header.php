<?php 
require('config.php')
?>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../favicon.ico" />

    <title>Le Frigo Magique</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/jumbotron-narrow.css" rel="stylesheet" />
    <link href="navbar-static-top.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />

</head>
<body> 
    <!-- The justified navigation menu is meant for single line per list item.
        Multiple lines will require custom code not provided by Bootstrap. -->
<div class="masthead">
    <!--<h3 class="text-muted">Le Frigo Magique</h3>-->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand">BIENVENUE</span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="navbar-brand" href="home.php"><?= $_SESSION['firstname']; ?></a>
                    </li>

                </ul>
                <!--Si pas connecter afficher les boutons insciption et connexion. 
                    Si connecter afficher un menu dropdown avec les fonctionnailité inventaire, recette deconnexion, etc.
                -->
                <ul class="nav nav-tabs navbar-nav navbar-right">
                    <li>
                        <a class="glyphicon glyphicon-cog" href="user_setting.php"></a>
                    </li>
                    <li>
                        <a class="glyphicon glyphicon-log-out" href="logout.php"></a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
</body>

