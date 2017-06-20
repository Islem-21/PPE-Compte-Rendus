<?php
require_once('../phpClass/ClassBDD.php');
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", 'comptesrendus');

$bdd = new BDD();


$bdd->query('update visiteur set VIS_MDP = VIS_DATEEMBAUCHE');
$bdd->execute();


$bdd->query('select VIS_DATEEMBAUCHE from visiteur');
$row = $bdd->resultset();
$old = [];

foreach ($row as $value)
{
    $old = $value['VIS_DATEEMBAUCHE'];
    $new = substr($value['VIS_DATEEMBAUCHE'], 0, strpos($value['VIS_DATEEMBAUCHE'], " "));
    $bdd->query("update visiteur set VIS_MDP = :new where VIS_MDP = :old");
    $bdd->bind(':new', $new);
    $bdd->bind(':old', $old);
    $bdd->execute();
}


$bdd->query('select VIS_MDP from visiteur');
$row = $bdd->resultset();

foreach ($row as $value)
{
    $oldMdp = $value['VIS_MDP'];
    $newMdp = password_hash($value['VIS_MDP'],PASSWORD_DEFAULT);
    $bdd->query("update visiteur set VIS_MDP = :newMdp where VIS_MDP = :oldMdp");
    $bdd->bind(':newMdp', $newMdp);
    $bdd->bind(':oldMdp', $oldMdp);
    $bdd->execute();
}


