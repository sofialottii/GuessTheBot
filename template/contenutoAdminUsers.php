<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h1 class="fw-bold display-5">GESTIONE UTENTI</h1>
        <form action="adminUsers.php" method="GET" class="row g-3 align-items-center justify-content-center justify-content-md-start mb-4">

            <div class="col-auto">
                <label for="eventFilter" class="col-form-label">Filtra per evento:</label>
            </div>

            <div class="col-sm-6 col-md-5 col-lg-4">
                <select class="form-select" id="eventFilter" name="IDGame">
                    <option value="">Mostra tutto</option>
                    <?php foreach($templateParams["eventiFiltro"] as $evento): ?>
                        <option value="<?php echo $evento['GameID']; ?>" <?php if($templateParams["filtroAttuale"] == $evento['GameID']) echo 'selected'; ?>>
                            <?php echo $evento['EventName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-auto">
                <button type="submit" class="px-3 py-2">Cerca</button>
            </div>

        </form>
        <?php if (empty($templateParams["users"])): ?>
            <p class="alert alert-warning">Nessun utente registrato.</p>
        
        <?php else: ?>

        <?php if (isset($_GET["IDGame"]) && $_GET["IDGame"] > 0): ?>
            <a href="../api/export_csv.php?IDGame=<?php echo $_GET["IDGame"];?>" class="bottone col-lg-3 col-8">
                Esporta Sessione (CSV)
            </a>
        <?php else: ?>
            <a href="../api/export_csv.php" class="bottone col-lg-2 col-8">
                Esporta Tutto (CSV)
            </a>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Download CSV</th>
                        <th>Nome Utente</th>
                        <th>Punteggio</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["users"] as $user): ?>
                        <form method="GET" action="../api/export_csv.php">
                            <input type="hidden" name="userID" value="<?php echo $user['UserID']; ?>" />
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-light btn-sm"><img src="../assets/icons/downloadButton.png" alt="download csv" /></button>
                                </td>
                                <td><?php echo $user["Name"]; ?></td>
                                <td><?php echo $user["score"]; ?></td>
                                <td>
                                    <form method="POST" action="adminUsers.php">
                                        <input type="hidden" name="deleteUserID" value="<?php echo $user['UserID']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                </tbody>
        
            </table>
        </div>
        <?php endif; ?>
        <a href="index.php" class="text-start">Torna alla home</a>
    </div>
</div>
       