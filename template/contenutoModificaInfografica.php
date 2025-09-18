<div class="col-12 col-md-11 col-lg-8 mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h2 class="mb-3">Modifica infografica</h2>
        <form method="POST" action="#">
            <ul class="p-0 form list-unstyled">
                <li class="mb-3">
                    <p class="mb-1"><strong>Immagine Attuale:</strong></p>
                    <img src="../<?php echo $templateParams["infografica"]["ImagePath"]; ?>" alt="Immagine attuale" class="img-fluid rounded">
                </li>
                <li class="mb-3">
                    <label for="immagine" class="form-label">Sostituisci immagine (lascia vuoto per non cambiare)</label>
                    <input type="file" id="immagine" name="immagine" class="form-control" />
                    <input type="hidden" name="immagine_esistente" value="<?php echo $templateParams["infografica"]["ImagePath"]; ?>">
                </li>
                <li class="mb-3">
                    <label for="nome" class="form-label">Nome infografica</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $templateParams["infografica"]["Title"]; ?>" required />
                </li>
                <li class="mb-3">
                    <label for="humanText" class="form-label">Descrizione Umana</label>
                    <textarea id="humanText" name="humanText" class="form-control" rows="4" required><?php echo $templateParams["infografica"]["HumanText"]; ?></textarea>
                </li>
                <li class="mb-3">
                    <label for="llmText" class="form-label">Descrizione AI</label>
                <textarea id="llmText" name="llmText" class="form-control" rows="4" required><?php echo $templateParams["infografica"]["LlmText"]; ?></textarea>
                </li>
                <li class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="adminInfographics.php" class="btn btn-secondary">Annulla</a>
                    <input type="submit" name="modifica" value="Salva Modifiche" class="btn btn-primary" />
                </li>
            </ul>
        </form>

    </div>
</div>