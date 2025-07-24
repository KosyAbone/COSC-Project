<?php require_once 'app/views/templates/header.php';
$query = $query ?? '';
$results = $results ?? [];
$trendingMovies = $trendingMovies ?? [];
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

  <!-- Trending/rated movies -->
  <?php if (!empty($trendingMovies)): ?>
    <h5 class="mb-3">Recommended Movies</h5>
    <div class="row g-3 mb-5">
      <?php foreach ($trendingMovies as $m): ?>
        <div class="col-6 col-sm-4 col-md-3">
          <div class="card h-100 shadow-sm">
            <?php if (!empty($m['Poster']) && $m['Poster'] !== 'N/A'): ?>
              <img
                src="<?= $m['Poster'] ?>"
                class="card-img-top"
                alt="<?= $m['Title'] ?>"
                style="object-fit:cover; height:200px;"
              >
            <?php else: ?>
              <div class="bg-secondary" style="height:200px;"></div>
            <?php endif; ?>
            <div class="card-body p-2">
              <p class="card-title mb-1" style="font-size:.9rem;"><?= $m['Title'] ?></p>
              <small class="text-muted"><?= $m['Year'] ?></small>
              <a
                href="/movie/detail?movie=<?= urlencode($m['Title']) ?>"
                class="stretched-link"
              ></a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($query !== ''): ?>
    <?php if (empty($results)): ?>
      <div class="alert alert-warning">
        No titles found for “<?= $query ?>.”
      </div>
    <?php else: ?>
      <h2 class="mb-3">Matching Results for <?= $query ?>: Click desired movie to see details...</h2>
      <ul class="list-group mb-5">
      <?php foreach ($results as $item): ?>
          <li class="list-group-item d-flex align-items-center flex-wrap">
            <?php if (!empty($item['Poster']) && $item['Poster'] !== 'N/A'): ?>
              <img
                src="<?= $item['Poster'] ?>"
                alt="Poster for <?= $item['Title'] ?>"
                class="img-fluid me-3 mb-2"
                style="max-width: 60px;"
              >
            <?php else: ?>
              <div
                class="bg-secondary me-3 mb-2"
                style="width: 60px; height: 90px;"
              ></div>
            <?php endif; ?>
    
            <a href="/movie/detail?movie=<?= urlencode($item['Title']) ?>" class="flex-grow-1">
              <?= $item['Title'] ?> (<?= $item['Year'] ?>)
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php';