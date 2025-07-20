<?php require_once 'app/views/templates/header.php'; ?>

<?php
  $movie = $movie ?? null;
?>

<div class="container py-4">
  <?php if (!$movie): ?>
    <div class="alert alert-warning">
      Movie details not found.
    </div>
  <?php else: ?>
    <h1 class="mb-4"><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h1>

    <div class="card mb-4 mx-auto" style="max-width: 800px;">
      <div class="row g-0">
        <div class="col-md-4">
          <?php if (!empty($movie['Poster']) && $movie['Poster'] !== 'N/A'): ?>
            <img
              src="<?= $movie['Poster'] ?>"
              class="img-fluid rounded-start"
              alt="Poster for <?= $movie['Title'] ?>"
            >
          <?php else: ?>
            <div class="bg-secondary" style="width:100%; padding-top:150%;"></div>
          <?php endif; ?>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <p class="card-text"><?= $movie['Plot'] ?></p>
            <ul class="list-unstyled">
              <li><strong>Director:</strong> <?= $movie['Director'] ?></li>
              <li><strong>Actors:</strong>   <?= $movie['Actors'] ?></li>
              <li><strong>Genre:</strong>    <?= $movie['Genre'] ?></li>
              <li><strong>Runtime:</strong>  <?= $movie['Runtime'] ?></li>
              <li><strong>IMDB Rating:</strong> <?= $movie['imdbRating'] ?></li>
            </ul>
            <a href="/movie?movie=<?= urlencode($movie['Title']) ?>" class="btn btn-secondary mt-3">
              <-- Back to Results
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
