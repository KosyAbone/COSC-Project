<?php
  $isAuth = !empty($_SESSION['auth']);
  $username = $_SESSION['username'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>myMovieApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    >
    <link rel="icon" href="/favicon.png">
  </head>
      <body class="d-flex flex-column min-vh-100">
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center" href="/home">
            <img src="/app/assets/logo.png" height="70" class="me-2" alt="myMovieApp">
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link <?= ($_SERVER['REQUEST_URI']==='/home')?'active':'' ?>"
                   href="/home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'],'/about')===0)?'active':'' ?>"
                   href="/about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'],'/movie')===0)?'active':'' ?>"
                   href="/movie">Movie Search</a>
              </li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <span class="nav-link disabled"><?= $username ?></span>
              </li>
              <li class="nav-item">
                <?php if ($isAuth): ?>
                  <a class="nav-link" href="/logout">Logout</a>
                <?php else: ?>
                  <a class="nav-link" href="/login">Sign In</a>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <main class="flex-grow-1">
