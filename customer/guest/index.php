<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./style/style.css">

</head>

<body class="" style="background-color: #f2f2f2;">

   <?php require('../navbar/nav.php')?>

<div class="container-fluid">
<!-- Carousel -->
<div class="row border border-success">
<div class="col-sm-12">


<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <!-- Slide 1 -->
            <div class="carousel-item active" data-bs-interval="1000">
                <img src="../assets/images/5.jpg" class="d-block w-100" alt="hotel services" style="object-fit: cover; height:500px;">
                <div class="carousel-caption position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white p-3">
                    <h3>Lorem Ipsum</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero, sapiente?</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" data-bs-interval="2000">
                <img src="../assets/images/5.jpg" class="d-block w-100" alt="hotel services" style="object-fit: cover; height:500px;">
                <div class="carousel-caption position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white p-3">
                    <h3>Lorem Ipsum</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero, sapiente?</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item border border-danger border-3">
                <img src="../assets/images/5.jpg" class="d-block w-100" alt="hotel services" style="object-fit: cover; height:500px;">
                <div class="carousel-caption position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white p-3">
                    <h3>Lorem Ipsum</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero, sapiente?</p>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

</div>
    </div>
    <?php
    // Query to fetch from the properties table 
$sql=  "SELECT * FROM `HOTEL_ROOMS` where  ";


?>




<!-- Product Cards  -->
 <div class="row p-5">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card hotel-card" data-bs-toggle="modal" data-bs-target="#hotelModal">
                <div class="position-relative">
                    <img src="../assets/images/2.jpg" class="card-img-top" alt="Hotel Image">
                    <div class="price-tag">$150/night</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Luxury Hotel</h5>
                    <p class="card-text"><i class="bi bi-geo-alt"></i> New York, USA</p>
                    <p class="card-text text-warning">⭐⭐⭐⭐☆ (4.5/5)</p>
                    <button class="btn btn-primary w-100">View More</button>
                </div>
            </div>
        </div>
</div>

<!-- Hotel Details Modal -->
<div class="modal fade" id="hotelModal" tabindex="-1" aria-labelledby="hotelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hotelModalLabel">Luxury Hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../assets/images/2.jpg" alt="Hotel Room">
                <p class="mt-3">Enjoy a luxurious stay at our 5-star hotel with world-class amenities, a rooftop pool, and ocean views.</p>
                <ul>
                    <li>🏨 Free Wi-Fi</li>
                    <li>🍽️ Complimentary Breakfast</li>
                    <li>🚘 Free Parking</li>
                    <li>🏊 Swimming Pool</li>
                </ul>
                <p class="fw-bold">Price: <span class="text-danger">$150 per night</span></p>
            </div>
            <div class="modal-footer">
                <a href="booking-page.html" class="btn btn-success w-100">Book Now</a>
            </div>
        </div>
    </div>
</div>












  

    
 
</body>

</html>