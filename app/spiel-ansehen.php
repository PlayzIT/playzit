<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 14.12.2017
 * Time: 17:18
 */


$id = $_GET['id'];

session_start();
require_once "database_connection.php";


$query1 = 'SELECT G_Name FROM Game WHERE G_ID='.$id.';';
if ($game = $mysqli->prepare($query1)) {
    $game->execute();
    $game->bind_result($gameName);
    $game->store_result();
    $game->fetch();
}



$query2 = "SELECT gcommentID, nickname, content FROM gamecomment join user on (user_id=fk_user) where fk_game=" . $id . "order by datum";
if ($stmt_insert = $mysqli->prepare($query2)) {
    $stmt_insert->execute();
    $stmt_insert->bind_result($result);
    $stmt_insert->fetch();
    $stmt_insert->close();
    $output= json_encode($result);
}


?>

<!DOCTYPE html>
<html lang="de" ng-app="playzit">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>playzit</title>


    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link rel="icon" href="favicon.ico"/>

    <link rel="stylesheet" href="vendor/material-icons-2.2.0/material-icons.css"/>
    <link rel="stylesheet" href="vendor/roboto/roboto.css"/>

    <link rel="stylesheet" href="vendor/angular-material-1.1.5/angular-material.min.css">

    <link rel="stylesheet" href="app.css">

    <script type="text/javascript" src="vendor/jquery-3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="vendor/angularjs-1.6.6/angular.min.js"></script>
    <script type="text/javascript" src="vendor/angularjs-1.6.6/angular-resource.min.js"></script>
    <script type="text/javascript" src="vendor/angularjs-1.6.6/angular-messages.min.js"></script>
    <script type="text/javascript" src="vendor/angularjs-1.6.6/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="vendor/angularjs-1.6.6/angular-animate.min.js"></script>
    <script type="text/javascript" src="vendor/angularjs-1.6.6/angular-aria.min.js"></script>

    <script type="text/javascript" src="vendor/angular-material-1.1.5/angular-material.min.js"></script>
    <script type="text/javascript" src="vendor/angular-ui-router-1.0.8/angular-ui-router.min.js"></script>

    <script src="app.js"></script>
    <script src="components/gameCard.js"></script>
    <script src="components/gameCardList.js"></script>
    <script src="components/bewertenSpiele.js"></script>
    <script src="components/bewertenFeld.js"></script>
    <script src="components/kommentarlisteSpiele.js"></script>
    <script src="components/loginButton.js"></script>
    <script src="components/bewertungen_anzeigen.js"></script>
</head>

<body layout="column" style="height:100%">
<md-content layout="row" style="" >

    <div flex="15" flex layout="column">
        <md-sidenav
            class="md-sidenav sideNav"
            md-component-id="left"
            md-is-locked-open="true"
            md-whiteframe="4"
            flex="100">
            <md-toolbar layout="row" layout-align="start center" class="sideNavToolBar"
                        style="background-color: #173E62">
                <img src="../ressources/Logo_blau_fertig.png">

            </md-toolbar>
            <md-content layout-padding style="height: calc(100vh - 64px)" layout="column" class="sideNavContent">
                <md-button href="master_spiele.html">
                    Spiele
                </md-button>
                <md-button href="master_serien.html">
                    Serien
                </md-button>
                <h3>Spiele</h3>
                <md-button>Liste erstellen</md-button>
                <md-button>Listen ansehen</md-button>
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <h3>Serien/Filme</h3>
                <md-button>Test</md-button>
                <md-button>Test</md-button>

                <md-button id="sideNavButton" href="impressum.html">Impressum</md-button>
            </md-content>
        </md-sidenav>
    </div>

    <div layout="column" flex="85">
        <md-toolbar id="topToolBar" layout="row"  layout-align="start center" style="background-color: #173E62">

            <div layout="column" layout-align="start start" flex>
                <h2 class="md-toolbar-tools">PlayzIT</h2>
                <md-menu-bar id="topNavBar" layout-align="start center" flex layout="row">

                    <md-button href="master_spiele.html">
                        Spiele
                    </md-button>
                    <md-button href="master_serien.html">
                        Serien
                    </md-button>


                </md-menu-bar>


            </div>
            <div layout-align="center center" class="topNavBarProfileButton">
                <login-button></login-button>
            </div>

        </md-toolbar>


        <div layout="row" layout-align="center start" flex id="contentDiv" class="background_games">



            <!--md-theme="docs-dark"-->

            <md-card class="bewertungsCard">


                <md-toolbar style="background-color: #173E62">
                    <div class="md-toolbar-tools">
                        <h3>
                            <span>Bewertung von <?php echo $gameName;?></span>
                        </h3>
                    </div>
                </md-toolbar>




                <img ng-src="http://cdn.akamai.steamstatic.com/steam/apps/<?php echo $id;?>/header.jpg" class="md-card-image"
                     alt="<?php echo $id;?>">



                <div class="masterCard" >



                    <bewertung typ="game" id="<?php echo $id;?>"></bewertung>



                </div>




            </md-card>




        </div>

    </div>

</md-content>


</body>

</html>