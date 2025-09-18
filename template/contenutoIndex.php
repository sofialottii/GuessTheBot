<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg mb-4">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 text-center row">
                    <div class=" col-lg-4">
                        <img src="../assets/images/logo.png" alt="GuessTheBot Logo" class="mb-4 col-12" />
                    </div>
                    <div class="align-items-center col-lg-8">
                        <h1 class="fw-bold my-3 my-lg-5">GUESS THE BOT</h1>

                        <?php if (!isset($_SESSION["Admin"])): ?>

                        <p class="text-muted my-4 my-lg-5">
                            Metti alla prova la tua capacità di distinguere un testo scritto da un'intelligenza artificiale!
                        </p>

                        <form action="gioco.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="playerName" name="playerName" placeholder="Il tuo nome" required>
                                <label for="playerName">Inserisci il tuo nome</label>
                            </div>
                            
                            <div class="d-grid">
                                <button class="my-3" type="submit">Gioca</button>
                            </div>
                        </form>

                        <?php else: ?>

                        <p class="text-muted my-4 my-lg-5">
                            Benvenuto, <?php echo $_SESSION["Admin"]; ?>! Puoi gestire il sito dall'area riservata.
                        </p>
                        <ul class="p-0 list-unstyled">
                            <li class="mb-3">
                                <a href="admin_infographics.php" class="bottone my-3">Gestisci Infografiche</a>
                            </li>
                            <li class="mb-3">
                                <a href="admin_answers.php" class="bottone my-3">Visualizza Risposte</a>
                            </li>
                            <li class="mb-3">
                                <a href="admin_users.php" class="bottone my-3">Gestisci Utenti</a>
                            </li>
                        <a href="login.php" class="bottone my-3">Logout</a>
                            
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>