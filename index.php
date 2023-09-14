<?php

require_once("config.php");

if (isset($_POST['login'])) {
  
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  print_r($password);
  $sql = "SELECT * FROM login WHERE user=:username";
  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
    ":username" => $username,
  );

  $stmt->execute($params);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // jika user terdaftar
  if ($user) {
    // verifikasi password
    if ($password == $user["password"]) {
      // buat Session
      session_start();
      $_SESSION["user"] = $user;
      // login sukses, alihkan ke halaman timeline
      header("Location: dashboard/index.php");
    } else {
      $_SESSION["error"] = "akun salah";
    }
  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>LOGIN</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="sign-in.css" rel="stylesheet">
</head>

<body class="text-center">
  <main class="form-signin w-100 m-auto">
    <form action="" method="POST">
      <h1 class="h3 mb-3 fw-normal">LOGIN</h1>
      <?php
      if (isset($_SESSION["error"])) {
      ?>
        <div class="form-floating">
          <?php echo $_SESSION["error"] ?>
        </div>
      <?php
      }
      ?>
      <div class="form mb-5">
        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username">
      </div>
      <div class="form mb-5">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      </div>
      <button class="w-50 btn btn-lg btn-primary rounded-pill" type="submit" name="login">LOGIN</button>
    </form>
  </main>
</body>
</html>