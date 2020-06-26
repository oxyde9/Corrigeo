<?php include("config.php");

if(isset($_GET["action"])){
    
    if($_GET["action"]=="write"){
        $nom = $_GET["name"];
        $lat = $_GET["lat"];
        $lon = $_GET["lon"];
        
$requete= "SELECT * FROM geoloc WHERE name=:name";
$stmt=$db->prepare($requete);
$stmt->bindParam(':name',$_GET["name"], PDO::PARAM_STR); 
$stmt->execute();



        if ($stmt->rowcount()==0) {
   
          $sql = "INSERT INTO geoloc( name, lat, lon) VALUES (?, ?, ?);";
          $req = $db->prepare($sql);
    
          $req->execute([ $nom, $lat, $lon]);

        } else 
          { 
                 //select 
          }
       
    
    
    
    }

     if($_GET["action"]=="read"){
        $name = $_GET['name'];
        $sql = "SELECT * FROM geoloc WHERE name = :name " ;//recuperer dans le point de ? ce qu'il y a dans le GET
      $req = $db->prepare($sql);
    
     $req->execute(array(":name"=>$name));
     echo json_encode($req->fetchAll());
     }
    

     if($_GET["action"]=="addText"){
      $texte = $_GET["text"];
 
      //select 

      $sql = "INSERT INTO text( text) VALUES (:texte);";
  
   $req = $db->prepare($sql);
  
   $req->execute(array(":texte"=>$texte));
  
  }
}
  
$q = $this->db->prepare('UPDATE personnages SET pv = :pv, atk = :atk, name = :name WHERE id = :id');
    
$q->bindValue(':name', $perso->getName());
$q->bindValue(':pv', $perso->getPv());
$q->bindValue(':atk', $perso->getAtk());
$q->bindValue(':id', $perso->getId());
$q->execute();