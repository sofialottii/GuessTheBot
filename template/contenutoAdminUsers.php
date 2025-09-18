<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h1>GESTISCI UTENTI</h1>
        <?php if (empty($templateParams["users"])): ?>
            <p class="alert alert-warning">Nessun utente registrato.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome Utente</th>
                        <th>Punteggio</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["users"] as $user): ?>
                        <tr>
                            <td><?php echo $user["Name"]; ?></td>
                            <td><?php echo $user["score"]; ?></td>
                            <td>
                                <form method="POST" action="adminUsers.php">
                                    <input type="hidden" name="deleteUserID" value="<?php echo $user['UserID']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        
            </table>
        </div>
        <?php endif; ?>
        <a href="index.php" class="text-start">Torna alla home</a>
    </div>
</div>
       
            