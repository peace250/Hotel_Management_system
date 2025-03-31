<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <?php require('../navbar/nav.php') ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9 mt-5 d-flex align-items-center ">
                <h2 style="color: #031c3f;" class="fw-bold">Book and Pay In one snap!</h2>
                <span class="" style="width: fit-content;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30" height="30">
                        <path fill="#e5852e" d="M11.336,26.833L24.177,14.59l16.885,17.057L29.426,43.283c-2.297,2.297-6.056,2.258-8.397-0.083 l-9.161-8.181C9.524,32.674,9.485,28.916,11.336,26.833z" />
                        <path fill="#e5852e" d="M23.384,19.626c1.172,1.172,3.071,1.172,4.243,0l9.485-9.485c1.172-1.172,1.172-3.071,0-4.243l0,0 c-1.172-1.172-3.071-1.172-4.243,0l-9.485,9.485C22.212,16.555,22.212,18.455,23.384,19.626L23.384,19.626z" />
                        <path fill="#e5852e" d="M26.088,25.386c1.172,1.172,3.071,1.172,4.243,0l4.243-4.243c1.172-1.172,1.172-3.07,0-4.243l0,0 c-1.171-1.171-3.071-1.172-4.243,0l-4.243,4.243C24.917,22.315,24.917,24.214,26.088,25.386L26.088,25.386z" />
                        <path fill="#e5852e" d="M29.603,30.346c1.172,1.172,3.071,1.172,4.243,0l4.243-4.243c1.172-1.172,1.172-3.07,0-4.243l0,0 c-1.171-1.171-3.071-1.172-4.243,0l-4.243,4.244C28.431,27.275,28.431,29.175,29.603,30.346L29.603,30.346z M32.607,35.858 c1.172,1.172,3.07,1.172,4.243,0l4.243-4.243c1.172-1.172,1.172-3.07,0-4.243l0,0c-1.171-1.171-3.071-1.172-4.243,0l-4.243,4.243 C31.436,32.787,31.436,34.686,32.607,35.858L32.607,35.858z M10.022,22.334c-0.074-1.383-0.531-2.779-1.252-3.973l-1.577-2.602 c-0.311-0.508-0.235-1.152,0.176-1.563l0.477-0.477c1.26-1.26,3.513-0.684,4.428,0.231l0.984,0.984c2,2,3.647,4.287,4.425,6.99 l1.958,5.01l-9.616,3.739L10.022,22.334z" />
                        <path fill="#c16e14" d="M30.455,16.798l-2.828,2.828c-0.39,0.39-0.391,1.023,0,1.414s1.024,0.39,1.414,0L30.455,16.798z M33.99,21.748l-2.828,2.828c-0.39,0.39-0.391,1.023,0,1.414s1.024,0.39,1.414,0L33.99,21.748z M36.85,27.364l-2.828,2.828 c-0.39,0.39-0.391,1.023,0,1.414c0.391,0.391,1.024,0.39,1.414,0L36.85,27.364z" />
                        <path fill="#0288d1" d="M19.003,10c-0.552,0-1-0.448-1-1V3c0-0.552,0.448-1,1-1s1,0.448,1,1v6 C20.003,9.552,19.555,10,19.003,10z M24.003,11c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l4-4 c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-4,4C24.515,10.902,24.259,11,24.003,11z M14.003,11 c-0.256,0-0.512-0.098-0.707-0.293l-4-4c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0l4,4 c0.391,0.391,0.391,1.023,0,1.414C14.515,10.902,14.259,11,14.003,11z" />
                    </svg>
                </span>
            </div>
            <div class="col-md-3 mt-5"><h3 style="color:#031c3f">Hello $user</h3></div>
        </div>

        <div class="row ">
            <div class="col-md-6 me-auto mt-5">
                <div class="card mt-5">
                    <img src="../assets/images/5.jpg" class="card-img-top" alt="Hotel Image">
                    <div class="card-body">
                        <h5 class="card-title">Master BedRoom</h5>

                        <div>
                            <p class="card-text"><span class="fw-bold">Price: </span>$200 per night</p>
                        </div>

                        <div>
                            <label for="amenities">Amenities:</label>
                            <ul>
                                <li>🏨 Free Wi-Fi</li>
                                <li>🍽️ Complimentary Breakfast</li>
                                <li>🚘 Free Parking</li>
                                <li>🏊 Swimming Pool</li>
                            </ul>
                        </div>
                        <div class="div">
                            <label for="checkin" class="fw-bold">Check-in Date:</label>
                            <input type="text" id="checkin" name="checkin" class="date-picker form-control mb-2" placeholder="Select check-in date">
                        </div>

                        <div>
                            <label for="checkout" class="fw-bold">Check-out Date:</label>
                            <input type="text" id="checkout" name="checkout" class="date-picker form-control mb-3" placeholder="Select check-out date">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn border border-success"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30" height="30">
                                    <path fill="#4caf50" d="M44,24c0,11-9,20-20,20S4,35,4,24S13,4,24,4S44,13,44,24z" />
                                </svg><a href="" class="fw-bold" style="color: #031c3f;">Book Now</a> </button>
                            <button class="btn   border border-danger "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30" height="30">
                                    <path fill="#f44336" d="M44,24c0,11-9,20-20,20S4,35,4,24S13,4,24,4S44,13,44,24z" />
                                    <line x1="16.9" x2="31.1" y1="16.9" y2="31.1" fill="none" stroke="#fff" stroke-width="4" />
                                    <line x1="31.1" x2="16.9" y1="16.9" y2="31.1" fill="none" stroke="#fff" stroke-width="4" />
                                </svg> <a class="fw-bold" style="color: #031c3f;">Cancel Booking</a></button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Payment method: -->
            <div class="col-md-6 mt-5">


                <div class="card p-4 shadow mt-5">
                    <h3 class="text-center mb-4">Hotel Booking Payment</h3>

                    <form class="d-flex flex-column">
                        <label class="form-label">Select Payment Method:</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="card">Credit/Debit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="mobile">Mobile Money</option>
                        </select>
                        <!-- card payments -->
                        <div id="cardPayment" class="mt-3">
                            <label class="form-label">Card Number:</label>
                            <input type="text" class="form-control" placeholder="1234 5678 9101 1121">
                            <label class="form-label mt-2">Expiry Date:</label>
                            <input type="month" class="form-control">
                            <label class="form-label mt-2">CVV:</label>
                            <input type="text" class="form-control" placeholder="123">
                        </div>
                        <!-- paypal -->
                        <div id="paypalPayment" class="mt-3" style="display:none;">
                            <p class="text-muted">You will be redirected to PayPal to complete your payment.</p>
                        </div>
                        <!-- mobile_money -->
                        <div id="mobilePayment" class="mt-3" style="display:none;">
                            <label class="form-label">Mobile Number:</label>
                            <input type="text" class="form-control" placeholder="+123 456 789">
                        </div>

                        <button type="submit" class="btn  mt-4  fw-bold" style="align-self: center; color:#031c3f; border:1px solid #031c3f">Pay Now</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

