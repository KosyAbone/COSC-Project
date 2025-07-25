<?php require_once 'app/views/templates/header.php'; ?>

<?php
  $user = $_SESSION['username'] ?? 'Guest';
?>

<main class="container py-5">

  <div class="p-5 mb-5 bg-white shadow-lg rounded-3 text-center mx-auto"">
    <h1 class="display-5 fw-bold">Welcome, <?= $user ?>!</h1>
    <p class="col-md-8 mx-auto mb-4 text-secondary">
      Discover, rate, and get AI‑generated reviews of your favourite movies.
    </p>
    <a href="/movie" class="btn btn-primary btn-lg">
      Search Movies
    </a>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100 text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">
            <i class="fa fa-search fa-md me-2 text-primary"></i>Search
          </h5>
          <p class="card-text">
            Look up any movie by title and view all the details you need.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">
            <i class="fa fa-star fa-md me-2 text-warning"></i>Rate
          </h5>
          <p class="card-text">
            Give each movie your personal rating ranging from 1–5.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">
            <i class="fa fa-robot fa-md me-2"></i>AI Reviews
          </h5>
          <p class="card-text">
            Get a custom, AI‑generated review based on average ratings (users or IMDb).
          </p>
        </div>
      </div>
    </div>
  </div>

</main>

<?php require_once 'app/views/templates/footer.php'; ?>
