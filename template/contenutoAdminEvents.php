<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h1 class="fw-bold display-5">GESTIONE EVENTI</h1>
        <a href="creaEvento.php" class="btn btn-success col-6 align-self-center offset-3 mb-4">Crea Nuovo Evento</a>

        <?php if(empty($templateParams["events"])): ?>
            <p class="alert alert-warning">Nessun evento presente. Creane uno!</p>
        <?php else: ?>

            <?php foreach($templateParams["events"] as $event): ?>
                <div class="card mb-4 shadow-sm <?php if($event["IsActive"]) echo 'border-success border-2'; ?>">
                        
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0"><?php echo htmlspecialchars($event["EventName"]); ?></h2>
                        <?php if($event["IsActive"]): ?>
                            <span class="badge bg-success">Attualmente Attivo</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inattivo</span>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <a href="dettaglioEvento.php?GameID=<?php echo $event['GameID']; ?>" class="card-body-link">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4">Modalità di Gioco</dt>
                                        <dd class="col-sm-8"><?php echo ($event["Mode"] == 'fixed') ? 'Fissa' : 'Casuale'; ?></dd>

                                        <dt class="col-sm-4">Data di Creazione</dt>
                                        <dd class="col-sm-8"><?php echo date("d/m/Y H:i", strtotime($event["CreatedAt"])); ?></dd>

                                        <dt class="col-sm-4">Scadenza</dt>
                                        <dd class="col-sm-8"><?php echo $event["ExpiresAt"] ? date("d/m/Y H:i", strtotime($event["ExpiresAt"])) : 'Nessuna'; ?></dd>
                                    </dl>
                                </div>
                                <div class="col-md-3 d-none d-md-flex align-items-center justify-content-center text-secondary">
                                    <i class="bi bi-box-arrow-in-right h1"></i>
                                </div>
                            </div>
                        </a>
                        <form action="adminEvents.php" method="POST" class="d-inline-block me-2">
                            <input type="hidden" name="gameID" value="<?php echo $event['GameID']; ?>">
                            <button type="submit" name="activateEvent" class="btn btn-sm btn-outline-success" <?php if($event["IsActive"]) echo 'disabled'; ?>>
                                Attiva
                            </button>
                        </form>

                        <form action="adminEvents.php" method="POST" class="d-inline-block">
                            <input type="hidden" name="gameID" value="<?php echo $event['GameID']; ?>">
                            <button type="submit" name="deleteEvent" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sei sicuro di voler eliminare questo evento? L\'azione è irreversibile e le risposte associate verranno rese anonime.');">
                                Elimina
                            </button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>



    </div>
</div>