<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg mb-3">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 text-center row">
                    <div class=" col-lg-4">
                        <img src="../assets/images/logo.png" alt="GuessTheBot Logo" class="mb-4 col-12" />
                    </div>
                    <div class="align-items-center col-lg-8">
                        <h1 class="fw-bold my-3 my-lg-5">GUESS THE BOT</h1>

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
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>