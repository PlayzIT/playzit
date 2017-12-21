<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 21.12.2017
 * Time: 16:34
 */

session_start();

if(isset($_SESSION['benutzername'])){
    echo true;
}else{
    echo false;
}
