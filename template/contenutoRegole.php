<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 row">

                    <div class="col-lg-6 text-start">
                        <h1 class="h2 fw-bold text-uppercase mb-3">COME SI GIOCA</h1>
                        <p>Lo scopo è testare la tua capacità di distinguere la descrizione di un'immagine di un'intelligenza artificiale e di un umano.</p>
                        <p class="mb-4">Pensi di riuscire a capire la differenza tra i due?</p>

                        <h2 class="h4 fw-bold text-uppercase mb-3">LE REGOLE DEL GIOCO</h2>
                        <p>Il gioco è strutturato in una serie di round. In ogni round, dovrai seguire questi semplici passi:</p>
                        <ol class="ps-3">
                            <li><b>Osserva l'infografica.</b></li>
                            <li><b>Leggi la descrizione,</b> prestando attenzione allo stile e alle parole usate.</li>
                            <li>Il testo è stato scritto da un umano o da un'intelligenza artificiale (LLM)? <b>Seleziona l'opzione che ritieni corretta.</b></li>
                            <li>Puoi facoltativamente <b>scrivere per quale motivo hai preso quella decisione.</b> È stato un termine strano? Una frase troppo perfetta? Una sensazione di "calore" umano?</li>
                        </ol>
                    </div>

                    <div class="col-lg-6 text-start pt-5 pt-lg-0 ps-lg-5">
                        <h2 class="h4 fw-bold text-uppercase mb-3">Il punteggio</h2>
                        <p>
                            Per ogni risposta <b>corretta</b>, guadagni <b>1 punto</b>.
                            Per ogni risposta <b>sbagliata</b>, non ricevi <b>nessun punto</b>.
                        </p>
                        <p class="mb-4"> Alla fine del gioco, il tuo punteggio totale determinerà la tua posizione nella classifica generale.</p>


                        <h2 class="h4 fw-bold text-uppercase mb-3">Sei Pronto?</h2>
                        <p>Ora che sai tutto, mettiti alla prova!</p>

                        <form action="gioco.php" method="POST" class="mt-3 text-center">
                            <div class="mb-3 d-block">
                                <input type="text" class="form-control mb-4" id="playerName" name="playerName" placeholder="Il tuo nome" required>
                                <button type="submit">Gioca</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>