<?php require_once 'app/views/templates/header.php'; ?>

<div class="container py-4">
  <h1 class="mb-4">Search for a Movie</h1>
  <form action="/movie/search" method="get" class="mb-5">
    <div class="input-group">
      <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Enter movie title…"
        required
      >
      <button class="btn btn-primary">Search</button>
    </div>
  </form>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
