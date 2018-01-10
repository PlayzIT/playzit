<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 08.01.2018
 * Time: 11:20
 */?>
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
    <script src="components/listeSpiele.js"></script>
    <script src="components/loginButton.js"></script>
</head>

<body layout="column" style="height:100%">
<md-content layout="row" style="">

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
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <h3>Abteilung</h3>
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <md-button>Test</md-button>
                <h3>Abteilung</h3>
                <md-button>Test</md-button>
                <md-button>Test</md-button>


                <md-button id="sideNavButton">Impressum</md-button>
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


        <div layout="row" layout-align="center start" flex id="contentDiv" >



            <!--md-theme="docs-dark"-->

            <md-card
                class="contentCard">
                <md-toolbar style="background-color: #173E62">
                    <div class="md-toolbar-tools">
                        <h3>
                            <span>Spiele-Abteilung</span>
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



                <!--

                                        <div flex layout-align="center start" class="masterCardGameCard">




                                                <game-card name="Half-Life" id="70" description="bla bla bla bla bla bla bla bla blla bla bla bla  bla blabla bla bla bla bla bla bla bla bla"></game-card>
                                                <game-card name="Half-Life" id="70" description="bla bla blala bla bla bla bla bla la bla bla blaa bla blabla bla bla bla bla bla bla bla bla"></game-card>
                                                <game-card name="Half-Life" id="70" description="bla bla bla bla  bla bbla blblabla bla bla b bla bla blabla bla bla bla bla bla bla bla bla"></game-card>


                                        </div>


                -->
                <div flex layout-align="center start" class="masterCardList" flex layout="row">

                    <liste-spiele flex="100"></liste-spiele>
                </div>



            </md-card>




        </div>

    </div>

</md-content>


</body>

</html>
