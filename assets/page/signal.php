<?php
session_start();
include("bdd.php");
$id = $_SESSION['id'];
if (isset($_POST['formenvoi']))
{
     if(!empty($_POST['datenow']) AND !empty($_POST['adress']) AND !empty($_POST['type']) AND !empty($_POST['description']) AND !empty($_POST['prio']))

      $date = htmlspecialchars($_POST['datenow']);
      $adress = htmlspecialchars($_POST['adress']);
      $type = htmlspecialchars($_POST['type']);
      $description = htmlspecialchars($_POST['description']);
      $prio = htmlspecialchars($_POST['prio']);

      $insertform = $bdd->prepare("INSERT INTO signalements (id_membre, datenow, adress, type, description, priorite, id_etat) VALUES (?, ?, ?, ?, ?, ?, 1)");
      $insertform->execute(array($id, $date, $adress, $type, $description, $prio));
      $erreur = "<p style='color:red; font-weight:bold; margin:auto;'>Signalement envoyé. Merci</p>";
      header( "refresh:3;url=dashboard-users.php?id=".$id );
    }
 ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dans ma ville</title>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/style-tablette.css">
  <link rel="stylesheet" href="../css/style-tablette-xs.css">
  <link rel="stylesheet" href="../css/style-phone.css">
</head>
<header id="signal-deco">
  <div>
    <a href="deconnexion.php">Déconnexion</a>
  </div>
</header>
<body>
  <section id="page-signal">
    <h2>Formulaire de signalement</h2>
    <form enctype="multipart/form-data" method="post" action="signal.php">

      <label for="datenow">Date</label>
      <input type="date" name="datenow" value="<?php echo date("Y-m-d"); ?>" required/>

      <div id="loca">
        <label for="adress">Adresse</label>
        <input type="text" name="adress" required>
      </div>

      <label for="type">Type d'anomalie</label>
      <select name="type" required>
        <option>Graffitis, Affiches sauvage...</option>
        <option>Objets abandonnées</option>
        <option>Voirie</option>
        <option>Arbres, Végétaux</option>
        <option>Animaux</option>
        <option>Eclairage / Éléctricité</option>
        <option>Eau / Assainissement</option>
        <option>Mobilier urbains (dégradés, en panne...)</option>
        <option>Propreté</option>
      </select>


      <label for="description">Décrivez l'anomalie</label>
      <textarea name="description" required></textarea>

      <label for="prio">Priorité</label>
      <select name="prio" required>
        <option>Génant</option>
        <option>Trés génant</option>
        <option>Dangereux</option>
      </select>
      <div id="btn">
        <input id="envoi" name="formenvoi" type="submit" value="Envoyer" />
        <div id="envoi">
          <a href="javascript:history.go(-1)">Annuler</a>
        </div>
      </div>
      <?php
if (isset($erreur))
{
  echo $erreur;
}

?>
    </form>
  </section>
</body>
</html>
