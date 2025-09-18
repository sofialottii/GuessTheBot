<div class="col-12 col-md-11 col-lg mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row">
        <h1 class="mb-4">GESTISCI INFOGRAFICHE</h1>

        <div class="container">
            <div class="row g-4">
                <?php foreach($templateParams["infographics"] as $infographic): ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <form action="modificaInfographic.php" method="GET">
                        <label for="info<?php echo $infographic['InfographicID']; ?>" class="d-none">id</label>
                        <input type="number" class="d-none" name="IDInfographic" id="info<?php echo $infographic['InfographicID']; ?>" value="<?php echo $infographic['InfographicID']; ?>" />
            
                        <article id="info_<?php echo $infographic['InfographicID']; ?>" class="cliccabile click temporaneo">
                
                            <section>
                                <img src="../<?php echo $infographic['ImagePath'];?>" alt="<?php echo $infographic["Title"]; ?>" />
                            </section>
                        </article>
                        <label for="bottoneSubmit<?php echo $infographic['InfographicID'] ?>" hidden>submit</label>
                        <input type="submit" id="bottoneSubmit<?php echo $infographic['InfographicID'] ?>" name="bt" value="bt" class="d-none" />
                    </form>
                </div>
                <script>
                    //passo all'infografica specifica
                    document.querySelectorAll(".cliccabile").forEach(article => {
                        article.addEventListener("click", function () {

                            this.closest("form").submit(); //cerco il form più vicino e lo invio
                        });
                    });
                </script>
                <?php endforeach; ?>


                <!--aggiunta di infografica -->
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="aggiungiInfografica.php">
                        <article class="click temporaneo border border-0">
                            <section class="text-center my-4">
                                <img src="../assets/images/aggiungi.png" alt="aggiungi" />
                            </section>
                            <footer>
                                <p class="fs-3 fw-bold text-center text-dark">Nuova infografica</p>
                            </footer>
                        </article>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
        

<script src="../assets/js/hoverSection.js"></script>
