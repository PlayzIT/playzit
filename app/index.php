<!DOCTYPE html>
<html lang="de" ng-app="playzit">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PlayzIT</title>


    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link rel="icon" href="Logo_voll_fertig.ico"/>

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
    <script src="components/loginButton.js"></script>
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
            <md-toolbar layout="row" layout-align="start center" class="sideNavToolBar">
                <a href="start.html"><img src="../ressources/logo.png"></a>

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
    <md-toolbar id="topToolBar"   layout="row" layout-align="start center" >

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




    <div layout="row" layout-align="center start"  flex id="contentDiv">
        <div flex="80" style="height:100%">CONTENT</div>
    </div>

</div>
</md-content>





</body>

</html>