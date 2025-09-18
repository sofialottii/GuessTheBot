<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 row">

        <div class="col-lg-6 text-start">
            <h1 class="h2 fw-bold text-uppercase mb-3">COME SI GIOCA</h1>
            <p>Lo scopo è testare la tua capacità di distinguere la descrizione di un'immagine di un'intelligenza artificiale e di un umano.</p>
            <p class="mb-4">Pensi di riuscire a capire la differenza tra i due?</p>

            <h2 class="h4 fw-bold text-uppercase mb-3">LE REGOLE DEL GIOCO</h2>
            <p>Il gioco è strutturato in una serie di round. In ogni round, dovrai seguire questi semplici passi:</p>
            <ol class="ps-3">
                <li><strong>Osserva l'infografica.</strong></li>
                <li><strong>Leggi la descrizione,</strong> prestando attenzione allo stile e alle parole usate.</li>
                <li>Il testo è stato scritto da un umano o da un'intelligenza artificiale (LLM)? <strong>Seleziona l'opzione che ritieni corretta.</strong></li>
                <li>Puoi facoltativamente <strong>scrivere per quale motivo hai preso quella decisione.</strong> È stato un termine strano? Una frase troppo perfetta? Una sensazione di "calore" umano?</li>
            </ol>
        </div>

        <div class="col-lg-6 text-start pt-5 pt-lg-0 ps-lg-5">
            <h2 class="h4 fw-bold text-uppercase mb-3">Il punteggio</h2>
            <p>
                Per ogni risposta <strong>corretta</strong>, guadagni <strong>1 punto</strong>.
                Per ogni risposta <strong>sbagliata</strong>, non ricevi <strong>nessun punto</strong>.
            </p>
            <p class="mb-4"> Alla fine del gioco, il tuo punteggio totale determinerà la tua posizione nella classifica generale.</p>


            <h2 class="h4 fw-bold text-uppercase mb-3">Sei Pronto?</h2>
            <p>Ora che sai tutto, mettiti alla prova!</p>

            <form action="gioco.php" method="POST" class="mt-3 text-center">
                <div class="mb-3 d-block">
                    <label for="playerName" class="d-none">Inserisci nome</label>
                    <input type="text" class="form-control mb-4" id="playerName" name="playerName" placeholder="Il tuo nome" required>
                    <label for="gioca" class="d-none">Gioca</label>
                    <button type="submit" id="gioca">Gioca</button>
                </div>    
            </form>
        </div>

    </div>
    
</div>