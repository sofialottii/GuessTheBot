<?php

class DatabaseHelper{

    private $db;
    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connesione fallita al db");
        }
    }

    public function addUser($nameUser){
        $stmt = $this->db->prepare("INSERT INTO users (Name)
                                        VALUES (?)");
        $stmt->bind_param("s", $nameUser);
        $stmt->execute();

        return $stmt->insert_id;
    }
    public function deleteUser($nameUser){
        $stmt = $this->db->prepare("DELETE FROM users
                                        WHERE Name = ?");
        $stmt->bind_param("s", $nameUser);
        $stmt->execute();
    }

    public function getUsers(){
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomInfograhic(){
        $stmt = $this->db->prepare("SELECT * FROM infographics
                                        ORDER BY RAND()
                                        LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addAnswer($idInfographic, $idUser, $textShown, $userChoice, $isCorrect, $motivation){
        $stmt = $this->db->prepare("INSERT INTO answers (InfographicID, UserID, TextShown, UserChoice, IsCorrect, Motivation)
                                        VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss",$idInfographic, $idUser, $textShown, $userChoice, $isCorrect, $motivation);
        $stmt->execute();
    }

    public function getLeaderboard(){
        $stmt = $this->db->prepare("SELECT u.Name, COUNT(a.IsCorrect) AS score
                                        FROM users u
                                        LEFT JOIN answers a ON u.UserID = a.UserID AND a.IsCorrect = 'y'
                                        GROUP BY u.UserID, u.Name
                                        ORDER BY score DESC
                                        LIMIT 10");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}

?>