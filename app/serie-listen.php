<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 10.01.2018
 * Time: 14:50
**/


session_start();
require_once "database_connection.php";



?>

<!DOCTYPE html>
<html lang="de" ng-app="playzit">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PlayzIT</title>


    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link rel="icon" href="Logo_rot_fertig.ico"/>

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
    <script src="./components/serienCard.js"></script>
    <script src="components/serienCardList.js"></script>
    <script src="components/loginButton.js"></script>
    <script src="components/bewertenSerien.js"></script>
    <script src="components/bewertenFeld.js"></script>
    <script src="components/kommentareSerien.js"></script>
    <script src="components/listeSerien.js"></script>
</head>

<body layout="column" >
<md-content layout="row" class="">

    <div flex="15" flex>
        <md-sidenav
            class="md-sidenav sideNav"
            md-component-id="left"
            md-is-locked-open="true"
            md-whiteframe="4"
            flex="100">
            <md-toolbar layout="row" layout-align="start center" class="sideNavToolBar" style="background-color:#480C0E ">
                <a href="start.html"><img src="../ressources/Logo_rot_fertig.png"></a>

            </md-toolbar>
            <md-content layout-padding style="height: calc(100vh - 64px)" layout="column" class="sideNavContent" >
                <md-button href="start.html">
                    Startseite
                </md-button>
                <h3>Spiele</h3>
                <ul>
                    <li><md-button href="liste_erstellen_spiele.html">Liste erstellen</md-button></li>
                    <li><md-button href="spiel-listen.php">Listen ansehen</md-button></li>
                </ul>
                <h3>Serien/Filme</h3>
                <ul>
                    <li><md-button href="liste_erstellen_serien.html">Liste erstellen</md-button></li>
                    <li><md-button href="serie-listen.php">Listen ansehen</md-button></li>
                </ul>

                <md-button id="sideNavButton" href="impressum.html">Impressum</md-button>
            </md-content>
        </md-sidenav>
    </div>

    <div layout="column" flex="85">
        <md-toolbar id="topToolBar"   layout="row" layout-align="start center" style="background-color:#480C0E ">

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




        <div layout="row" layout-align="center start" flex id="contentDiv"  class="background_serien">



            <!--md-theme="docs-dark"-->

            <md-card
                class="bewertungsCard">
                <md-toolbar style="background-color: #480C0E">
                    <div class="md-toolbar-tools">
                        <h3>
                            <span>Serien-Abteilung</span>
                        </h3>
                    </div>
                </md-toolbar>


                <!--
                <md-card-title-text layout="row" layout-align="center ">
                    <span class="md-headline" layout-align="center center">Spiele-Abteilung</span>
                </md-card-title-text>
                -->
                <!--<div layout="row" class="masterCardButtonBox" layout-align="center start" flex>
                <md-button flex="50" class="md-raised md-primary ">Bewertung abgeben</md-button>
                <md-button flex="50" class="md-raised md-primary ">Bewertung abgeben</md-button>
            </div>
                <div layout="row"  class="masterCardButtonBox" layout-align="center start" flex>
                    <md-button flex="50" class="md-raised md-primary ">Bewertung abgeben</md-button>
                    <md-button flex="50" class="md-raised md-primary">Bewertung abgeben</md-button>
                </div>
    -->


                <div flex layout-align="center start" class="masterCardList" flex layout="row">

                    <liste-serien flex="100"></liste-serien>
                </div>





            </md-card>




        </div>

    </div>
</md-content>





</body>

</html>
