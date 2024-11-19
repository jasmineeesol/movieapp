<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'Movie.php'; // Include the Movie class
include 'dbh.inc.php'; // Include the database connection

$movieApp = new Movie($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST); // Check what is being submitted
    echo "</pre>";

    $selectedGenre = $_POST['genre'] ?? ''; // Safely retrieve the genre
    if (empty($selectedGenre)) {
        echo "<p>No genre selected.</p>";
    } else {
        $movies = $movieApp->getMoviesByGenre($selectedGenre);

        if ($movies) {
            echo "<h2>Movies in the genre: " . htmlspecialchars($selectedGenre) . "</h2>";
            echo "<ul>";
            foreach ($movies as $movie) {
                echo "<li>" . htmlspecialchars($movie['title']) . "</li>"; // Display titles
            }
            echo "</ul>";
        } else {
            echo "<p>No movies found in this genre.</p>";
        }
    }
}
?>
