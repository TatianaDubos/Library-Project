<?php include_once "header.php"; ?>

  <!-- Diaporama d'images -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
    </div>
  
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="Images/image1.jpg" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="Images/image2.jpeg"  class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="Images/image4.webp"  class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="Images/image3.webp"  class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="Images/image5.jpeg"  class="d-block w-100">
      </div>
    </div>
  
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  <?php include_once "footer.php"; ?>