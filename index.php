<?php
// Fichier unique : sql_button.php

// Configuration de la base de données
$host = 'mysql-kephrr.alwaysdata.net';
$dbname = 'kephrr_tp2';
$user = 'kephrr_tp2';
$pass = 'rootpasser';

// Requête SQL statique qui sera exécutée
$on_query = "UPDATE lampe SET etat = '1';";
$off_query = "UPDATE lampe SET etat = '0';";

// Traitement du formulaire
$results = [];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['on'])) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare($on_query);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $error = "Erreur: " . $e->getMessage();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['off'])) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare($off_query);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $error = "Erreur: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Intérupteur web</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form{
            width: 50vw;
            display: flex;
            justify-content: space-evenly;
        }
        button { 
            padding: 10px 15px; 
            margin: 10px;
            background: #4CAF50; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }
        pre { 
            background: #f4f4f4; 
            padding: 10px; 
            border-radius: 5px; 
            margin-top: 20px;
        }
        .error { color: red; }

        @media screen and (max-width:1025px){
            *{
                font-size : 100px;
            }
        }
    </style>
</head>
<body>
    <h1 id="title">Intérupteur distant</h1>
    
    <form method="post">
        <button type="submit" name="on" id="power">Allumer</button>
        <button type="submit" name="off" id="power">Eteindre</button>
    </form>
    
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php elseif (!empty($results)): ?>
        <h3>Résultats:</h3>
        <pre><?= print_r($results, true) ?></pre>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Vous pouvez vérifier la lampe !!</p>
    <?php endif; ?>
</body>
</html>
