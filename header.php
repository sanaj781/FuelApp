<?php
session_start();
include_once 'back-end/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0  maximum-scale=1.0, user-scalable=no" />

  <!-- bootstrap libraries -->
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="circle-percentage.css" />

  <title>FuelApp</title>
</head>

<body>
  <div class="container">
    <div class="row align-items-center" id="header">
      <div class="col-3" id="logo">
        <img id="drabpol-logo" src="imgs/DRABPOL-white2.b46e7a87b3dfaaba8c57.webp" alt="" />
      </div>
      <?php
      if ($_SESSION['logedin'] === 1) {
      ?>
        <div class="col-5 offset-4" id="user-info">
          <div class="row align-items-center">
            <div class="col-6 d-flex justify-content-end p-0" id="user-name">
              <span><?php echo $_SESSION['name'] ?></span>
            </div>
            <div class="col-6 d-flex justify-content-start" id="user-avatar">

              <div class="dropdown">
                <a class="btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <img id="avatar" src="imgs/avatar-<?php echo $_SESSION['username']; ?>.jpg" alt="" />
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="?page=choose-car">Zmień samochód</a></li>
                  <li><a class="dropdown-item" href="?page=logout">Wyloguj</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row text-center py-5" id="your-car">
      <h5 class="pb-1">Twój Samochód:
      </h5>
      <div class="col-12 pb-3">
        <img id="car-img" src="imgs/<?php echo $_SESSION['car_img'] ?>" alt="" />
      </div>

      <div class="row" id="car-description">
        <div class="col-4" id="car-brand"><?php echo $_SESSION['car_model'] ?></div>
        <div class="col-4" id="car-mileage"><?php echo $_SESSION['car_oddometer'] ?></div>
        <div class="col-4" id="car-plates"><?php echo $_SESSION['car_reg_nr'] ?></div>
      </div>

    </div>
  <?php
      } else {
  ?>
  </div><?php
      } ?>