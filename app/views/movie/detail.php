<?php require_once 'app/views/templates/header.php'; ?>
<?php require_once 'app/views/templates/flash.php'; ?>

<?php
  $movie = $movie ?? null;
  $average = $average ?? null;
  $count = $count ?? 0;
  $imdbRaw = $movie['imdbRating'] ?? null;
  $imdbNum = is_numeric($imdbRaw) ? (float)$imdbRaw : null;
  $imdbOutOfFive = $imdbNum !== null ? round($imdbNum / 2, 2) : null;
?>

<div class="container py-4">
  <?php if (!$movie): ?>
    <div class="alert alert-warning">
      Movie details not found.
    </div>
  <?php else: ?>
    <h1 class="mb-4"><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h1>

    <!-- Ratings Display -->
    <div class="mb-4 text-center">
      <?php if ($imdbOutOfFive !== null): ?>
        <div class="mb-2">
          <small class="text-muted">
            Avg IMDb Ratings: <?= $imdbOutOfFive ?>/5
          </small><br>
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="fs-4 <?= $i <= round($imdbOutOfFive) ? 'text-warning' : 'text-muted' ?>">
              &#9733;
            </span>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
  
      <div>
        <?php if ($count > 0): ?>
          <small class="text-muted">
            Avg myMovieApp User Ratings: <?= $average ?>/5 (out of <?= $count ?> vote<?= $count > 1 ? 's' : '' ?>)
          </small><br>
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="fs-4 <?= $i <= round($average) ? 'text-primary' : 'text-muted' ?>">
              &#9733;
            </span>
          <?php endfor; ?>
        <?php else: ?>
          <small class="text-muted">No myMovieApp user ratings yet.</small>
        <?php endif; ?>
      </div>
    </div> <!-- Ratings Display ends here-->

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
            <ul class="list-unstyled mb-3">
              <li><strong>Director:</strong> <?= $movie['Director'] ?></li>
              <li><strong>Actors:</strong>   <?= $movie['Actors'] ?></li>
              <li><strong>Genre:</strong>    <?= $movie['Genre'] ?></li>
              <li><strong>Runtime:</strong>  <?= $movie['Runtime'] ?></li>
              <li><strong>IMDB Rating:</strong> <?= $movie['imdbRating'] ?></li>
            </ul>
            <button
              type="button"
              class="btn btn-primary mb-4"
              onclick="history.back()"
            >
              &larr; Back to Results
            </button>

            <!-- Rating Form -->
            <h5 class="mb-3">Rate this Movie</h5>
            <form action="/movie/rate" method="post" class="row g-2 align-items-end">
              <input type="hidden" name="movie" value="<?= $movie['Title'] ?>">
              <div class="col-auto">
                <label for="rating" class="form-label visually-hidden">Rating</label>
                <input
                  type="number"
                  id="rating"
                  name="rating"
                  class="form-control"
                  placeholder="1–5"
                  min="1"
                  max="5"
                  step="1"
                  required
                  style="width: 120px;"
                >
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
