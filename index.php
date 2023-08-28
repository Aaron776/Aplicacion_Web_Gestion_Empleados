<?php include('templates/header.php'); ?>
    <div class="p-5 mb-4 bg-light rounded-3 text-center">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenido al Sistema</h1>
        <p class="col-md-8 fs-4"><?php echo $_SESSION['usuario']; ?></p>
        <img src="https://miro.medium.com/v2/resize:fit:1400/1*PAnToO8QAcJGuX0dfdHaWA.jpeg" width="300px" height="300px">
      </div>
    </div>
<?php include('templates/footer.php'); ?>