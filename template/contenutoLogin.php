<div class="col-10 col-md-11 col-lg-10 mb-4 card shadow-sm border-0">
    <div class="card-body p-4 p-md-5 text-center row justify-content-center">

        <h1 class="mb-4">AREA RISERVATA</h1>
        <?php if(isset($templateParams["errorelogin"])): ?>
        <p class="text-danger"><?php echo $templateParams["errorelogin"]; ?></p>
        <?php endif; ?>

        <form action="#" method="POST" class="col-8" >
            <ul class="p-0 form list-unstyled">
                <li>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" autocomplete="on" />
                </li>
                <li class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="off" />
                </li>
                <li class="text-center mb-3">
                    <label for="accedi" class="form-label" hidden></label>
                    <input type="submit" name="accedi" id="accedi" value="Accedi" class="w-75" />
                </li>
                <li class="text-center mb-3">
                    <a href="index.php" class="bottone w-75" >Continua senza accedere</a>
                </li>
            </ul>
        </form>

    </div>
</div>
    