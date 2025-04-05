<?php require('../db/conn.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./css/style.css">

</head>

<body class="" style="background-color: #f2f2f2;">

    <?php require('../navbar/nav.php') ?>

    <div class="container-fluid">
        <!-- Carousel -->
        <div class="row">
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
                        <div class="carousel-item ">
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
    <h1 class="p-3 fw-bold text-center" style="color:#031c3f">Hotel_services</h1>
    <hr>
    <div class="row d-flex flex-row p-5 ">';
    
    <?php
    // Query to fetch from the properties table 
    $sql =  "SELECT * FROM hotel_rooms";
    $select_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($select_query) > 0) {
        while ($fetch = mysqli_fetch_assoc($select_query)){
            echo '<div class="col-md-4 mb-4">';
            echo ' <div class="card hotel-card" >';
            echo ' <div class="position-relative">';
            echo '        <img src="../' . htmlspecialchars($fetch['image']) . '" alt="Property Image" class="card-img-top" alt="Hotel Image">';
            echo '<div class="price-tag">$ ' . $fetch['price'] . ' /night</div>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$fetch['name'].'</h5>';
            echo '<p class="card-text"><i class="bi bi-geo-alt"></i> New York, USA</p>';
            echo '<p class="card-text text-warning">⭐⭐⭐⭐☆ (4.5/5)</p>';
           
            echo ' <button class="viewmore btn btn-primary w-100"
            data-bs-toggle="modal" 
            data-bs-target="#hotelroomModal"
            data-id ="'.intval($fetch['id']).'"
            data-title =" '.htmlspecialchars($fetch['name']).'"
            data-image ="../'.$fetch['image'].'"
            data-description =" '.htmlspecialchars($fetch['description']).'"
            data-price ="'.$fetch['price'].'"
           >
            View More';
            echo '</button>';            
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
<!-- details model -->
<div class="modal fade" id="hotelroomModal" tabindex="-1" aria-labelledby="hotelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="../" alt="Hotel Room">
                    <p class="mt-3" id="modalDescription"></p>
                    <ul>
                        <li>🏨 Free Wi-Fi</li>
                        <li>🍽️ Complimentary Breakfast</li>
                        <li>🚘 Free Parking</li>
                        <li>🏊 Swimming Pool</li>
                    </ul>
                    <p class="fw-bold">Price:<span class="text-danger" id="modalPrice"> per night</span></p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="bookNow">
                    Book Now
                </button>
 

                </div>
            </div>
        </div>
    </div>



</div>

<!-- Air bnb properties -->
 <div class="row text-center">
<h1 style="text-transform: capitalize;">airbnb_properties</h1>
<hr>
 <?php


// Query to fetch from the properties table 
$sql =  "SELECT * FROM airbnb_properties";
$select_query = mysqli_query($conn, $sql);

if (mysqli_num_rows($select_query) > 0) {
    while ($fetch = mysqli_fetch_assoc($select_query)) {
        $photos = json_decode($fetch['photos'], true); 
        
        // Get the first image for display
        $first_image = !empty($photos)? htmlspecialchars($photos[0], ENT_QUOTES) : '2.jpg'; 
        // Display the property image and "View Gallery" button
        echo '<div class="col-md-4 mb-4 ">';
        echo ' <div class="card hotel-card">';
        echo '    <div class="position-relative">';
        echo '        <img src="../'.$first_image.'" alt="Property Image" class="card-img-top" alt="Airbnb Image">';
        echo '        <div class="price-tag">$ ' . $fetch['price_per_night'] . ' /night</div>';
        echo '    </div>';
        echo '    <div class="card-body">';
        echo '        <h5 class="card-title">' . htmlspecialchars($fetch['name']) . '</h5>';
        echo '        <p class="card-text"><i class="bi bi-geo-alt"></i> ' . htmlspecialchars($fetch['address']) . '</p>';
        echo '        <p class="card-text text-warning">⭐⭐⭐⭐☆ (4.5/5)</p>';
        echo '        <button class="view-gallery btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#galleryModal" data-property-id="' . $fetch['id'] . '" data-photos="' . htmlspecialchars(json_encode($photos), ENT_QUOTES) . '">View Gallery</button>';
        echo '    </div>';
        echo '</div>';
        echo '</div>';
    }
}
?>

 </div>


<!-- modal -->
<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Property Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Image Gallery will be dynamically inserted here -->
                <div class="row" id="galleryImages"></div>
            </div>
        </div>
    </div>
</div>






   
            
    


<h1 class="p-2 text-center" style="color:#031c3f">Reviews</h1>
<hr>
<div class="row p-3">

<div class="col-md-6 d-flex flex-column justify-content-center align-items-center ">


    <div id="reviews-container">
            <!-- Existing reviews will be shown here -->
            <div class="review-card d-flex flex-column justify-content-center align-items-center bg-white p-3">
            <img src="" alt="" class="card-img " alt = "img"  style="border-radius: 50%; object-fit:cover">    
            <h5>Mufasa</h5>
                <p class="star-rating">⭐⭐⭐⭐⭐</p>
                <p>"Amazing experience! The hotel service was top-notch."</p>
            </div>
        </div>
</div>

     <!-- Add Review Form -->
      <div class="col-md-6  p-5">
      <h2 class="mt-4 text-capitalize text-center" style="color:#031c3f">Leave a Review</h2>
      <hr>
    <form id="review-form" class="d-flex flex-column" >
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select id="rating" class="form-select" required>
                <option value="⭐">1 Star</option>
                <option value="⭐⭐">2 Stars</option>
                <option value="⭐⭐⭐">3 Stars</option>
                <option value="⭐⭐⭐⭐">4 Stars</option>
                <option value="⭐⭐⭐⭐⭐" selected>5 Stars</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Your Review</label>
            <textarea id="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn bg-warning fw-bold" style="align-self: center;">Submit Review</button>
    </form>

      </div>
    
</div>
















<!-- footer -->

<div class="row mt-5">

<footer class="footer bg-white p-3" style=" box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);">
    <h1 class="text-center fw-bold" style="color:#031c3f">Want To Reach Us?</h1>
    <div class="links d-flex justify-content-around p-5 border-bottom border-dar">
        <div class="group1 ">
            <ul class="list-unstyled">
                <li> <a href="" class=" " style="color:#031c3f">About</a></li>
                <li> <a href="" class=" " style="color:#031c3f">book</a></li>
                <li> <a href="" class=" " style="color:#031c3f">About</a></li>
            </ul>
        </div>
        <div class="group2">
            <ul class="list-unstyled">
                <li> <a href="" class="" style="color:#031c3f">About</a></li>
                <li> <a href="" class="" style="color:#031c3f">book</a></li>
                <li> <a href="" class="" style="color:#031c3f">About</a></li>
            </ul>
        </div>
        <div class="group3">
            <ul class="list-unstyled">
                <li> <a href="" class="" style="color:#031c3f">About</a></li>
                <li> <a href="" class="" style="color:#031c3f">book</a></li>
                <li> <a href="" class="" style="color:#031c3f">About</a></li>
            </ul>
        </div>
        <div class="group4">
            <ul class="list-unstyled">
                <li> <a href="" class="" style="color:#031c3f" >About</a></li>
                <li> <a href="" class="" style="color:#031c3f" >book</a></li>
                <li> <a href="" class="" style="color:#031c3f" >About</a></li>
            </ul>
        </div>
    </div>

<div class="social_medias p-2 d-flex gap-5 justify-content-between ">
<div class="facebook d-flex gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
        <path d="M11.300781 2C6.1645496 2 2 6.1645496 2 11.300781L2 38.800781C2 43.937013 6.1645496 48.099609 11.300781 48.099609L38.800781 48.099609C43.937013 48.099609 48.099609 43.937013 48.099609 38.800781L48.099609 11.289062L48.099609 11.277344C47.988214 6.1531405 43.848929 2 38.800781 2L11.300781 2 z M 11.300781 4L38.800781 4C42.752633 4 46.011005 7.2464683 46.099609 11.322266L46.099609 38.800781C46.099609 42.864549 42.864549 46.099609 38.800781 46.099609L33 46.099609L33 29L37.847656 29L39.179688 21L33 21L33 19C33 18.45 33.05476 18.405705 33.251953 18.279297C33.44915 18.152889 34.029365 18 35 18L39 18L39 11.271484L38.306641 11.048828C38.306641 11.048828 35.129885 10 32 10C29.096296 10 26.957792 10.953443 25.679688 12.632812C24.401582 14.312183 24 16.536525 24 19L24 21L21 21L21 29L24 29L24 46.099609L11.300781 46.099609C7.2370133 46.099609 4 42.864549 4 38.800781L4 11.300781C4 7.2370133 7.2370133 4 11.300781 4 z M 32 12C34.168683 12 36.174546 12.537635 37 12.773438L37 16L35 16C33.870635 16 32.949678 16.09711 32.171875 16.595703C31.394072 17.094295 31 18.05 31 19L31 23L36.820312 23L36.152344 27L31 27L31 46.099609L26 46.099609L26 27L23 27L23 23L26 23L26 19C26 16.763475 26.399589 14.98938 27.271484 13.84375C28.14338 12.69812 29.503704 12 32 12 z" />
    </svg>
    <span class="fw-bold">Ituze_Hotel</span>
</div>
<div class="whatsapp d-flex gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32">
        <path d="M24.503,7.503C22.247,5.245,19.247,4.001,16.05,4C9.464,4,4.103,9.359,4.1,15.945c-0.001,2.105,0.549,4.161,1.595,5.972L4,28.108l6.335-1.661c1.745,0.952,3.711,1.453,5.711,1.454h0.005c0,0,0,0,0,0c6.586,0,11.947-5.359,11.95-11.946C28.001,12.763,26.759,9.761,24.503,7.503z M16.05,25.883h-0.004c-1.782-0.001-3.53-0.479-5.055-1.384l-0.363-0.215L6.869,25.27l1.003-3.664L7.636,21.23c-0.994-1.581-1.519-3.408-1.519-5.284c0.002-5.475,4.458-9.928,9.936-9.928c2.653,0.001,5.147,1.035,7.022,2.912s2.907,4.371,2.906,7.024C25.98,21.429,21.525,25.883,16.05,25.883z M21.498,18.447c-0.299-0.149-1.767-0.872-2.04-0.971c-0.274-0.1-0.473-0.149-0.672,0.149c-0.199,0.299-0.771,0.971-0.945,1.17c-0.174,0.199-0.348,0.224-0.647,0.075c-0.299-0.149-1.261-0.465-2.401-1.482c-0.888-0.791-1.487-1.769-1.661-2.068c-0.174-0.299-0.019-0.46,0.131-0.609c0.134-0.134,0.299-0.349,0.448-0.523s0.199-0.299,0.299-0.498s0.05-0.374-0.025-0.523s-0.672-1.619-0.921-2.216c-0.242-0.582-0.489-0.503-0.672-0.512c-0.174-0.009-0.373-0.01-0.572-0.01c-0.199,0-0.523,0.075-0.796,0.374s-1.045,1.021-1.045,2.49s1.07,2.889,1.219,3.088s2.105,3.214,5.101,4.507c0.712,0.307,1.269,0.491,1.702,0.629c0.715,0.227,1.366,0.195,1.881,0.118c0.574-0.086,1.767-0.722,2.015-1.419c0.249-0.697,0.249-1.295,0.174-1.419C21.996,18.671,21.797,18.596,21.498,18.447z" />
    </svg>
    <span class="fw-bold">0788291399</span>
</div>
<div class="d-flex gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
        <path d="M16 3C8.8545455 3 3 8.8545455 3 16L3 34C3 41.145455 8.8545455 47 16 47L34 47C41.145455 47 47 41.145455 47 34L47 16C47 8.8545455 41.145455 3 34 3L16 3 z M 16 5L34 5C40.054545 5 45 9.9454545 45 16L45 34C45 40.054545 40.054545 45 34 45L16 45C9.9454545 45 5 40.054545 5 34L5 16C5 9.9454545 9.9454545 5 16 5 z M 37 11C35.9 11 35 11.9 35 13C35 14.1 35.9 15 37 15C38.1 15 39 14.1 39 13C39 11.9 38.1 11 37 11 z M 25 14C18.954545 14 14 18.954545 14 25C14 31.045455 18.954545 36 25 36C31.045455 36 36 31.045455 36 25C36 18.954545 31.045455 14 25 14 z M 25 16C29.954545 16 34 20.045455 34 25C34 29.954545 29.954545 34 25 34C20.045455 34 16 29.954545 16 25C16 20.045455 20.045455 16 25 16 z" />
    </svg>
    <span class="fw-bold">Ituze_Hotel</span>
</div>
<div class="d-flex gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 50 50">
        <path d="M34.232422 5.4785156C28.252103 5.4785156 23.384766 10.345701 23.384766 16.324219C23.384766 16.68687 23.470936 17.028109 23.505859 17.382812C16.110717 16.677787 9.5604018 13.095779 5.1171875 7.6464844 A 1.0001 1.0001 0 0 0 3.4785156 7.7753906C2.5447093 9.3809209 2.0097656 11.24956 2.0097656 13.232422C2.0097656 15.647583 2.8615936 17.838758 4.2011719 19.646484C3.9417778 19.533054 3.6620856 19.459012 3.4160156 19.322266 A 1.0001 1.0001 0 0 0 1.9296875 20.195312L1.9296875 20.320312C1.9296875 24.01419 3.8406066 27.213073 6.6679688 29.173828C6.6347987 29.167828 6.5995089 29.170462 6.5664062 29.164062 A 1.0001 1.0001 0 0 0 5.4257812 30.451172C6.5458558 33.934363 9.4139466 36.561793 12.962891 37.521484C10.145739 39.201735 6.8769003 40.199219 3.3496094 40.199219C2.5894141 40.199219 1.8471959 40.156169 1.1210938 40.068359 A 1.0001 1.0001 0 0 0 0.4609375 41.904297C4.9713616 44.798382 10.339295 46.486328 16.095703 46.486328C25.428862 46.486328 32.738569 42.590881 37.650391 37.019531C42.562213 31.448181 45.117188 24.229079 45.117188 17.470703C45.117188 17.188515 45.107689 16.913552 45.099609 16.636719C46.929838 15.237225 48.551516 13.569719 49.832031 11.652344 A 1.0001 1.0001 0 0 0 48.59375 10.181641C48.079505 10.409677 47.483562 10.451359 46.947266 10.632812C47.653284 9.6863255 48.25897 8.6539153 48.626953 7.5039062 A 1.0001 1.0001 0 0 0 47.164062 6.3398438C45.46149 7.3481462 43.575221 8.0704949 41.583984 8.5039062C39.643165 6.6818705 37.096659 5.4785156 34.232422 5.4785156 z M 34.232422 7.4785156C36.783348 7.4785156 39.076941 8.5502736 40.689453 10.271484 A 1.0001 1.0001 0 0 0 41.611328 10.568359C42.912602 10.3124 44.158122 9.911945 45.361328 9.4257812C44.66576 10.362433 43.833106 11.188521 42.828125 11.791016 A 1.0001 1.0001 0 0 0 43.462891 13.640625C44.461582 13.519921 45.350787 13.115956 46.300781 12.861328C45.446097 13.787272 44.524151 14.647834 43.503906 15.384766 A 1.0001 1.0001 0 0 0 43.089844 16.238281C43.107344 16.645629 43.117188 17.058797 43.117188 17.470703C43.117188 23.721328 40.721069 30.510914 36.150391 35.695312C31.579713 40.879712 24.876545 44.486328 16.095703 44.486328C12.112163 44.486328 8.3413361 43.613676 4.9414062 42.064453C9.160905 41.741698 13.05404 40.236651 16.195312 37.773438 A 1.0001 1.0001 0 0 0 15.597656 35.986328C12.304976 35.925958 9.5437495 34.01601 8.0683594 31.308594C8.1250054 31.309492 8.1774731 31.324219 8.234375 31.324219C9.2207195 31.324219 10.180311 31.192507 11.091797 30.941406 A 1.0001 1.0001 0 0 0 11.023438 28.998047C7.4662396 28.279806 4.8085278 25.389779 4.1894531 21.789062C5.1955134 22.137743 6.2440683 22.392536 7.359375 22.427734 A 1.0001 1.0001 0 0 0 7.9453125 20.597656C5.5687292 19.009074 4.0097656 16.309819 4.0097656 13.232422C4.0097656 12.087145 4.289476 11.028124 4.6835938 10.025391C9.6826092 15.519152 16.678576 19.170089 24.589844 19.568359 A 1.0001 1.0001 0 0 0 25.615234 18.341797C25.463749 17.694624 25.384766 17.019127 25.384766 16.324219C25.384766 11.426736 29.332741 7.4785156 34.232422 7.4785156 z" />
    </svg>
    <span class="fw-bold">Ituze_Hotel</span>
</div>

</div>
<hr>
    <h5 class="text-center mt-3">Peace_Muhayimana_All rights reserved&copy; 2025</h5>
</footer>
</div>

<script src="./js/script.js"></script>
</body>

</html>