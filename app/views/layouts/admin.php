<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

    <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Dashboard</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Something</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Something</a>
        </li>
      </ul>
      <?php if($_SESSION['admin'] === 1) : ?>
        <span class="ml-auto mb-2 mb-lg-0">Welcome
          <a href="/profile">{User}</a>
        </span>
        <img style="width: 50px; height: 50px; border-radius: 50%;"
        src="https://png.pngtree.com/png-vector/20191116/ourlarge/pngtree-businessman-officer-icon-avatar-vector-download-png-image_1991051.jpg" alt="">
       
      <?php else :?>
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Register</a>
        </li>
      </ul>
      <?php endif ?>
    </div>
  </div>
</nav>

<div class="container">
    <!-- CONTENT HERE -->
    {{content}}
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>