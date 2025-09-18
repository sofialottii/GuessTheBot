<div class="col-10 col-md-11 col-lg-8 mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">

        <h2 class="mb-3">Aggiungi una nuova infografica</h2>
        <form action="aggiungiInfografica.php" method="POST" enctype="multipart/form-data">
            <ul class="p-0 form list-unstyled">
                <li class="mb-3">
                    <label for="immagine" class="form-label">Immagine</label><input type="file" id="immagine" name="immagine" class="form-control" required />
                </li>
                <li class="mb-3">
                    <label for="nome" class="form-label">Nome infografica</label><input type="text" id="nome" name="nome" class="form-control" autocomplete="off" required />
                </li>
                <li class="mb-3">
                    <label for="humanText" class="form-label">Descrizione Umana</label><textarea id="humanText" name="humanText" class="form-control" autocomplete="off" required></textarea>
                </li>
                <li class="mb-3">
                    <label for="llmText" class="form-label">Descrizione AI</label><textarea id="llmText" name="llmText" class="form-control" autocomplete="off" required></textarea>
                </li>
                <li class="my-3">
                    <label for="aggiungi" class="form-label" hidden></label><input type="submit" name="aggiungi" id="aggiungi" value="Aggiungi" />
                </li>
                <li class="mb-3">
                    <a href="adminInfographics.php">Indietro</a>
                </li>
            
            </ul>
        </form>
    </div>   
</div>
