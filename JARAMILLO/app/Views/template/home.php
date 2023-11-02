<?php
use App\Controllers\Home\HomeController;
$resultQuery = (new HomeController)->getPros();
// print_r($resultQuery);
include_once('../app/Views/assets/css/css.php');
?>


<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<link href="../app/assets/css/style.css" rel="stylesheet" />

<?php require_once('../app/Views/template/header.php'); ?>

<main>
  <div class="container">
    <div class="container text-center">
      <div class="row m-5">

      <?php
        foreach ($resultQuery as $key => $value) :
          $nm = $value['pro_nm'];
          $dsc = $value['pro_dsc'];
          $img = $value['pro_img'];
          $code = $value['pro_code'];
          $costo = $value['pro_cost'];
      ?>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="<?= $img ?>" class="card-img-top" alt="<?= $nm ?>" title="<?= $nm ?> - <?= $img ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $nm ?>'</h5>
              <p class="card-text text-left" style="text-align: left;"><?= $dsc ?></p>
              <p class="card-text text-left" style="text-align: left;"><?= $code ?></p>
              <p class="card-text text-left" style="text-align: left;"><strong> <?= $costo ?> </strong></p>
              <a href="#" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
              </svg></a>
            </div>
          </div>
        </div>
      <?php
        endforeach;
      ?>
       
       
      </div>
    </div>
  </div>
    <div class="bottom-0 end-0 w-100" style="background: #e2e6e9; text-align: center;">
          <a href="#">www.miempresa.com</a>
    </div>
  <?php
    include('../app/Views/assets/js/js.php');
  ?>
</main>
</body>

</html>