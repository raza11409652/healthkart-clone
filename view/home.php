<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
?>
<section class="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="https://img2.hkrtcdn.com/10640/bnr_1063971_o.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="https://img6.hkrtcdn.com/10640/bnr_1063935_o.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="https://img8.hkrtcdn.com/10640/bnr_1063937_o.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</section>
<section class="trending-now">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto text-center mb-5 section-heading">
                    <h2 class="">Popular In Sports Nutrition</h2>
                </div>
            </div>
            <!-- content -->
            <div class="row ">
                <div class="col-lg-3 wow zoomIn" data-wow-duration="1s">
                    <div class="card-trend-item">
                        <div class="card-image">
                            <img src="image/drink.svg" alt="">
                        </div>
                        <div class="card-text text-center">
                            <h5>Mass gainer</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wow zoomIn" data-wow-duration="1s">
                    <div class="card-trend-item">
                        <div class="card-image">
                            <img src="image/protein.svg" alt="">
                        </div>
                        <div class="card-text text-center">
                            <h5>Mass gainer</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wow zoomIn" data-wow-duration="1s">
                    <div class="card-trend-item">
                        <div class="card-image">
                            <img src="image/bar-p.svg" alt="">
                        </div>
                        <div class="card-text text-center">
                            <h5>Mass gainer</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wow zoomIn" data-wow-duration="1s">
                    <div class="card-trend-item">
                        <div class="card-image">
                            <img src="image/medicines.svg" alt="">
                        </div>
                        <div class="card-text text-center">
                            <h5>Mass gainer</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="" class="btn btn-theme-primary">View All</a>
            </div>
        </div>
</section>

<?php require_once "includes/footer.php"; ?>
