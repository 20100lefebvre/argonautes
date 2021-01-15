<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/ico" href="images/favicon.ico"><!--favicon-->
  <link rel="stylesheet" href="style/challenge.css" /><!--CSS-->

  <script src='script/challenge.js' async></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- http://vincent.developpeur.free.fr/Challenge-Wild/challenge.php -->
  <title>Challenge</title>
</head>
<body>


<!-- Header section -->
<header>
    <h1>Les Argonautes</h1>
</header>

  <!-- Main section -->
  <main>

    <!-- New member form -->
    <h2>Ajouter un(e) Argonaute</h2>
    <form class="new-member-form" action="challenge.php" method="post">
      <label for="name">Nom de l&apos;Argonaute</label>
      <input id="name" name="name" type="text" placeholder="Charalampos" />
      <button id="add" type="submit">Envoyer</button>
    </form>
    <h2>Membres de l'équipage</h2>

<?php
// connect

    $server = 'sql.free.fr';
    $login = 'vincent.developpeur';
    $password = 'Motdepasse';
    $nameTable = 'argonautes';

    try{
  $bdd = new PDO("mysql:host = $server; dbname = $nameTable; charset=utf8", $login,$password);
    }
    catch (Exception $e)
    {
      die('Erreur: ' . $e->getMessage());
    }
//************************************************************************************************************************************ */
// recuperation data

  $response = $bdd->query('SELECT id, name FROM argonautes ORDER BY id');
  while($data = $response->fetch())
  {
  echo '<section class="member-list"><div class="member-item"><ul><li>' . $data['id'] . " --> " . htmlspecialchars($data['name']) . '</li></ul></div></section>';
  }
  $response -> closeCursor();
//************************************************************************************************************************************ */
// insert data
$req = $bdd -> prepare('INSERT INTO argonautes (name) VALUES(?)');
$req -> execute(array($_POST['name']));

?>
 <!-- Member list -->
<!-- Response list 3 columns = 17 /column for 50 items-->
<!-- <div class="member-item">Eleftheria</div>
      <div class="member-item">Gennadios</div>
      <div class="member-item">Lysimachos</div> -->
</main>
<footer>
    <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC & AVincent Lefebvre</p>
  </footer>
</body>
</html>