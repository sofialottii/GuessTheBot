<div class="col-10 col-md-11 col-lg mb-4">
    <div class="card shadow-sm border-0">

        <div class="card-body p-4 p-md-5 row">

            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-caratteristiche" data-tab="caratteristiche" href="#">Caratteristiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-statistiche" data-tab="statistiche" href="#">Statistiche</a>
                </li>
            </ul>

            <div class="col-12 col-lg-4 align-items-center justify-content-center mb-lg-0 my-3 text-center">
                <img id="infographic-image" src="../<?php echo $templateParams['infografica']['ImagePath']; ?>" class="img-fluid rounded shadow-sm" alt="Infografica" />
                <div id="result-message" class="alert mt-4" style="display: none;"></div>
                <a href="modificaInfographic.php?IDInfographic=<?php echo $templateParams['infografica']['InfographicID']; ?>" class="bottone col-10 text-center py-2">Modifica Infografica</a>
                <a href="adminInfographics.php" class="text-center">Indietro</a>
                    
            </div>

            <div class="col-12 col-lg-8 text-start">

                <!-- generale (vale per tutte e due le tab) -->

                <h2 class="mb-3 text-center text-lg-start"><?php echo $templateParams["infografica"]["Title"]; ?></h2>
                
                <hr>


                <!-- caratteristiche -->

                <div id="content-caratteristiche" class="tab-content">
                    <h3 class="h5 mt-4">Descrizione Umana</h3>
                    <p class="text-muted fst-italic">"<?php echo $templateParams["infografica"]["HumanText"]; ?>"</p>

                    <h3 class="h5 mt-4">Descrizione AI</h3>
                    <p class="text-muted fst-italic">"<?php echo $templateParams["infografica"]["LlmText"]; ?>"</p>
                </div>


                <!-- statistiche -->

                <div id="content-statistiche" class="tab-content" style="display: none;">
                    <h3 class="h5 mt-4">Statistiche di Gioco</h3>            
                    <ul class="list-group mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Numero di volte giocata
                            <span class="badge bg-primary rounded-pill"><?php echo $templateParams["infografica"]["TotalAnswers"]; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Numero di risposte corrette
                            <span class="badge bg-primary rounded-pill"><?php echo $templateParams["infografica"]["CorrectAnswers"]; ?></span>
                        </li>    
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Percentuale di risposte corrette
                            <span class="badge bg-primary rounded-pill"><?php echo number_format($templateParams["infografica"]["AccuracyPercentage"], 2, ',', '') ?>%</span>
                        </li>
                    </ul>

                    <h3 class="h5 mt-4 mb-3">Motivazioni e Consigli degli Utenti</h3>
                    <?php if(empty($templateParams["risposte"])): ?>
                        <p class="text-muted">Nessuna motivazione o consiglio testuale per questa infografica.</p>
                    <?php else: ?>

                
                        <ul class="list-group">
                            <?php foreach($templateParams["risposte"] as $risposta): ?>
                                <?php if(!empty($risposta["Motivation"]) || !empty($risposta["Advice"])): ?>
        
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
            
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold mb-2"><?php echo $risposta["Name"]; ?></div>
                                            
                                            <?php if(!empty($risposta["Motivation"])): ?>
                                                <p class="mb-2">Motivazione: "<?php echo $risposta["Motivation"]; ?>"</p>
                                            <?php endif; ?>

                                            <?php if(!empty($risposta["Advice"])): ?>
                                                <p >Consiglio: "<?php echo $risposta["Advice"]; ?>"</p>
                                            <?php endif; ?>
                                        </div>

                                        <?php 
                                            $isCorrect = ($risposta["IsCorrect"] == 'Y');
                                            $badgeClass = $isCorrect ? 'bg-success' : 'bg-danger';
                                            $feedbackText = $isCorrect ? 'Corretta' : 'Errata';
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?> rounded-pill p-2">
                                            Scelta: <?php echo $risposta["UserChoice"]; ?> (<?php echo $feedbackText; ?>)
                                        </span>

                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
                
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/dettaglioInfografica.js"></script>