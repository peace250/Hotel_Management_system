<?php require('../db/conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  
<div class="container-fluid h-100">
    <div class="row border border-danger gap-5 ">
    <div class="col-sm-2  border border-primary">
        <?php require('../navbar/nav.php') ?>
    </div>
    <div class="col-sm-9 border border-success ms-auto">
        <div class="header">
            <?php require('../navbar/main_nav.php')?>
        </div>
<div class="table">

</div>
    </div>
    </div>

  
</div>    
</body>
</html>