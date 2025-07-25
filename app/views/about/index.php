<?php require_once 'app/views/templates/header.php'; ?>

<div class="container py-5">
<div class="d-flex justify-content-center">
  <div class="card shadow-sm" style="max-width: 800px; width: 100%;">
    <div class="card-body">
      <h1 class="card-title mb-4 text-center">About Me</h1>
      <p class="card-text">
        Hello! I’m <strong>Kosi Abone</strong>, the creator of <em>myMovieApp</em>.
        I built this little web app as part of COSC 4806 to let anyone search movies,
        rate them, and even get AI‑generated mini‑reviews.
      </p>
      <p>Under the hood it uses:</p>
      <ul>
        <li>PHP (custom MVC structure)</li>
        <li>OMDb API for movie data</li>
        <li>Google’s Gemini API for AI‑generated reviews</li>
        <li>Bootstrap 5 for styling</li>
        <li>MySQL (via PDO) to store ratings</li>
      </ul>
      <p>Features available:</p>
      <ul>
        <li>Search any movie of your choice</li>
        <li>Give it a rating out of 5</li>
        <li>Click “Generate AI Review” for a nice surprise</li>
      </ul>
      <p>
        If you’d like to get in touch, you can reach me at
        <a href="mailto:abonekosiso@gmail.com">abonekosiso@gmail.com</a>.
      </p>

      <div class="d-flex justify-content-center gap-4">
        <a href="/home"  class="btn btn-outline-primary">
          <i class="fas fa-home me-1"></i>Go Home
        </a>
        <a href="/movie" class="btn btn-outline-success">
          <i class="fas fa-film me-1"></i>Search Movies
        </a>
      </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>