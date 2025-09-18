<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5 text-center row justify-content-center">

                    <button id="showAnswersBtn" class="btn btn-primary m-2 col-lg-5">Mostra tutte le risposte</button>
                    <button id="showAdvicesBtn" class="btn btn-secondary m-2 col-lg-5">Mostra tutti i consigli</button>

                    <div id="answersSection" class="mt-4" style="display:none;">
                        <?php if (empty($templateParmas["answers"])) {
                                echo '<p class="alert alert-warning">Nessuna risposta registrata.</p>';
                            } else {
                                foreach ($templateParmas["answers"] as $answer) {
                                    echo '<div class="alert alert-info mb-2">' . $answer . '</div>';
                                }
                            } 
                        ?>
                    </div>

                    <div id="advicesSection" class="mt-4" style="display:none;">
                        <?php if (empty($templateParams["advices"])) {
                                echo '<p class="alert alert-warning">Nessun consiglio registrato.</p>';
                            } else {
                                foreach ($templateParams["adivces"] as $advice) {
                                    echo '<div class="alert alert-warning mb-2">' . $advice . '</div>';
                                }
                            }
                        
                        ?>
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
        </div>
    </div>
</main>