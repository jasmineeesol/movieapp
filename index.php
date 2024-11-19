<?php
include 'dbh.inc.php'; // Include the database connection
include 'Movie.php'; // Include the Movie class

$movieApp = new Movie($pdo, '', '', ''); // Create an instance of the Movie class
$movies = []; // Initialize an empty array to hold movie results

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedGenre = $_POST['genre'] ?? ''; // Safely retrieve the genre

    if (!empty($selectedGenre)) {
        // Fetch movies based on the selected genre
        $movies = $movieApp->getMoviesByGenre($selectedGenre);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Ombre Background</title>
</head>
<body>
    <img src="imagesforapp/movielogo.png" alt="Movie Logo">
    <img src="imagesforapp/slogan.png" alt="Slogan" style="position: absolute; top: 30%; left: 50%; transform: translateX(-50%); width: 300px; height:auto;">
    
    <img src="imagesforapp/glossywhitestar-removebg-preview.png" alt="Star" style="position: absolute; top: 10%; left: 15%; width: 65px; height: 60px;">
    <img src="imagesforapp/glossywhitestar-removebg-preview.png" alt="Star" style="position: absolute; top: 20%; right: 10%; width: 70px; height: 60px;">
    <img src="imagesforapp/glossywhitestar-removebg-preview.png" alt="Star" style="position: absolute; bottom: 30%; left: 95%; transform: translateX(-50%); width: 70px; height: 60px;">
    <img src="imagesforapp/glossywhitestar-removebg-preview.png" alt="Star" style="position: absolute; bottom: 15%; right: 90%; width: 65px; height: 60px;">
    <img src="imagesforapp/glossywhitestar-removebg-preview.png" alt="Star" style="position: absolute; top: 50%; left: 70%; width: 70px; height: 60px;">

    <form action="" method="POST">
        <select name="genre">
            <option value="" disabled selected>Select a Genre</option>
            <option value="romance">Romance</option>
            <option value="thriller">Thriller</option>
            <option value="action">Action</option>
            <option value="science-fiction">Science Fiction</option>
            <option value="animation">Animation</option>
            <option value="war">War</option>
            <option value="crime">Crime</option>
            <option value="adventure">Adventure</option>
            <option value="fantasy">Fantasy</option>
            <option value="biography">Biography</option>
            <option value="drama">Drama</option>
            <option value="comedy">Comedy</option>
            <option value="horror">Horror</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <div class="output-box">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <?php if (!empty($movies)): ?>
                <h2>Movies in the genre: <?= htmlspecialchars($selectedGenre) ?></h2>
                <ul>
                    <?php foreach ($movies as $movieData): ?>
                        <?php
                        $movie = new Movie($pdo, $movieData['title'], $movieData['description'], $movieData['rating']);
                        ?>
                        <li>
                            Title: <?= htmlspecialchars($movie->getTitle()) ?><br>
                            Description: <?= htmlspecialchars($movie->getDescription()) ?><br>
                            Rating: <?= htmlspecialchars($movie->getRating()) ?><br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No movies found in this genre.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
