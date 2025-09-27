<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h1 class="fw-bold display-5">GESTIONE EVENTI</h1>
        <a href="creaEvento.php" class="bottone col-6 align-self-center offset-3 my-4">Crea Nuovo Evento</a>

        <?php if(empty($templateParams["events"])): ?>
            <p class="alert alert-warning">Nessun evento presente. Creane uno!</p>
        <?php else: ?>

            <?php foreach($templateParams["events"] as $event): ?>
                <div class="card mb-4 shadow-sm p-0 <?php if($event["IsActive"]) echo 'border-success border-2'; ?>">
                        
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0"><?php echo htmlspecialchars($event["EventName"]); ?></h2>
                        <?php if($event["IsActive"]): ?>
                            <span class="badge bg-success">Attualmente Attivo</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inattivo</span>
                        <?php endif; ?>
                    </div>

                    <a href="dettaglioEvento.php?GameID=<?php echo $event['GameID']; ?>" class="card-body-link">
                        <div class="card-body">
                        
                            <div class="row align-items-center">
                                <div class="col-12 justify-content-center">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-6">Modalità di Gioco</dt>
                                        <dd class="col-sm-6"><?php echo ($event["Mode"] == 'fixed') ? 'Fissa' : 'Casuale'; ?></dd>

                                        <dt class="col-sm-6">Data di Creazione</dt>
                                        <dd class="col-sm-6"><?php echo date("d/m/Y H:i", strtotime($event["CreatedAt"])); ?></dd>

                                        <dt class="col-sm-6">Scadenza</dt>
                                        <dd class="col-sm-6"><?php echo $event["ExpiresAt"] ? date("d/m/Y H:i", strtotime($event["ExpiresAt"])) : 'Nessuna'; ?></dd>
                                    </dl>
                                </div>
                            </div>
                        
                            <form action="adminEvents.php" method="POST" class="d-inline-block">
                                <label for="<?php echo $event['GameID']; ?>" hidden></label>
                                <input type="hidden" id="<?php echo $event["GameID"]; ?>" name="gameID" value="<?php echo $event['GameID']; ?>">
                                
                                <label for="<?php echo "active".$event['GameID']; ?>" hidden></label>
                                <button type="submit" <?php if($event["IsActive"]):?>name="deactivateEvent"<?php else: ?>name="activateEvent"<?php endif;?> class="btn btn-sm btn-outline-success me-2" id="<?php echo "active".$event['GameID']; ?>">
                                    <?php if($event["IsActive"]):?>Disattiva<?php else: ?>Attiva<?php endif; ?>
                                </button>
                                
                                <label for="<?php echo "delete".$event['GameID']; ?>" hidden></label>
                                <button type="submit" name="deleteEvent" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sei sicuro di voler eliminare questo evento? L\'azione è irreversibile e le risposte associate verranno rese anonime.');" id="<?php echo "delete".$event['GameID']; ?>">
                                    Elimina
                                </button>
                            
                            </form>
                        </div>
                    </a>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>



    </div>
</div>