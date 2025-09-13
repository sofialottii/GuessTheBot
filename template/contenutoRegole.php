<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 row">

                    <div class="col-lg-7 text-start">
                        <h1 class="h2 fw-bold text-uppercase">Come si gioca</h1>
                        <p class="text-muted">Lo scopo è testare la tua capacità di distinguere la descrizione di un'immagine di un'intelligenza artificiale e di un umano.</p>
                        <p class="text-muted mb-4">Pensi di avere l'intuito giusto per scoprire chi si nasconde dietro le parole?</p>

                        <h2 class="h4 fw-bold text-uppercase">Le regole del gioco</h2>
                        <p class="text-muted">Il gioco è strutturato in una serie di round. In ogni round, dovrai seguire questi semplici passi:</p>
                        <ol class="text-muted ps-3">
                            <li><strong>Osserva l'infografica.</strong></li>
                            <li><strong>Leggi la descrizione</strong>, prestando attenzione allo stile, al tono e alle parole usate.</li>
                            <li><strong>Il testo è stato scritto da un umano o da un'intelligenza artificiale (LLM)?</strong> Seleziona l'opzione che ritieni corretta.</li>
                            <li><strong>Se vuoi, puoi scrivere nella casella di testo</strong> quali elementi ti hanno portato a quella decisione. È stato un termine strano? Una frase troppo perfetta? O forse una sensazione di "calore" umano?</li>
                        </ol>
                    </div>

                    <div class="col-lg-5 text-start pt-5 pt-lg-0 ps-lg-5">
                        <h2 class="h4 fw-bold text-uppercase">Il punteggio</h2>
                        <ul class="text-muted ps-3">
                            <li>Per ogni risposta <strong>corretta</strong>, guadagni <strong>1 punto</strong>.</li>
                            <li>Per ogni risposta <strong>sbagliata</strong> o <strong>saltata</strong> (skip), non ricevi <strong>nessun punto</strong>.</li>
                            <li>Alla fine del gioco, il tuo punteggio totale determinerà la tua posizione nella classifica generale.</li>
                        </ul>

                        <hr class="my-4">

                        <h2 class="h4 fw-bold text-uppercase">Sei Pronto?</h2>
                        <p class="text-muted">Ora che sai tutto, mettiti alla prova e scopri quanto è affinato il tuo intuito!</p>

                        <form action="index.php" method="GET" class="mt-3">
                            <div class="mb-2">
                                <label for="playerName" class="form-label text-muted">Inserisci il tuo nome</label>
                                <input type="text" class="form-control" id="playerName" name="playerName" placeholder="Il tuo nome..." required>
                            </div>
                            <div class="d-grid">
                                <button type="submit">Gioca</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>