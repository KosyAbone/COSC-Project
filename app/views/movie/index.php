<?php require_once 'app/views/templates/header.php';
$query   = $query   ?? '';
$results = $results ?? [];
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