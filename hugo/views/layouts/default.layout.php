<!doctype html>
<html lang="ca">
<head>
    <title>Untitled page</title>
    <link href="/assets/css/global.css" rel="stylesheet"/>
    <link href="/assets/css/styles_login.css" rel="stylesheet"/>
    <link href="/assets/css/modal.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/node_modules/chart.js/dist/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modal.js"></script>
    <link href="/assets/css/grafica.css" rel="stylesheet"/>

    <meta charset="utf-8"/>
</head>
<body>
<header>
    <h1>Pàgina principal</h1>
    <nav>
        <ul>
            <li>
                <a href="/">Pàgina principal</a>
            </li>
            <li>
                <a href="/login_list.php">Veure inicis de sessió</a>
            </li>

            <li>
                <a href="/login.php">Iniciar sessió</a>
            </li>
            <li>
                <a href="/logout.php">Tancar sessió</a>
            </li>
            <li>
                <a href="/registre.php">Registrar</a>
            </li>
        </ul>
    </nav>
</header>
<main>
    <?= $content ?>
</main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="logo-footer">
                    <img src="/assets/img/logoBHEC.png" class="img-logo-footer">
                    <p>BHEC</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-footer">
                    <ul>
                        <li>
                            <a href="#FAQ">FAQ</a>
                        </li>
                        <li>
                            <p>|</p>
                        </li>
                        <li>
                            <a href="#condicions">Condicions</a>
                        </li>
                        <li>
                            <p>|</p>
                        </li>
                        <li>
                            <a href="#politica">Politica de privacidad</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>
<script src="/assets/js/jQuery.js"></script>
</body>
</html>