< class="">
<div class="container-fluid p-2" style="background-color: #031c3f;">
    <h2 style="color: #fff;" class="fw-bold text-center">ITUZE_</h2>

    <div class="row p-5 mt-5" >
        <div class="col-md-3">
        <ul class="list-unstyled">
                <li> <a href="" class="" >About</a></li>
                <li> <a href="" class="" >book</a></li>
                <li> <a href="" class="" >About</a></li>
            </ul>
        </div>
        <div class="col-md-3">
        <ul class="list-unstyled">
                <li> <a href="" class="" >About</a></li>
                <li> <a href="" class="" >book</a></li>
                <li> <a href="" class="" >About</a></li>
            </ul>
        </div>
        <div class="col-md-3">
        <ul class="list-unstyled">
                <li> <a href="" class=""  >About</a></li>
                <li> <a href="" class=""  >book</a></li>
                <li> <a href="" class=""  >About</a></li>
            </ul>
        </div>
        <div class="col-md-3">
        <ul class="list-unstyled">
                <li> <a href="" class=""  >About</a></li>
                <li> <a href="" class=""  >book</a></li>
                <li> <a href="" class=""  >About</a></li>
            </ul>
        </div>
      
    </div>
</div>
  
<div class="social_medias p-5 d-flex gap-5 justify-content-between border-bottom border-dark">
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
    <h5 class="text-center p-4">Peace_Muhayimana_All rights reserved&copy; 2025</h5>

</div>
</footer>











    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Initialize Flatpickr for both inputs
        flatpickr("#checkin", {
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        flatpickr("#checkout", {
            dateFormat: "Y-m-d",
            minDate: "today",
        });
    </script>
    <script>
        // js codes to deal with the payment options.
        document.getElementById('paymentMethod').addEventListener('change', function() {
            document.getElementById('cardPayment').style.display = this.value === 'card' ? 'block' : 'none';
            document.getElementById('paypalPayment').style.display = this.value === 'paypal' ? 'block' : 'none';
            document.getElementById('mobilePayment').style.display = this.value === 'mobile' ? 'block' : 'none';
        });
    </script>
</body>

</html>