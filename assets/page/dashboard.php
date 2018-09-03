<?php
session_start();
include "bdd.php";

$sql = "SELECT * FROM signalements WHERE id_etat=1";
$selectsignal = $bdd->query($sql);
$selectsignal->setFetchMode(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM signalements WHERE id_etat=2 OR id_etat=3";
$signalaccepted = $bdd->query($sql2);
$signalaccepted->setFetchMode(PDO::FETCH_ASSOC);
$if_exist = $signalaccepted -> rowCount();

if (isset($_POST['ok'])) {
      $ids = $_POST['id_s'];
      $status = 2;
      $sth = $bdd->prepare("UPDATE signalements SET `id_etat` = :id_etat WHERE `id` = :id");
      $sth->bindParam(':id_etat', $status);
      $sth->bindValue(':id', $ids);
      $sth->execute();
}
if (isset($_POST['nope'])) {
      $ids = $_POST['id_s'];
      $status = 2;
      $sth = $bdd->prepare("DELETE FROM signalements WHERE `id` = :id");
      $sth->bindValue(':id', $ids);
      $sth->execute();
}
if (isset($_POST['change'])) {
      $ids = $_POST['id_s'];
      $status = 3;
      $sth = $bdd->prepare("UPDATE signalements SET `id_etat` = :id_etat WHERE `id` = :id");
      $sth->bindParam(':id_etat', $status);
      $sth->bindValue(':id', $ids);
      $sth->execute();

}
 ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dans ma ville</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/style-tablette.css">
  <link rel="stylesheet" href="../css/style-tablette-xs.css">
  <link rel="stylesheet" href="../css/style-phone.css">
</head>
<header id="dash">
  <div>
    <a href="deconnexion.php">Déconnexion</a>
  </div>
</header>

<body>
  <h2 id="dash-title">Tableau de bord de <?php echo $userinfo['pseudo']; ?></h2>
  <section id="page-dashboard">
    <div id="new-one">
      <p id="new">Nouveaux signalements</p>
      <table>
        <thead>
        <td>Id Signalement</td>
        <td>Id Membre</td>
        <td>Date</td>
        <td>Adresse</td>
        <td>Type d'anomalie</td>
        <td>Description</td>
        <td>Priorité</td>
        <td>État</td>
        <td>Accepter</td>
        <td>Refuser</td>
      </thead>
        <?php foreach ($selectsignal as $s){ ?>
          <form class="" action="" method="post">
          <input type="hidden" name="id_s" value="<?php  echo $s['id']; ?>">
          <tr>
          <td><?php  echo $s['id'];?></td>
          <td><?php  echo $s['id_membre'];?></td>
          <td><?php  echo $s['datenow'];?></td>
          <td><?php  echo $s['adress'];?></td>
          <td><?php  echo $s['type'];?></td>
          <td><?php  echo $s['description'];?></td>
          <td><?php  echo $s['priorite'];?></td>
          <td><?php  echo $s['id_etat'];?></td>
          <td><button id="ok" name="ok">O</button></td>
          <td><button id="nope" name="nope">X</button></td>
        </tr></form>
        <?php } ?>
      </table>
    </div>
    <div id="signaled-one">
      <p id="signaled">Les signalements</p>
      <table>
        <thead>
        <td>Id Signalement</td>
        <td>Id Membre</td>
        <td>Date</td>
        <td>Adresse</td>
        <td>Type Anomalie</td>
        <td>Description</td>
        <td>Priorité</td>
        <td>État</td>
        <td>Terminé</td>
        </thead>
        <?php

        foreach ($signalaccepted as $s2){ ?>
          <form class="" action="" method="post">
          <input type="hidden" name="id_s" value="<?php  echo $s2['id']; ?>">
          <tr>
          <td><?php  echo $s2['id'];?></td>
          <td><?php  echo $s2['id_membre'];?></td>
          <td><?php  echo $s2['datenow'];?></td>
          <td><?php  echo $s2['adress'];?></td>
          <td><?php  echo $s2['type'];?></td>
          <td><?php  echo $s2['description'];?></td>
          <td><?php  echo $s2['priorite'];?></td>
          <td><?php  echo $s2['id_etat'];?></td>
          <td><button id="change" name="change">V</button></td>
          </tr></form>
         <?php }  ?>
       </table>
    </div>
  </section>
</body>
</html>
