<?php
$bdd = new PDO('mysql:host=localhost;dbname=id5293685_espace_membre', 'id5293685_root', '123456789');

if (isset($_GET['id']) AND $_GET['id'] > 0)
{
$getid = intval($_GET['id']);
$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();
}
 ?>
