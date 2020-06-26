<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=stage;port=3306', 'root', '');

$requete= "INSERT INTO user VALUES (NULL,:nom,:email,:passwd)";

$stmt= $db->prepare($requete);
$stmt->bindParam(':nom',$_POST["nom"] , PDO::PARAM_STR); 
$stmt->bindParam(':email',$_POST["email"] , PDO::PARAM_STR); 
$stmt->bindParam(':passwd',$_POST["passwd"] , PDO::PARAM_STR); 

$stmt->execute();
header('Location:connexion.php');
echo "vous etez connecte";
?>