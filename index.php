<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Corrigeo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
<style>
  h5 {
  display: inline-block;
  padding: 10px;
  background: #B9121B;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.p {
  text-align: center;
  padding-top: 40px;
  font-size: 13px;
}
</style>
</head>
<body>
<?php session_start()?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">
     
      <li class="nav-item">
        <a class="nav-link" href="enregistrement.php">Enregistrement</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>

    
    </ul>
  </div>
</nav>
<!-- partial:index.partial.html -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 " src="https://histoirebnf.hypotheses.org/files/2018/02/Cit%C3%A9-des-femmes-manuscrit.jpg" data-color="lightblue" alt="First Image">
      <div class="carousel-caption d-md-block">
        <h5>First Image</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 " src="https://i.pinimg.com/originals/33/4e/98/334e983731d3d2b093bb59e483b35b85.jpg" data-color="firebrick" alt="Second Image">
      <div class="carousel-caption d-md-block">
        <h5>Second Image</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://idata.over-blog.com/2/72/00/88/gemmes/cite-des-dames-capella-ministrers/Christine-de-Pizan-La-Cite-des-Dames-Harley-4431-fol-323.jpg" data-color="violet" alt="Third Image">
      <div class="carousel-caption d-md-block">
        <h5>Third Image</h5>
      </div>
    </div>
  </div>
  <!-- Controls -->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://unpkg.com/popper.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script>
$('.carousel').carousel({
  interval: 6000,
  pause: "false"
});

</script>

</body>
</html>
