<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="" style="background-color: #f2f2f2;">
    <!-- simple web UI for Ituze Hotel -->
    <nav class="navbar d-flex  justify-content-between  p-3 bg-white navbar-expand fixed-top">

        <a href="" class="nav-brand fw-bold text-decoration-none">ITUZE_Hotel</a>
        <ul class="nav-group d-flex gap-3 list-unstyled ">
            <li class="nav-item ">
                <a href="" class="nav-link text-decoration-none">Home</a>
            </li>
            <li class="nav-item ">
                <a href="#about" class="nav-link text-decoration-none">about</a>
            </li>
            <li class="nav-item ">
                <a href="#services" class="nav-link text-decoration-none">Services</a>
            </li>

        </ul>
        <button class="btn bg-primary ">
            <a href="../authentication/register.php" class="ms-auto text-light">Register Now</a>

        </button>
    </nav>
    <!-- slider of hero images -->
    <div class="slider d-flex justify-content-center">

        <div id="carouselExampleIndicators" class="carousel slide col-sm-10 h-50">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <img src="../assets/images/2.jpg" class="d-block w-100" alt="...">

                </div>
                <div class="carousel-item">
                    <img src="../assets/images/3.jpg" class="d-block w-100" alt="...">

                </div>
                <div class="carousel-item">
                    <img src="../assets/images/1.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>




    <div class="row mt-5" id="about">
        <h1 class="text-center">About_Us</h1>

        <div class="left_content col-sm-6 p-5 d-flex flex-column justify-content-center align-items-center">
            <h3 class="fw-bold text-center">Our History</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, laborum ab ut ipsa consequuntur velit voluptatem cumque corrupti animi consectetur.</p>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, laborum ab ut ipsa consequuntur velit voluptatem cumque corrupti animi consectetur.</p>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, laborum ab ut ipsa consequuntur velit voluptatem cumque corrupti animi consectetur.</p>
            <button class="text-primary btn border border-primary" style="align-self: center;">Read More</button>
        </div>
        <div class="right_content col-sm-6">
            <img src="../assets/images/1.jpg" alt="" style="width: 100%;">
        </div>
    </div>

<!-- Services Area -->

<div class="row ">

<h1 class="h1 text-center">Our Services!</h1>
<div class="info d-flex justify-content-center" id="services">

    <div class="hero_img1 col-sm-10" >
        <img src="../assets/images/4.jpg" alt="" style="width: 100%; height:100%;object-fit:cover">
    </div>

</div>


</div>

<!-- footer -->

    <div class="row mt-5">

        <footer class="footer bg-white p-3" style=" box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);">
            <h1 class="text-center">Want To Reach Us?</h1>
            <div class="links d-flex justify-content-around p-5">
                <div class="group1">
                    <ul class="list-unstyled">
                        <li> <a href="" class="">About</a></li>
                        <li> <a href="" class="">book</a></li>
                        <li> <a href="" class="">About</a></li>
                    </ul>
                </div>
                <div class="group2">
                    <ul class="list-unstyled">
                        <li> <a href="" class="">About</a></li>
                        <li> <a href="" class="">book</a></li>
                        <li> <a href="" class="">About</a></li>
                    </ul>
                </div>
                <div class="group3">
                    <ul class="list-unstyled">
                        <li> <a href="" class="">About</a></li>
                        <li> <a href="" class="">book</a></li>
                        <li> <a href="" class="">About</a></li>
                    </ul>
                </div>
                <div class="group4">
                    <ul class="list-unstyled">
                        <li> <a href="" class="">About</a></li>
                        <li> <a href="" class="">book</a></li>
                        <li> <a href="" class="">About</a></li>
                    </ul>
                </div>
            </div>

            <h5 class="text-center">All rights reserved&copy; 2025</h5>
        </footer>
    </div>









    <script>
        const nav = document.querySelector('.navbar');

        nav.addEventListener('scroll', () => {

            console.log("hello");

        });

        // function changeColor(){

        // if(window.scrollY>50){
        //     nav.style.background = "blue";
        //     console.log(nav);

        // }else{
        //     nav.style.background = "transparent"; 
        // }
    </script>
</body>

</html>