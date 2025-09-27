<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <div class="card shadow-sm border-0 mb-4 p-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div id="event-title-container">
                    <h1 class="h3 mb-0">Dettaglio: <?php echo $templateParams["Event"]["EventName"]; ?></h1>
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

            <?php if ($templateParams["Event"]["Mode"] == 'fixed'): ?>
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header"><h2 class="h5 mb-0">Infografiche Impostate per l'Evento</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($templateParams["FixedInfographics"] as $infographic): ?>
                                <div class="col-6 col-md-4 col-lg-2 text-center mb-2 div-fit">
                                    <img src="../<?php echo htmlspecialchars($infographic['ImagePath']); ?>" class="img-fit rounded" alt="<?php echo htmlspecialchars($infographic['Title']); ?>" title="<?php echo htmlspecialchars($infographic['Title']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0">
                <div class="card-header"><h2 class="h5 mb-0">Statistiche per Infografica</h2></div>
                <div class="card-body">
                    <?php if(empty($templateParams["InfographicStats"])): ?>
                        <p class="text-muted">Nessuna partita è stata ancora giocata in questo evento.</p>
                    <?php else: ?>
                        <div class="accordion" id="statsAccordion">
                            <?php foreach($templateParams["InfographicStats"] as $stat): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading_<?php echo $stat['InfographicID']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $stat['InfographicID']; ?>">
                                            <img src="../<?php echo htmlspecialchars($stat['ImagePath']); ?>" class="me-3 rounded" style="width:40px; height:40px; object-fit:cover;">
                                            <strong class="me-auto"><?php echo htmlspecialchars($stat['Title']); ?></strong>
                                            <span class="badge bg-primary rounded-pill">Successo: <?php echo ($stat['TotalAnswers'] > 0) ? number_format(($stat['CorrectAnswers'] / $stat['TotalAnswers']) * 100, 1) : '0'; ?>%</span>
                                        </button>
                                    </h2>
                                    <div id="collapse_<?php echo $stat['InfographicID']; ?>" class="accordion-collapse collapse" data-bs-parent="#statsAccordion">
                                        <div class="accordion-body">
                                            <h3 class="h6">Feedback degli Utenti:</h3>
                                            <?php 
                                                // Carichiamo i commenti solo per questa infografica
                                                $feedbacks = $dbh->getTextualFeedbackForInfographicInEvent($gameID, $stat['InfographicID']);
                                            ?>
                                            <?php if(empty($feedbacks)): ?>
                                                <p class="text-muted small">Nessun feedback testuale per questa infografica.</p>
                                            <?php else: ?>
                                                <ul class="list-group">
                                                    <?php foreach($feedbacks as $feedback): ?>
                                                        <li class="list-group-item">
                                                            ...
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <form action="#" method="POST" class="d-inline-block">
                <button type="submit" name="deleteEvent" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sei sicuro di voler eliminare questo evento? L\'azione è irreversibile e le risposte associate verranno rese anonime.');">
                    Elimina
                </button>
            </form>

    </div>
</div>
