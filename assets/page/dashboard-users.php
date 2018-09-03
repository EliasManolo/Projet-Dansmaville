<?php
  session_start();
  include "bdd.php";

  if($_GET['id']!=""){
    $getid = intval($_GET['id']);
    $getid = "WHERE id_membre = '$getid'";
  }else{$getid = "";}

  $sql = "SELECT * FROM signalements $getid";
  $selectsignal = $bdd->query($sql);
  $selectsignal->setFetchMode(PDO::FETCH_ASSOC);

  $sql2 = "SELECT * FROM signalements WHERE id_etat=2 OR id_etat=3";
  $signalaccepted = $bdd->query($sql2);
  $signalaccepted->setFetchMode(PDO::FETCH_ASSOC);
  $if_exist = $signalaccepted -> rowCount();
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
<header id="dash-2">
  <div>
    <a href="deconnexion.php">Déconnexion</a>
  </div>
</header>
<body>
  <h2 id="dash-title-2">Tableau de bord de <?php echo $userinfo['pseudo']; ?></h2>
  <div id="signal-redirection">
    <a href="signal.php?id=<?php echo $_SESSION['id']; ?>">SIGNALER</a>
  </div>
  <section id="page-dashboard-users">
    <div id="my-signal-one">
      <p id="my-signal">Mes signalements</p>
      <table>
        <thead>
        <td>Id Signalement</td>
        <td>Date</td>
        <td>Adresse</td>
        <td>Type d'anomalie</td>
        <td>Description</td>
        <td>Priorité</td>
        <td>État</td>
      </thead>
      <?php foreach ($selectsignal as $s){ ?>
        <tr>
        <td><?php  echo $s['id'];?></td>
        <td><?php  echo $s['datenow'];?></td>
        <td><?php  echo $s['adress'];?></td>
        <td><?php  echo $s['type'];?></td>
        <td><?php  echo $s['description'];?></td>
        <td><?php  echo $s['priorite'];?></td>
        <td><?php  echo $s['id_etat'];?></td>
      </tr></form>
      <?php } ?>
    </div>
  </table>
    <div id="signaled-two">
      <p id="signaled-2">Les signalements</p>
      <table>
        <thead>
        <td>Id Signalement</td>
        <td>Date</td>
        <td>Adresse</td>
        <td>Type d'anomalie</td>
        <td>Description</td>
        <td>Priorité</td>
        <td>État</td>
        </thead>
        <?php

        foreach ($signalaccepted as $s2){ ?>
          <tr>
          <td><?php  echo $s2['id'];?></td>
          <td><?php  echo $s2['datenow'];?></td>
          <td><?php  echo $s2['adress'];?></td>
          <td><?php  echo $s2['type'];?></td>
          <td><?php  echo $s2['description'];?></td>
          <td><?php  echo $s2['priorite'];?></td>
          <td><?php  echo $s2['id_etat'];?></td>
          </tr></form>
         <?php }  ?>
       </table>
    </div>
  </section>
</body>
<div id="statements">
<p>État:</p>
<p>1 = En attente de validation</p>
<p>2 = En cours</p>
<p>3 = Terminé</p>
</div>
</html>
