
<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php
            include_once "./components/cp_intro_login.php";
        ?>
        <div class="row">
            <h1>Introduz os teus dados</h1>
            <!-- Formulário de login -->
            <!-- Envia os dados para sc_login.php atrvés do post -->
            <form class="col-6" action="./scripts/sc_login.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Login:</label>
                    <input type="text" class="form-control" id="login" placeholder="Enter login" name="login" required="">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required="">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>