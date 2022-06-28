<?php
echo '<div class="row text-center">
<h5 class="pb-3">Raport Miesięczny</h5>
</div>
<div class="row">
<div class="col-5 my-auto">';
include 'circle-percentage.php';

echo '
</div>
<div class="col-7">
  <div class="pb-2" id="planned-budget">Planowany budżet: 1500 zl</div>
  <div class="pb-2" id="planned-budget">Pozostalo: 750 zl</div>
  <div class="pb-2" id="planned-budget">Przebieg: 1300 km</div>
  <div class="pb-2" id="planned-budget">Zużyto paliwa: 70L</div>
  <div class="pb-2" id="planned-budget">Dystans: 700 km</div>
</div>
</div>
';
