<?php

require '../phpScript/ScriptBDD.php';
require '../phpClass/ClassLogin.php';

$loginPost = $_POST['login'];
$mdpPost = $_POST['mdp'];

$loginStatement = new Login($loginPost);

if($loginStatement->connexion($mdpPost,$loginPost))
{
    header('Location: ../view/nouveauCR.php');
} else
{
    header('Location: ../../index.php?e=1');
}
