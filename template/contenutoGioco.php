<div class="col-12 col-md-11 col-lg mb-4">
    <div class="text-center mb-4">
        <h1>GUESS THE BOT</h1>
        <div class="row">
            <div class="col-6">
                <span class="badge bg-primary fs-6">Round <span id="current-round"><?php echo $_SESSION["currentRound"] >= 10 ? "10" : $_SESSION["currentRound"]; ?></span>/10</span>
            </div>
            <div class="col-6">
                <span class="badge bg-success fs-6">Punteggio: <span id="current-score"><?php echo $_SESSION["score"]; ?></span></span>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5 row">

            <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center mb-lg-0 mb-3">
                <img id="infographic-image" src="../<?php echo $templateParams['infographic']['ImagePath']; ?>" class="img-fluid rounded shadow-sm" alt="Infografica" />
            </div>

            <div class="col-12 col-lg-8 text-start">

            <h2 class="text-center mb-4">Chi è l'autore di questo testo?</h2>
                
                <p id="infographic-text" class="descrizione"><?php echo $text_to_show; ?></p>
                
                <form id="game-form" method="POST" class="mt-4">
                    <label for="infographic-id" class="d-none">ID Infografica</label>
                    <input type="hidden" id="infographic-id" name="infographic_id" value="<?php echo $templateParams['infographic']['InfographicID']; ?>">
                    <label for="text-shown" class="d-none">Tipo di testo mostrato</label>
                    <input type="hidden" id="text-shown" name="text_shown" value="<?php echo $text_type_shown; ?>">
                
                    <p class="text-center">Chi ha scritto questo testo?</p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
                        <label for="human" class="d-none">Umano</label>
                        <button type="button" id="human" data-choice="human" class="choice-btn">Umano</button>
                        <label for="llm" class="d-none">Intelligenza Artificiale</label>
                        <button type="button" id="llm" data-choice="llm" class="choice-btn">AI</button>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="explanation" class="form-label small text-muted">Facoltativo: spiega la tua scelta.</label>
                            <textarea id="explanation" name="explanation" class="form-control" rows="3" placeholder="Scrivi qui..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="consigli" class="form-label small text-muted">Hai consigli per migliorare il gioco?</label>
                            <textarea id="consigli" name="consigli" class="form-control" rows="3" placeholder="Scrivi qui..."></textarea>
                        </div>
                    </div>

                </form>

            </div>

            <div id="result-message" class="alert" style="display: none;"></div>

            
        </div>
    </div>
</div>
    
<script src="../assets/js/gameloop.js"></script>  
