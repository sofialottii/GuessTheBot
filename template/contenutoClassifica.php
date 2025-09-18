<div class="col-12 col-md-11 col-lg mb-4 card shadow-sm border-0">   
    <div class="card-body p-4 p-md-5 row">

        <div class="text-center mb-4">
            <h1 class="fw-bold text-uppercase">Classifica</h1>
            <p class="text-muted">Scopri i migliori giocatori di GuessTheBot!</p>
        </div>

        <?php if(empty($classifica)): ?>
            <p class="text-center">Nessun giocatore in classifica. Gioca una partita per essere il primo!</p>
        <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">Pos.</th>
                        <th scope="col">Nome Giocatore</th>
                        <th scope="col" class="text-center">Punteggio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($classifica as $index => $giocatore): ?>
                    <tr>
                        <td class="text-center fw-bold"><?php echo $index + 1; ?></td>
                        <td><?php echo $giocatore['Name']; ?></td>
                        <td class="text-center"><?php echo $giocatore['score']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>