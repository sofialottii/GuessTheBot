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

    public function getUsers(){
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* GAMELOOP */

    public function getRandomInfographic($excludeIds = []) {
        $sql = "SELECT * FROM infographics";
        if (!empty($excludeIds)) {
            $placeholders = str_repeat('?,', count($excludeIds) - 1) . '?';
            $sql .= " WHERE InfographicID NOT IN ($placeholders) AND IsActive = TRUE";
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

    public function getActiveEvent() {
        $stmt = $this->db->prepare("SELECT * FROM game_events WHERE IsActive = TRUE LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); //null se non c'è evento attivo
    }

    public function addAnswer($idInfographic, $idUser, $idGame, $textShown, $userChoice, $isCorrect, $motivation, $advice){
        $stmt = $this->db->prepare("INSERT INTO answers (InfographicID, UserID, GameID, TextShown, UserChoice, IsCorrect, Motivation, Advice)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisssss",$idInfographic, $idUser, $idGame, $textShown, $userChoice, $isCorrect, $motivation, $advice);
        $stmt->execute();
    }

    /* CLASSIFICA UTENTE */

    public function getLeaderboard(){
        $stmt = $this->db->prepare("SELECT u.Name, u.UserID, COUNT(a.IsCorrect) AS score
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
    
    public function deleteUser($idUser){
        $stmt = $this->db->prepare("DELETE FROM answers WHERE UserID = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $stmt = $this->db->prepare("DELETE FROM users
                                        WHERE UserID = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
    }

    public function getAllUsersWithScores(){
        $stmt = $this->db->prepare("SELECT u.UserID, u.Name, COUNT(a.IsCorrect) AS score
                                        FROM users u
                                        LEFT JOIN answers a ON u.UserID = a.UserID AND a.IsCorrect = 'y'
                                        GROUP BY u.UserID, u.Name
                                        ORDER BY score DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllAnswers(){
        $stmt = $this->db->prepare("SELECT a.*, i.ImagePath, i.Title, u.Name
                                    FROM answers a
                                    LEFT JOIN infographics i ON a.InfographicID = i.InfographicID
                                    LEFT JOIN users u ON A.UserID = u.UserID
                                    WHERE a.Motivation IS NOT NULL AND a.Motivation <> ''");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllAdvices(){
        $stmt = $this->db->prepare("SELECT a.*, i.ImagePath, i.Title, u.Name
                FROM answers a
                LEFT JOIN infographics i ON a.InfographicID = i.InfographicID
                LEFT JOIN users u ON a.UserID = u.UserID
                WHERE a.Advice IS NOT NULL AND a.Advice <> ''");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllInfographics(){
        $stmt = $this->db->prepare("SELECT * FROM infographics WHERE IsActive = TRUE");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteInfographic($idInfographic){
        $stmt = $this->db->prepare("DELETE FROM infographics WHERE InfographicID = ?");
        $stmt->bind_param("i", $idInfographic);
        $stmt->execute();
    }

    public function addInfographic($title, $imagePath, $humanText, $llmText){
        $stmt = $this->db->prepare("INSERT INTO infographics (Title, ImagePath, HumanText, LlmText)
                                        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $imagePath, $humanText, $llmText);
        $stmt->execute();
    }

    public function updateInfographic($idInfographic, $title, $imagePath, $humanText, $llmText){
        $stmt = $this->db->prepare("UPDATE infographics 
                                        SET Title = ?, ImagePath = ?, HumanText = ?, LlmText = ?
                                        WHERE InfographicID = ?");
        $stmt->bind_param("ssssi", $title, $imagePath, $humanText, $llmText, $idInfographic);
        $stmt->execute();
    }

    public function getInfographicById($idInfographic){
        $stmt = $this->db->prepare("SELECT * FROM infographics WHERE InfographicID = ?");
        $stmt->bind_param("i", $idInfographic);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /*LE STATISTICHE DELLA SINGOLA INFOGRAFICA DIPENDENONO DALLA PRESENZA O MENO DI UN EVENTO */
    public function getStatisticsInfographicById($idInfographic, $eventId = null){ 
        $query = "SELECT i.*,
            COUNT(a.AnswerID) AS TotalAnswers,
            SUM(CASE WHEN a.IsCorrect = 'Y' THEN 1 ELSE 0 END) AS CorrectAnswers,
            SUM(CASE WHEN a.IsCorrect = 'N' THEN 1 ELSE 0 END) AS IncorrectAnswers,
            AVG(CASE WHEN a.IsCorrect = 'Y' THEN 1 ELSE 0 END) * 100 AS AccuracyPercentage
            FROM infographics i
            LEFT JOIN answers a ON i.InfographicID = a.InfographicID
            WHERE i.InfographicID = ?";
        //se c'è un evento viene aggiunta la condizione e poi il group by, altrimenti solo il group by
        $query = $eventId ? $query . " AND a.GameID = ? GROUP BY i.InfographicID" : $query . " GROUP BY i.InfographicID";

        $stmt = $this->db->prepare($query);
        if($eventId != null){
            $stmt->bind_param("ii", $idInfographic, $eventId);
        } else {
            $stmt->bind_param("i", $idInfographic);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAllAnswersById($idInfographic, $eventId = null){
        $query = "SELECT a.*, u.Name
            FROM answers a
            LEFT JOIN users u ON a.UserID = u.UserID
            WHERE a.InfographicID = ?
            AND (a.Motivation IS NOT NULL AND a.Motivation <> ''
            OR a.Advice IS NOT NULL AND a.Advice <> '')";
        
        $query = $eventId ? $query . " AND a.GameID = ?" : $query;

        $stmt = $this->db->prepare($query);
        if($eventId != null){
            $stmt->bind_param("ii", $idInfographic, $eventId);
        } else {
            $stmt->bind_param("i", $idInfographic);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEventsForInfographic($infographicId) {
        $stmt = $this->db->prepare("
            SELECT DISTINCT e.GameID, e.EventName 
            FROM GAME_EVENTS e
            JOIN answers a ON e.GameID = a.GameID
            WHERE a.InfographicID = ?
            ORDER BY e.CreatedAt DESC
        ");
        $stmt->bind_param("i", $infographicId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    public function disableInfographic($idInfographic){
        $stmt = $this->db->prepare("UPDATE infographics SET IsActive = FALSE WHERE InfographicID = ?");
        $stmt->bind_param("i", $idInfographic);
        $stmt->execute();
    }

    /* EVENTI */

    public function getAllEvents(){
    $stmt = $this->db->prepare("SELECT * FROM game_events ORDER BY CreatedAt DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addEvent($eventName, $mode, $isActive, $expiresAt){
        $stmt = $this->db->prepare("INSERT INTO game_events (EventName, Mode, IsActive, ExpiresAt)
                                        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $eventName, $mode, $isActive, $expiresAt);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function deactivateAllEvents(){
        $stmt = $this->db->prepare("UPDATE game_events SET IsActive = FALSE WHERE IsActive = TRUE");
        $stmt->execute();
    }

    public function activateEvent($eventId){
    
        //disabilitiamo tutti gli eventi attivi
    $stmt1 = $this->db->prepare("UPDATE game_events SET IsActive = FALSE WHERE IsActive = TRUE");
    $stmt1->execute();
    //abilitiamo l'evento selezionato
    $stmt2 = $this->db->prepare("UPDATE game_events SET IsActive = TRUE WHERE GameID = ?");
    $stmt2->bind_param("i", $eventId);
    $stmt2->execute();
    }

    public function deleteEvent($eventId){
        //prima controllo se è fixed così elimino anche le righe in event_infographics
        $stmt = $this->db->prepare("SELECT Mode FROM game_events WHERE GameID = ?");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['Mode'] === 'fixed') {
            $stmtDel = $this->db->prepare("DELETE FROM event_infographics WHERE GameID = ?");
            $stmtDel->bind_param("i", $eventId);
            $stmtDel->execute();
        }

        //ora posso eliminare l'evento
        $stmt = $this->db->prepare("DELETE FROM game_events WHERE GameID = ?");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
    }

    public function associateInfographicToEvent($idEvent, $infographicID){
        $stmt = $this->db->prepare("INSERT INTO event_infographics (GameID, InfographicID)
                                        VALUES (?, ?)");
        $stmt->bind_param("ii", $idEvent, $infographicID);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getEventById($eventId) {
        $stmt = $this->db->prepare("SELECT * FROM game_events WHERE GameID = ?");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getInfographicStatsForEvent($eventId) {
        $stmt = $this->db->prepare("SELECT i.*,
                                        COUNT(a.AnswerID) AS TotalAnswers,
                                        SUM(CASE WHEN a.IsCorrect = 'Y' THEN 1 ELSE 0 END) AS CorrectAnswers,
                                        SUM(CASE WHEN a.IsCorrect = 'N' THEN 1 ELSE 0 END) AS IncorrectAnswers,
                                        AVG(CASE WHEN a.IsCorrect = 'Y' THEN 1 ELSE 0 END) * 100 AS AccuracyPercentage
                                    FROM infographics i
                                    LEFT JOIN answers a ON i.InfographicID = a.InfographicID
                                    WHERE a.GameID = ?
                                    GROUP BY i.InfographicID, i.Title
                                    ORDER BY TotalAnswers DESC");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

    //commenti (motivazioni e consigli) per una specifica infografica in un evento
    public function getTextualFeedbackForInfographicInEvent($eventId, $infographicId) {
        $stmt = $this->db->prepare("
            SELECT u.Name, a.*
            FROM answers a
            JOIN users u ON a.UserID = u.UserID
            WHERE a.GameID = ? AND a.InfographicID = ? AND (a.Motivation IS NOT NULL OR a.Advice IS NOT NULL)
        ");
        $stmt->bind_param("ii", $eventId, $infographicId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    //prende le infografiche associate a un evento "fisso"
    public function getFixedInfographicsForEvent($eventId) {
        $stmt = $this->db->prepare("
            SELECT i.* FROM event_infographics ei
            JOIN infographics i ON ei.InfographicID = i.InfographicID
            WHERE ei.GameID = ?
        ");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deactivateExpiredActiveEvent() {
        $stmt = $this->db->prepare("
            UPDATE GAME_EVENTS
            SET IsActive = FALSE, ExpiresAt = NULL
            WHERE IsActive = TRUE
            AND ExpiresAt IS NOT NULL
            AND ExpiresAt <= NOW()
        ");
        $stmt->execute();
    }

    public function updateEventDetails($gameID, $eventName, $expiresAt) {
        $expiresAt = !empty($expiresAt) ? $expiresAt : null;

        $stmt = $this->db->prepare("UPDATE GAME_EVENTS SET EventName = ?, ExpiresAt = ? WHERE GameID = ?");
        $stmt->bind_param("ssi", $eventName, $expiresAt, $gameID);
        return $stmt->execute();
    }


    /* CSV E DATI UTENTE */

    
    //riepilogo di tutti gli utenti con il loro punteggio totale e round giocati
    public function getUsersSummary() {
        $stmt = $this->db->prepare("
            SELECT
                u.UserID, u.Name,
                COUNT(DISTINCT a.GameID) as EventsPlayed,
                SUM(CASE WHEN a.IsCorrect = 'Y' THEN 1 ELSE 0 END) as TotalScore,
                COUNT(a.AnswerID) as TotalAnswers
            FROM users u
            LEFT JOIN answers a ON u.UserID = a.UserID
            GROUP BY u.UserID, u.Name
            ORDER BY TotalScore DESC, u.Name ASC
        ");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    //TUTTE LE RISPOSTE PER L'ESPORTAZIONE
    public function getAllAnswersForExport() {
        $stmt = $this->db->prepare("
            SELECT
                u.UserID, u.Name as UserName, e.EventName, i.Title as InfographicTitle,
                a.TextShown, a.UserChoice, a.IsCorrect, a.Motivation, a.Advice, a.AnsweredAt
            FROM answers a
            JOIN users u ON a.UserID = u.UserID
            JOIN infographics i ON a.InfographicID = i.InfographicID
            LEFT JOIN GAME_EVENTS e ON a.GameID = e.GameID
            ORDER BY a.AnswerID ASC
        ");
        $stmt->execute();
        return $stmt->get_result(); //restituisco il risultato per lo streaming
}

    //SINGOLO UTENTE, esportazione
    public function getUserAnswersForExport($userId) {
        $stmt = $this->db->prepare("
            SELECT
                u.UserID, u.Name as UserName, e.EventName, i.Title as InfographicTitle,
                a.TextShown, a.UserChoice, a.IsCorrect, a.Motivation, a.Advice, a.AnsweredAt
            FROM answers a
            JOIN users u ON a.UserID = u.UserID
            JOIN infographics i ON a.InfographicID = i.InfographicID
            LEFT JOIN GAME_EVENTS e ON a.GameID = e.GameID
            WHERE a.UserID = ?
            ORDER BY a.AnswerID ASC
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result(); //risultato per lo streaming
    }

    //SINGOLA SESSIONE esportazione
    public function getSessionAnswersForExport($sessionId) {
        $stmt = $this->db->prepare("
            SELECT
                u.UserID, u.Name as UserName, e.EventName, i.Title as InfographicTitle,
                a.TextShown, a.UserChoice, a.IsCorrect, a.Motivation, a.Advice, a.AnsweredAt
            FROM answers a
            JOIN users u ON a.UserID = u.UserID
            JOIN infographics i ON a.InfographicID = i.InfographicID
            LEFT JOIN GAME_EVENTS e ON a.GameID = e.GameID
            WHERE a.SessionID = ?
            ORDER BY a.AnswerID ASC
        ");
        $stmt->bind_param("s", $sessionId);
        $stmt->execute();
        return $stmt->get_result(); //risultato per lo streaming
    }



}

?>