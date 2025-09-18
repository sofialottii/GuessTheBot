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

    public function getRandomInfographic($excludeIds = []) {
    $sql = "SELECT * FROM infographics";
    if (!empty($excludeIds)) {
        $placeholders = str_repeat('?,', count($excludeIds) - 1) . '?';
        $sql .= " WHERE InfographicID NOT IN ($placeholders)";
    }
    $sql .= " ORDER BY RAND() LIMIT 1";
    
    $stmt = $this->db->prepare($sql);
    
    if (!empty($excludeIds)) {
        $types = str_repeat('i', count($excludeIds));
        $stmt->bind_param($types, ...$excludeIds);
    }
    
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

    public function getUserScore($userID) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS score
                                    FROM answers
                                    WHERE UserID = ? AND IsCorrect = 'Y'");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['score'];
    }


    /* ADMIN */

    public function checkLogin($username, $password){
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE Username = ? AND Password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* per quanto farò la password hashata 
    public function checkLogin($username, $password){
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_all(MYSQLI_ASSOC);
        if(count($user) > 0 && password_verify($password, $user[0]["Password"])){
            return $user;
        }
        return [];
    }
    */

}

?>