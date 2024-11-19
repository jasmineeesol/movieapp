<?php
abstract class Media {
    protected $title;
    protected $description;
    protected $rating;

    public function __construct($title, $description, $rating) {
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
    }

    abstract public function getTitle();
    abstract public function getDescription();
    abstract public function getRating();
}

class Movie extends Media {
    private $pdo;

    public function __construct($pdo, $title, $description, $rating) {
        parent::__construct($title, $description, $rating);
        $this->pdo = $pdo;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getMoviesByGenre($genre) {
        $stmt = $this->pdo->prepare("SELECT title, description, rating FROM movies WHERE genre = :genre");
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
