<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $templateParams["titolo"]; ?></title>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css?v=467" />

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    </head>

    <body class="align-items-center bg-light">
        <header class="mb-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <div class="container-fluid">
                    
                    <a class="navbar-brand fw-bold" href="index.php">
                    🤖 GuessTheBot
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto p-0">
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($currentPage == 'classifica.php') ? 'active' : ''; ?>" href="classifica.php">Classifica</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($currentPage == 'regole.php') ? 'active' : ''; ?>" href="regole.php">Come si gioca</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        <!--main che per ora richiamo in ogni file-->
            <?php
            require($templateParams["nome"]);
            ?>
        <!-- fine main -->

        <footer class="footer mt-auto mt-4 py-3">
            <p class="text-center">
                © 2025 GuessTheBot.<br/>
                Progetto di Tesi, Irene Sofia Lotti.
            </p>
        </footer>


    </body>
</html>