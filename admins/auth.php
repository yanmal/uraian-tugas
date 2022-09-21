<?php
session_start();

// echo password_hash("admin123", PASSWORD_DEFAULT);

if (isset($_SESSION['auth'])) {
  header('Location: index.php');
  exit;
}

require_once('config.php');

if (isset($_POST['login'])) :
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  $result = mysqli_query($link, "SELECT * FROM tbl_user_admin WHERE username = '{$username}'");

    // cek username 
  if (mysqli_num_rows($result) === 1) :
    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) :
      // set session
      $_SESSION['auth'] = true;
      $_SESSION['username'] = $row['username'];
      // $_SESSION['level'] = $row['level'];
      // $_SESSION['fullname'] = $row['fullname'];
      // $_SESSION['img'] = $row['img'];
      $_SESSION['user_id'] = $row['id'];
      header('Location: index.php');
      exit;
    endif;
  endif;

  $error = true;

endif;

?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <title>Uraian Tugas</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/font-awesome.css">
</head>

<body class="login-page">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <div class="card shadow mt-4">
          <div class="card-header">
            <div class="text-center">
              <h4 class="display-6 text-uppercase">Login Form</h4>
            </div>
          </div>
          <div class="card-body">
            <?php
            if (isset($error)) :
              ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <!-- <span class="alert-inner--icon"><i class="ni ni-support-16"></i></span> -->
                <span class="alert-inner--text"><strong>ERROR!</strong> Username/password salah!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php
            endif;
            ?>
            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" role="form">
              <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                  </div>
                  <input class="form-control" name="username" placeholder="Username" type="text" required="">
                </div>
              </div>
              <div class="form-group focused">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <!-- <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span> -->
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                  <input class="form-control" name="password" placeholder="Password" type="password" required="">
                </div>
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                <label class="custom-control-label" for=" customCheckLogin"><span>Remember me</span></label>
              </div>
              <div class="text-center">
                <button type="submit" name="login" class="btn btn-primary btn-block my-4">Sign in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>

</html>