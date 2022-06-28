<?php
echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap libraries -->
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <!-- JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
    <!-- end of bootstrap libraries -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="circle-percentage.css" />

    <title>FuelApp</title>
  </head>
  <body>
  <div class="container">
      <div class="row py-2" id="header">
        <div class="col-5" id="logo">
          <img
            id="drabpol-logo"
            src="imgs/DRABPOL-white2.b46e7a87b3dfaaba8c57.webp"
            alt=""
          />
        </div>
        <div class="col-5 offset-2" id="user-info">
          <div class="row align-items-center">
            <div class="col-6 d-flex justify-content-end p-0" id="user-name">
              <span>Denys</span>
            </div>
            <div class="col-6 d-flex justify-content-end" id="user-avatar">
              <img id="avatar" src="imgs/avatar-DSH.jpg" alt="" />
            </div>
          </div>
        </div>
      </div>
      <div class="row text-center py-5" id="your-car">
        <h5 class="pb-4">Twój Samochód:</h5>
        <div class="col-12 pb-3">
          <img id="car-img" src="imgs/car.png" alt="" />
        </div>

        <div class="row" id="car-description">
          <div class="col-4" id="car-brand">Toyota Corolla</div>
          <div class="col-4" id="car-mileage">64325 km</div>
          <div class="col-4" id="car-plates">SC 83733</div>
        </div>
        <div class="col-5 offset-7 pt-3 justify-content-end d-flex">
          <a href="#" id="change-car">Zmień Samochód</a>
        </div>
      </div>';
