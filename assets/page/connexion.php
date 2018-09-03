<?php
$bdd = new PDO('mysql:host=localhost;dbname=id5293685_espace_membre', 'id5293685_root', '123456789');
session_start();

if (isset($_POST['formconnexion']))
{
     $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
     $mdpconnect = sha1($_POST['mdpconnect']);

     if(!empty($_POST['pseudoconnect']) AND !empty($_POST['mdpconnect']))
     {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND password = ?");
        $requser->execute(array($pseudoconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['password'] = $userinfo['password'];
         if ($userinfo['id_role'] == 1) {
          header("location:dashboard.php?id=".$_SESSION['id']);
         }
         else {
           header("location:dashboard-users.php?id=".$_SESSION['id']);
         }

        }
        else {
          $erreur = "<p style='color:red;'>Mauvais pseudo ou mauvais mot de passe !</p>";
        }
     }
     else
      {
       $erreur = "<p style='color:red;'>Tous les champs doivent être complétés !</p>";
     }
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
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/style-tablette.css">
  <link rel="stylesheet" href="../css/style-tablette-xs.css">
  <link rel="stylesheet" href="../css/style-phone.css">
  <script type="text/javascript" src="../js/app.js"></script>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="../../index.html"><img class="img-fluid" src="../img/logo.png"></a>
      <h2>Dans Ma Ville</h2>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../../index.html">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="description.html">Description</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">S'inscrire</a>
          </li>
        </ul>
      </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </header>
  <section id="page-connexion">
    <h2>Connexion</h2>
  <form method="post" action="connexion.php">
    <?php
if (isset($erreur))
{
echo $erreur;
}

?>
    <label for="pseudoconnect">Pseudo</label>
    <input class="inputput" type="text" name="pseudoconnect" />

    <label for="mdpconnect">Mot de Passe</label>
    <input class="inputput" type="password" name="mdpconnect" />

    <div id="btn-co">
      <input name="formconnexion" type="submit" value="Connexion" />
      <div>
      <a class="emptyInput">Annuler</a>
      </div>
    </div>

    <div id="login">
      <p>Pas encore inscrit ?</p>
      <a href="register.php">S’inscrire</a>
    </div>
  </form>
</section>

</body>

</html>
