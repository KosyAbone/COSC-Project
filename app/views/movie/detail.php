<?php require_once 'app/views/templates/header.php'; ?>

<div class="container py-4">
  <h1 class="mb-4">Movie Detail</h1>
  <div class="card mb-4 mx-auto" style="max-width: 600px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img 
          src="https://via.placeholder.com/200x300?text=Poster" 
          class="img-fluid rounded-start" 
          alt="Poster placeholder"
        >
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Movie Title</h5>
          <p class="card-text">
            Just a placeholder for the movie’s plot summary.  
            Eventually this will be replaced with dynamic data from OMDB.
          </p>
          <ul class="list-unstyled">
            <li><strong>Director:</strong> Director Name</li>
            <li><strong>Actors:</strong> Actor A, Actor B, Actor C</li>
            <li><strong>Genre:</strong> Drama, Thriller</li>
            <li><strong>Runtime:</strong> 120 min</li>
            <li><strong>IMDB Rating:</strong> 8.5</li>
          </ul>
          <a href="/movie" class="btn btn-secondary mt-3">
            Back to Search
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
