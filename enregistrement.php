<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
.container{
    margin-top:10%;
}
</style>
</head>
<body>
<?php session_start()?>

    <div class="container">
<div class="row">
         <div class="col-md-4 mx-auto">
            <div class="myform form ">
               <h3>Rentre les informations suivantes:</h3>
               <form action="traitement.php" method="post">
                  
                  <div class="form-group">
                     <input type="text" name="nom" required class="form-control my-input"  placeholder="Inserez votre nom">
                  </div>
                  <div class="form-group">
                  
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Inserez votre email">
                   
                  </div>
                  <div class="form-group">
                     <input type="password" name="passwd" required class="form-control my-input"  placeholder="Mot de Passe">
                  </div>
                  
                  <div class="form-group">
                     <input type="submit"  class="btn btn-outline-info" value="Sign Up">
                  </div>
               </form>
            </div>
         </div>
      </div>
</div>

</body>
</html>