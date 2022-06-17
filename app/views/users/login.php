<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- ================== BEGIN core-css ================== -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="<?php echo URLROOT; ?>/public/assets/css/vendor.min.css" rel="stylesheet" />
  <link href="<?php echo URLROOT; ?>/public/assets/css/default/app.min.css" rel="stylesheet" />
  <!-- ================== END core-css ================== -->
  <!-- favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo URLROOT; ?>/public/assets/img//logo/steering.png">
  <!-- Title -->
  <title><?= SITENAME . ' | ' . $data['title'] ?></title>
</head>

<body>
  <!-- BEGIN #loader -->
  <!-- <div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div> -->
  <!-- END #loader -->

  <body class='pace-top'>

    <div id="app" class="app">

      <div class="login login-v1" 
      style="background-image: url(<?= URLROOT; ?>/public/assets/img/logo/login-bg-car.png) ;object-fit: cover; background-repeat: no-repeat; background-size: 100%;">

        <div class="login-container">

          <div class="login-header">
            <div class="brand">
              <div class="d-flex align-items-center">
                <img class="me-2" src="<?php echo URLROOT; ?>/public/assets/img/logo/steering.png" alt="">
                <b>Auto<sup>.</sup>école.</b>com
              </div>
              <div class="d-flex text-nowrap gap-3 align-items-center">
                <img class="rounded ms-2 mx-auto d-block" src="<?php echo URLROOT; ?>/public/assets/img/maroc/maroc.png" alt="MAR">
                <small>Auto-école agréée par la Préfecture - N° E.14.075.0022.0</small>
              </div>
            </div>
            <div class="icon">
              <i class="fa fa-lock"></i>
            </div>
          </div>

          <div class="login-body">

            <div class="login-content fs-13px">
              <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-floating mb-20px">
                  <input type="email" class="form-control fs-13px h-45px <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" 
                  value="<?= $data['email']; ?>" name="email" placeholder="Email Address" />
                  <label for="email" class="d-flex align-items-center py-0">Address e-mail </label>
                  <span class="text-danger"><?= $data['email_err']; ?></span>
                </div>
                <div class="form-floating mb-20px">
                  <input type="password" class="form-control fs-13px h-45px <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" 
                  value="<?= $data['password']; ?>" name="password" placeholder="Password" />
                  <label for="password" class="d-flex align-items-center py-0">Mot de passe</label>
                  <span class="text-danger"><?= $data['password_err']; ?></span>
                </div>
                <div class="form-check mb-20px">
                  <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me"  <?= (!empty($data['cookie'])) ? 'checked' : ''; ?> />
                  <label class="form-check-label" for="remember_me">
                      Se souviens de moi
                  </label>
                </div>
                <div class="login-buttons">
                  <button type="submit" class="btn h-45px btn-success d-block w-100 btn-lg">Sign me in</button>
                </div>
              </form>
            </div>

          </div>

        </div>

      </div>

    </div>


    <script src="<?php echo URLROOT; ?>/public/assets/js/vendor.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/assets/js/app.min.js"></script>
    <!-- ================== END core-js ================== -->




  </body>

</html>
<!-- ================== BEGIN core-js ================== -->