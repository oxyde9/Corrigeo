

<?php session_start();

$db = new PDO('mysql:host=localhost;dbname=stage;port=3306', 'root', '');


$requete= "SELECT * FROM user WHERE email=:email";
$stmt=$db->prepare($requete);
$stmt->bindParam(':email',$_POST["email"], PDO::PARAM_STR); 
$stmt->execute();


if ($stmt->rowcount()==0) {
	
	echo "<p>erreur de login";
} else 
	{ $utilisateur=$stmt->fetch();
	if ($utilisateur["passwd"] != $_POST["passwd"]) {
	
	echo "<p>erreur de mdp";
		
		} else {
		echo "le passwd est bon, vous etes bien logué";
		$_SESSION["email"]=$utilisateur["email"];
		$_SESSION["id"]= $utilisateur["id"];
		}
	}
?>