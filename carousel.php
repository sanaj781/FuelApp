<div id="carouselExampleControls" class="carousel slide" data-bs-interval="false" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $cars = explode(",", $_SESSION['cars']);
        for ($i = 0; $i < count($_SESSION['arrayOfcars']['id']); $i++) {
        ?>
            <div class="carousel-item<?php if ($_SESSION['default_car'] == $_SESSION['arrayOfcars']['id'][$i]) {
                                        ?> active">
                <?php } else { ?>"><?php } ?>

                <div class="col-12 pb-3 text-center w-100">
                    <img src="imgs/<?php echo $_SESSION['arrayOfcars']['car_img'][$i] ?>" class="img-car" alt="...">
                </div>
                <div class="col-12 d-flex justify-content-between" id="car-description">
                    <div class="" id="car-brand"><?php echo $_SESSION['arrayOfcars']['car_model'][$i] ?></div>
                    <div class="" id="car-mileage"><?php echo $_SESSION['arrayOfcars']['oddometer'][$i] ?> km</div>
                    <div class=" " id="car-plates"><?php echo $_SESSION['arrayOfcars']['reg_nr'][$i] ?></div>
                </div>
                <input type="hidden" id="car_reg_nr" value="<?php echo $_SESSION['arrayOfcars']['reg_nr'][$i] ?>">
                <input type="hidden" id="car_id" value="<?php echo $_SESSION['arrayOfcars']['id'][$i] ?>">

            </div>
        <?php } ?>
        <input type="hidden" id="car_ids" value="<?php implode(" ,", $cars) ?>">
    </div>
    <a class=" carousel-control-prev" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class=" carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
<script>
    const myCarousel = document.getElementById("carouselExampleControls");
    myCarousel.addEventListener("slid.bs.carousel", (event) => {
        document.getElementsByClassName("carousel-item");
        if (event.direction === "left" || event.direction === "right") changeCar();
    });
</script>