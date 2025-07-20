<?php require_once 'app/views/templates/header.php';
  $query = $query ?? '';
  $movie = $movie ?? null;
?>

<div class="container py-4">
  <h1 class="mb-4">Search for a Movie</h1>
  <form action="/movie/search" method="get" class="mb-5">
    <div class="input-group">
      <input
        type="text"
        name="movie"
        class="form-control"
        placeholder="Enter movie title…"
        required
        value="<?= $query ?>"
      >
      <button class="btn btn-primary">Search</button>
    </div>
  </form>

  <?php if ($movie): ?>
    <div class="card mb-4" style="max-width: 800px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img
            src="<?= $movie['Poster'] ?>"
            class="img-fluid rounded-start"
            alt="Poster for <?= $movie['Title'] ?>"
          >
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">
              <?= $movie['Title'] ?> (<?= $movie['Year'] ?>)
            </h5>
            <p class="card-text"><?= $movie['Plot'] ?></p>
            <p class="card-text">
              <small class="text-muted">
                Director: <?= $movie['Director'] ?><br>
                Actors:   <?= $movie['Actors'] ?><br>
                Genre:    <?= $movie['Genre'] ?>
              </small>
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php elseif ($query !== ''): ?>
    <div class="alert alert-warning">
      No movie found matching “<?= $query ?>”.
    </div>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
