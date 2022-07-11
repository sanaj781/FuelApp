<div class="d-flex text-center align-items-center" id="menu">
    <a href="?page=start-ride" class="col-3 g-0">
        <div class="" id="menu-item">
            <i class="bi bi-caret-right-fill"></i>
            <div>Rozpocznij Wyjazd</div>
        </div>
    </a>
    <a href="?page=add-document" class="col-3 g-0">
        <div class="" id="menu-item">
            <i class="bi bi-file-plus"></i>
            <div>Dodaj Fakturę</div>
        </div>
    </a>
    <a href="?page=history" class="col-3 g-0">

        <div class="" id="menu-item">
            <i class="bi bi-card-list"></i>
            <div>Moje Faktury</div>
        </div>
    </a>
    <a href="?page=raport" class="col-3 g-0">
        <div class="" id="menu-item-last">
            <i class="bi bi-receipt-cutoff"></i>
            <div>Raport</div>
        </div>
    </a>
</div>
</div>
<style>
    a {
        text-decoration: none !important;
        color: unset;
    }

    #header {
        height: 50px;
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        font-size: 0.7em;
        background-color: #232d4f;
        color: whitesmoke;
    }

    #drabpol-logo {
        height: 40px;
        padding-left: 10px;
    }

    #avatar {
        border-radius: 100%;
        border: 1px solid white;
        width: 36px;
    }

    #car-img {
        width: 100%;
    }

    #your-car {
        margin-top: 30px;
    }

    #change-car {}

    #menu {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 50px;
        font-size: 0.7em;
        background-color: #232d4f;
        color: whitesmoke;
    }

    #menu-item {
        border-right: 1px solid whitesmoke;
    }

    #raport-wraper,
    #add-doc-wraper,
    #history-wraper {
        margin-bottom: 100px !important;
    }

    #login-form {
        height: 100vh;
    }

    #choose-car {
        font-size: 0.5em;
        height: 50px;
        border-bottom: 1px solid whitesmoke;
        border-top: 1px solid whitesmoke;
    }

    /* start circle percent */
    .flex-wrapper {
        display: flex;
        flex-flow: row nowrap;
    }

    .single-chart {
        width: 100%;
        justify-content: space-around;
    }

    .circular-chart {
        display: block;
        margin: 10px auto;
        max-width: 80%;
        max-height: 250px;
    }

    .circle-bg {
        fill: none;
        stroke: #eee;
        stroke-width: 3.8;
    }

    .circle {
        fill: none;
        stroke-width: 2.8;
        stroke-linecap: round;
        animation: progress 1s ease-out forwards;
    }

    @keyframes progress {
        0% {
            stroke-dasharray: 0 100;
        }
    }

    .circular-chart.orange .circle {
        stroke: #ff9f00;
    }

    .circular-chart.green .circle {
        stroke: #4cc790;
    }

    .circular-chart.blue .circle {
        stroke: #3c9ee5;
    }

    .percentage {
        fill: #666;
        font-family: sans-serif;
        font-size: 0.5em;
        text-anchor: middle;
    }

    /* end circle perc */
</style>
</body>

</html>