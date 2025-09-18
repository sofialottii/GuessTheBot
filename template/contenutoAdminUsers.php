<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 text-center row">

                    <h1>GESTISCI UTENTI</h1>
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
                    <a href="index.php">Torna alla home</a>
                </div>
            </div>
        </div>
    </div>
</main>