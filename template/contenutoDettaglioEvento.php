<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <div class="card shadow-sm border-0 mb-4 p-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div id="event-title-container">
                    <h1 class="h3 mb-0">Titolo: <?php echo $templateParams["Event"]["EventName"]; ?></h1>
                </div>
                <div>
                    <button id="edit-btn" class="btn btn-outline-secondary btn-sm me-2">
                        Modifica
                    </button>
                    <a href="adminEvents.php" class="btn btn-secondary btn-sm">Torna alla Lista</a>
                </div>
                
        
            </div>
            <div class="card-body">
                <div id="view-mode">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Stato</dt>
                        <dd class="col-sm-9"><?php echo $templateParams["Event"]["IsActive"] ? '<span class="badge bg-success">Attivo</span>' : '<span class="badge bg-secondary">Inattivo</span>'; ?></dd>
                        <dt class="col-sm-3">Modalità</dt>
                        <dd class="col-sm-9"><?php echo ucfirst($templateParams["Event"]["Mode"]); ?></dd>
                        <dt class="col-sm-3">Scadenza</dt>
                        <dd class="col-sm-9" id="event-date-container"><?php echo $templateParams["Event"]["ExpiresAt"] ? date("d/m/Y H:i", strtotime($templateParams["Event"]["ExpiresAt"])) : 'Nessuna'; ?></dd>
                    </dl>
                </div>
            
                <!--per quando si vuole modificare titolo e scadenza: -->
                <div id="edit-mode" style="display: none;">
                    <form id="edit-event-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="eventName" class="form-label">Nome Evento</label>
                                <input type="text" class="form-control" id="eventName" name="eventName" value="<?php echo $templateParams["Event"]["EventName"]; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expiresAt" class="form-label">Data di Scadenza</label>
                                <input type="datetime-local" class="form-control" id="expiresAt" name="expiresAt" value="<?php echo !empty($templateParams["Event"]["ExpiresAt"]) ? date("Y-m-d\TH:i", strtotime($templateParams["Event"]["ExpiresAt"])) : ''; ?>">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" id="cancel-edit-btn" class="btn btn-secondary">Annulla</button>
                            <button type="button" id="save-edit-btn" class="btn btn-primary">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
                <!-- fine modifica -->
                <script src="../assets/js/dettaglioEvento.js"></script>
            </div>
        </div>

        <!--solo per i fixed vengono mostrate le infografiche impostate-->
        <?php if ($templateParams["Event"]["Mode"] == 'fixed'): ?>
            <div class="card shadow-sm border-0 mb-4 p-0">
                <div class="card-header"><h2 class="h5 mb-0">Infografiche Impostate per l'Evento</h2></div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach($templateParams["FixedInfographics"] as $infographic): ?>
                            <div class="col-6 col-md-4 col-lg-2 text-center mb-2 card-check div-fit">
                                <a href="dettaglioInfografica.php?IDInfographic=<?php echo $infographic["InfographicID"]; ?>&IDGame=<?php echo $templateParams["Event"]["GameID"]; ?>" >
                                    <img src="../<?php echo $infographic['ImagePath']; ?>" class="img-fit rounded" alt="<?php echo $infographic['Title']; ?>" title="<?php echo $infographic['Title']; ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0 p-0">
            <div class="card-header"><h2 class="h5 mb-0">Statistiche per Infografica</h2></div>
            <div class="card-body">
                <?php if(empty($templateParams["InfographicStats"])): ?>
                    <p class="text-muted">Nessuna partita è stata ancora giocata in questo evento.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 8%;">Immagine</th>
                                    <th scope="col" class="text-center d-none d-lg-table-cell">Titolo</th>
                                    <th scope="col" class="text-center">Giocate</th>
                                    <th scope="col" class="text-center">Indovinate</th>
                                    <th scope="col" class="text-center d-none d-sm-table-cell">Successo</th>
                                    <th scope="col" class="text-end">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($templateParams["InfographicStats"] as $stat): ?>
                                <tr>
                                    <td>
                                        <img src="../<?php echo $stat['ImagePath']; ?>" class="img-fluid rounded" alt="<?php echo $stat['Title']; ?>">
                                    </td>
                                    <td class="fw-bold d-none d-lg-table-cell">
                                        <?php echo $stat['Title']; ?>
                                    </td>
                                    <td class="text-center fw-bold">
                                        <?php echo $stat['TotalAnswers']; ?>
                                    </td>
                                    <td class="text-center fw-bold">
                                        <?php echo $stat['CorrectAnswers']; ?>
                                    </td>
                                    <td class="text-center d-none d-sm-table-cell">
                                        <?php 
                                            $successRate = ($stat['TotalAnswers'] > 0) ? $stat['AccuracyPercentage'] : 0;
                                        ?>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $successRate; ?>%; background-color: #E67E22;" aria-valuenow="<?php echo $successRate; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?php echo number_format($successRate, 1); ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="dettaglioInfografica.php?IDInfographic=<?php echo $stat['InfographicID']; ?>&IDGame=<?php echo $templateParams['Event']['GameID']; ?>" class="btn-outline-feedback">
                                            Vedi Feedback
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <form action="#" method="POST">
            <button type="submit" name="deleteEvent" class="btn btn-danger mt-4" onclick="return confirm('Sei sicuro di voler eliminare questo evento? L\'azione è irreversibile e le risposte associate verranno rese anonime.');">
                Elimina evento
            </button>
        </form>

    </div>
</div>
