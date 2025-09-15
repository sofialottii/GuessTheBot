<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 row">

                    <h2>Indovina l'autore di questo testo!</h2>

            
                    <img src="../<?php echo $templateParams['infographic']['ImagePath']; ?>" class="img-fluid rounded shadow-sm my-3" alt="Infografica">
                    
                    <div class="card my-3">
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($text_to_show); ?></p>
                        </div>
                    </div>

                    <form action="processa_risposta.php" method="POST">
                        <input type="hidden" name="infographic_id" value="<?php echo $templateParams['infographic']['InfographicID']; ?>">
                        <input type="hidden" name="text_shown" value="<?php echo $text_type_shown; ?>">
                        
                        <p>Chi ha scritto questo testo?</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="submit" name="user_choice" value="human" class="btn btn-success btn-lg">Umano</button>
                            <button type="submit" name="user_choice" value="llm" class="btn btn-info btn-lg">Intelligenza Artificiale</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>