<!doctype html>
<html lang="ca">
<head>
    <title>Untitled page</title>
    <link href="/assets/global.css" rel="stylesheet"/>
    <link href="/assets/styles_login.css" rel="stylesheet"/>
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
                <a href="/login_create.php">Iniciar sessió</a>
            </li>
            <li>
                <a href="/vehicle_list.php">Veure vehicles</a>
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
</body>
</html>