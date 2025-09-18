<div class="col-10 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row justify-content-center">

        <h1 class="mb-4 display-6 fw-bold">VISUALIZZAZIONE RISPOSTE E CONSIGLI</h1>

        <button id="showAnswersBtn" class="btn btn-primary m-2 col-lg-5">Mostra tutte le risposte</button>
        <button id="showAdvicesBtn" class="btn btn-secondary m-2 col-lg-5">Mostra tutti i consigli</button>

        <div id="answersSection" class="mt-4" style="display:none;">
            <?php if (empty($templateParams["answers"])): ?> 
                <p class="alert alert-warning">Nessuna risposta registrata.</p>
            <?php else: ?>
                <?php foreach ($templateParams["answers"] as $answer): ?>
                        <div class="alert alert-info mb-2 d-flex align-items-center">
                            <img src="../<?php echo $answer["ImagePath"]; ?>" alt="Immagine risposta" class="me-3 rounded" style="width:60px; height:60px; object-fit:cover;">
                            <div>User choice: <strong><?php echo $answer["UserChoice"]; ?> </strong> -> <?php echo $answer["Motivation"]; ?> </div>
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
       