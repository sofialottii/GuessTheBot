<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row justify-content-center">

        <h1 class="mb-4 display-6 fw-bold">VISUALIZZAZIONE RISPOSTE E CONSIGLI</h1>

        <button id="showAnswersBtn" class="btn btn-primary m-2 col-lg-5">Mostra tutte le risposte</button>
        <button id="showAdvicesBtn" class="btn btn-secondary m-2 col-lg-5">Mostra tutti i consigli</button>


        <!-- PARTE DELLE MOTIVAZIONI -->

        <div id="answersSection" class="mt-4" style="display:none;">
            <?php if (empty($templateParams["answers"])): ?> 
                <p class="alert alert-warning">Nessuna risposta registrata.</p>
            <?php else: ?>
                <h2 class="text-center mb-4">Dettaglio Risposte</h2>
                <?php foreach ($templateParams["answers"] as $answer): ?>
                    <div class="card mb-3 shadow-sm">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center p-3">
                                <img src="../<?php echo $answer["ImagePath"]; ?>" alt="<?php echo $answer["Title"]; ?>" class="img-fluid rounded" style="max-width: 100px;">
                            </div>
                            <div class="col-md-10 p-3">
                                <p class="h3 card-title <?php if ($answer["IsCorrect"] == 'Y'): ?>text-success<?php else: ?>text-danger<?php endif; ?>">
                                    Scelta: <strong><?php echo (ucfirst($answer["UserChoice"])); ?></strong></p>
                                <?php if ($answer["IsCorrect"] == 'N'): ?>
                                    <p class="card-text text-muted small">
                                        La risposta corretta era: <strong><?php echo $answer["TextShown"]; ?></strong>
                                    </p>
                                <?php endif; ?>
                                <blockquote class="blockquote mb-0">
                                        <p class="fs-6 fst-italic">"<?php echo $answer["Motivation"]; ?>"</p>
                                        <footer class="blockquote-footer mt-1">Motivazione dell'utente <?php echo $answer["Name"]; ?></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
        </div>

        <div id="advicesSection" class="mt-4" style="display:none;">
            <?php if (empty($templateParams["advices"])): ?> 
                <p class="alert alert-warning">Nessun consiglio registrato.</p>
            <?php else: ?>
                <?php foreach ($templateParams["adivces"] as $advice): ?>
                    <div class="alert alert-info mb-2 d-flex align-items-center">
                        <img src="../<?php echo $answer["ImagePath"]; ?>" alt="Immagine risposta" class="me-3 rounded" style="width:60px; height:60px; object-fit:cover;">
                        <div>Consiglio: <?php echo $answer["Motivation"]; ?> </div>
                    </div>
            <?php endforeach; endif; ?>
        </div>

        <script>
        document.getElementById('showAnswersBtn').addEventListener('click', function() {
            document.getElementById('answersSection').style.display = 'block';
            document.getElementById('advicesSection').style.display = 'none';
        });
        document.getElementById('showAdvicesBtn').addEventListener('click', function() {
            document.getElementById('advicesSection').style.display = 'block';
            document.getElementById('answersSection').style.display = 'none';
        });
        </script>

    </div>
</div>
       