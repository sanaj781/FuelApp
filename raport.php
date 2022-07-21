<div class="row text-center ">
  <h5 class="pb-3">Raport Miesięczny</h5>
</div>
<div class="row" id="raport-wraper">
  <div class="col-5">
    <?php
    include 'circle-percentage.php';
    ?>
  </div>
  <div class="col-7">
    <div class="pb-2" id="planned-budget">Planowany budżet: <?php echo $_SESSION['budget']; ?> zl</div>
    <div class="pb-2" id="planned-budget">Wydatki: <?php echo $_SESSION['current_expences']; ?> zl</div>
    <div class="pb-2" id="planned-budget">Pozostalo: <?php echo $_SESSION['budget'] - $_SESSION['current_expences']; ?> zl</div>
    <div class="pb-2" id="planned-budget">Przebieg: <?php echo $_SESSION['current_distance']; ?> km</div>
    <div class="pb-2" id="planned-budget">Przebieg Prywatny: <?php echo $_SESSION['current_private_distance']; ?> km</div>
    <div class="pb-2" id="planned-budget">Zużyto paliwa: <?php echo round($_SESSION['current_distance'] * 0.1); ?> L</div>
  </div>
</div>