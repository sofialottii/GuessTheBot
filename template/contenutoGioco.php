<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg">
            <div class="text-center mb-4">
                <h1>Guess The Bot</h1>
                <div class="row">
                    <div class="col-6">
                        <span class="badge bg-primary fs-6">Round <span id="current-round"><?php echo $_SESSION["currentRound"]; ?></span>/10</span>
                    </div>
                    <div class="col-6">
                        <span class="badge bg-success fs-6">Score: <span id="current-score"><?php echo $_SESSION["score"]; ?></span></span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 row">

                    <h2 class="text-center">Indovina l'autore di questo testo!</h2>

                    <div class="col-lg-6 offset-lg-3 text-center">
                        <img id="infographic-image" src="../<?php echo $templateParams['infographic']['ImagePath']; ?>" class="img-fluid rounded shadow-sm my-3" alt="Infografica">
                    </div>

                    <div class="card my-3">
                        <div class="card-body">
                            <p id="infographic-text" class="card-text"><?php echo $text_to_show; ?></p>
                        </div>
                    </div>

                    <div id="result-message" class="alert" style="display: none;"></div>

                    <form id="game-form" >
                        <input type="hidden" id="infographic-id" name="infographic_id" value="<?php echo $templateParams['infographic']['InfographicID']; ?>">
                        <input type="hidden" id="text-shown" name="text_shown" value="<?php echo $text_type_shown; ?>">
                        
                        <p>Chi ha scritto questo testo?</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="button" name="user_choice" data-choice="human" value="human" class="choice-btn btn btn-success btn-lg">Umano</button>
                            <button type="button" name="user_choice" data-choice="llm" value="llm" class="choice-btn btn btn-info btn-lg">Intelligenza Artificiale</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../assets/js/gameloop.js"></script>  
