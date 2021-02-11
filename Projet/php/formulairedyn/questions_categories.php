<?php
class Questions_categories
{
    public $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getQuestions()
    {
          $query = "SELECT * from questions where actif = 1 order by id_categorie;";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();
          $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

          return json_encode($questions);
    }
    public function getAllCategories()
    {
        $query = "SELECT distinct c.id, c.categorie from categories c inner join questions q on q.id_categorie = c.id  order by c.categorie;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($categories);
    }

    public function getCategories()
    {
        $query = "SELECT distinct c.id, c.categorie from categories c inner join questions q on q.id_categorie = c.id where q.actif = 1 order by c.categorie;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($categories);
    }

    public function getAllQuestions()
    {
          $query = "SELECT * from questions  order by id_categorie;";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();
          $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

          return json_encode($questions);
    }

    public function saveForm($jsonarray){

        $array = array();
        $array = json_decode($jsonarray);

        for ($i=0; $i < count($array); $i++) {
          $query = "INSERT INTO projets_questions values();";
        }
    }
}
