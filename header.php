<?php
session_start();

if (!isset($_SESSION['initiate'])) {
  session_regenerate_id();
  $new_session_id = session_id();
  session_write_close();
  session_id(($new_session_id));
  session_start();
  $_SESSION['initiate'] = 1;
}
include 'back-end/functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0  maximum-scale=1.0, user-scalable=no" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>





  <!-- bootstrap libraries -->
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="circle-percentage.css" />
  <script type="text/javascript" src="js/js.js"></script>


  <title>FuelApp</title>
</head>

<body>

  <div id="alert-mobile-only" class="col-12 text-center">Strona jest dedykowana dla urządzeń mobilnych horizontal view<br> Wersja dla PC jest w trakcie przygotowania</div>

  <div class="container">
    <div class="row align-items-center" id="header">
      <div class="col-3" id="logo">
        <img id="drabpol-logo" src="imgs/DRABPOL-white2.b46e7a87b3dfaaba8c57.webp" alt="" />
      </div>
      <?php
      if (
        isset($_SESSION['logedin']) && $_SESSION['logedin'] === 1 && isset($_SESSION['username'])
        && isset($_SESSION['car_reg_nr']) && $_SESSION['userinfo'] === $_SERVER['HTTP_USER_AGENT']
      ) {
      ?>
        <div class="col-5 offset-4" id="user-info">
          <div class="row align-items-center">
            <div class="col-12 d-flex justify-content-end">

              <a class="btn me-1" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <span id="username" class="me-1"><?php echo $_SESSION['name'] ?></span>
                <img class="" id="avatar" src="imgs/avatar-<?php echo $_SESSION['username']; ?>.jpg" alt="" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="?page=trips-history">Moje Wyjazdy</a></li>
                <li><a class="dropdown-item" href="?page=invoice-history">Moje Faktury</a></li>
                <li><a class="dropdown-item" href="?page=logout">Wyloguj</a></li>
              </ul>
            </div>
          </div>
        </div>
    </div>

    <div class="row text-center pt-5 my-2" id="your-car">
      <div class="col-12">
        <h5 class="text-center mt-3 pb-3">Wybrany Samochód</h5>
        <?php
        change_default_car();
        include 'carousel.php'      ?>
        <div class="SubmitCarButton">
          <a id="SubmitCarButton" class="  hidden mt-2 w-100 btn btn-primary"> </a>
        </div>
      </div>
    </div>

  <?php
      } else {
  ?>
  </div><?php
      } ?>