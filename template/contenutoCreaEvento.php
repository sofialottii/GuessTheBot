<div class="col-11 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h1 class="fw-bold display-5 mb-4">CREA NUOVO EVENTO</h1>

        <form action="creaEvento.php" method="POST" class="text-start">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="eventName" class="form-label">Nome Evento</label>
                    <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Es. Test di fine Settembre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="eventMode" class="form-label">Modalità di Gioco</label>
                    <select class="form-select" id="eventMode" name="eventMode" required>
                        <option value="random" selected>Casuale (Infografiche diverse per ogni giocatore)</option>
                        <option value="fixed">Fissa (Infografiche scelte dall'admin)</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="endDate" class="form-label">Data di Scadenza (Opzionale)</label>
                    <input type="datetime-local" class="form-control" id="endDate" name="endDate">
                    <div class="form-text">
                        Lascia vuoto se l'evento non ha una scadenza.
                    </div>
                </div>
                <div class="col-md-6 mb-3 align-self-center">
                    <div class="form-check mt-lg-2 ">
                        <input class="form-check-input" type="checkbox" id="isActive" name="isActive" value="1">
                        <label class="form-check-label" for="isActive">
                            Imposta come sessione corrente
                        </label>
                    </div>
                </div>
            </div>
        
            <!-- selezione infografiche -->

            <div id="infographics-selection" style="display: none;">
                <h2 class="h4 mb-3">Seleziona le Infografiche per l'Evento</h2>
                <p class="text-muted">Scegli le infografiche che verranno mostrate a tutti i giocatori in questo evento. Se ne scegli più di 10, verranno selezionate casualmente tra quelle scelte.</p>
                <span class="badge bg-primary rounded-pill fs-6">
                    Selezionate: <span id="selection-counter">0</span> / 10
                </span>


                <div id="infographics-grid" class="row mt-3">
                    <?php foreach ($templateParams["infographics"] as $infographic): ?>
                        <div class="col-6 col-md-4 col-lg-2 mb-3 infographic-item">
                            <div class="form-check card-check div-fit">
                                <input class="form-check-input infographic-checkbox" type="checkbox" name="infographics[]" value="<?php echo $infographic['InfographicID']; ?>" id="infographic_<?php echo $infographic['InfographicID']; ?>">
                                <label class="form-check-label" for="infographic_<?php echo $infographic['InfographicID']; ?>">
                                    <img src="../<?php echo $infographic['ImagePath']; ?>" class="img-fit rounded" alt="">
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <nav id="infographics-pagination" class="d-flex justify-content-center mt-3" aria-label="Paginazione infografiche">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" id="prev-page">Precedente</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" id="next-page">Successiva</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="adminEvents.php" class="btn btn-secondary me-2">Annulla</a>
                <input type="submit" name="crea" class="btn btn-success" value="Crea Evento" />
            </div>

        </form>

<script src="../assets/js/caroselloImmagini.js"></script>

<script>
document.getElementById('eventMode').addEventListener('change', function () {
    const selectionDiv = document.getElementById('infographics-selection');
    if (this.value === 'fixed') {
        selectionDiv.style.display = 'block';
    } else {
        selectionDiv.style.display = 'none';
    }
});
</script>



    </div>
</div>