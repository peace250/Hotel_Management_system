<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Property Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:#f2f2f2">
  <!-- container  -->
  <div class="container-fluid">
    <!-- row -->
    <div class="row">
      <!-- nav-part -->
      <div class="col-sm-2">
        <?php require('../navbar/nav.php') ?>
      </div>
      <!-- display right -->
      <div class="col-sm-10 ms-auto ">
        <div class="row">
          <?php require('../navbar/main_nav.php') ?>
        </div>
        <div class="row mt-5 ">
          <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: 25%">25%</div>
          </div>
          <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
          </div>
          <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-warning text-dark" style="width: 75%">75%</div>
          </div>
          <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-danger" style="width: 100%">100%</div>
          </div>
        </div>
        <!-- row end -->
      </div>
</body>

</html>