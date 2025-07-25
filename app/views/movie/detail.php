<?php require_once 'app/views/templates/header.php'; ?>
<?php require_once 'app/views/templates/flash.php'; ?>

<?php
  $movie = $movie ?? null;
  $average = $average ?? null;
  $aiReview = $aiReview ?? "";
  $count = $count ?? 0;
  $reviews = $reviews ?? [];
  $imdbOutOfFive = $imdbOutOfFive ?? null;
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
        <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center p-3">
          <?php if (!empty($movie['Poster']) && $movie['Poster'] !== 'N/A'): ?>
            <img
              src="<?= $movie['Poster'] ?>"
              class="img-fluid rounded"
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
              <li><strong>IMDB Rating:</strong> <?= $movie['imdbRating'] ?>/10</li>
            </ul>
            <a href="/movie" class="btn btn-primary mb-4">
              &larr; Back
            </a>

            <!-- Rating Form -->
            <h5 class="mb-3">Rate this Movie</h5>
            <form action="/movie/rate" method="post" class="row g-2 align-items-end mb-3">
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

            <!-- AI Review Section -->
            <?php if (!$generated): ?> <!-- i.e if user hasn’t generated yet -->
              <a
                href="/movie/detail?movie=<?= urlencode($movie['Title']) ?>&genAI=1"
                class="btn btn-outline-info"
              >Generate AI‑Review</a>
            <?php else: ?> <!-- i.e we have $aiReview -->
              <div class="card mb-4 p-3 bg-light">
                <h5 class="mb-2">AI‑Generated Review</h5>
                <p><?= $aiReview ?></p>
                <a
                  href="/movie/detail?movie=<?= urlencode($movie['Title']) ?>"
                  class="btn btn-sm btn-outline-secondary"
                >Reset Review</a>
              </div>
            <?php endif; ?> <!-- AI Review Section ends -->

          </div>
        </div>
      </div>
    </div>
  
    <!-- User reviews list -->
    <h5 class="mt-4">User Reviews</h5>
    <?php if (count($reviews) === 0): ?>
      <p class="text-muted">No user reviews yet.</p>
    <?php else: ?>
      <ul class="list-group mb-5">
        <?php foreach ($reviews as $rev): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong><?= htmlspecialchars($rev['reviewer']) ?></strong>
              <small class="text-muted"> at 
                <?= date('Y‑m‑d H:i', strtotime($rev['created_at'])) ?>
              </small>
            </div>
            <span class="badge bg-primary rounded-pill">
              <?= (int)$rev['rating'] ?>/5
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
