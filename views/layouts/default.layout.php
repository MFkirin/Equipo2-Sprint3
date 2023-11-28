<!doctype html>
<html lang="ca">
<head>
    <title>Untitled page</title>
    <link href="/assets/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/grid.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/main.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js" integrity="sha512-mWSVYmb/NacNAK7kGkdlVNE4OZbJsSUw8LiJSgGOxkb4chglRnVfqrukfVd9Q2EOWxFp4NfbqE3nDQMxszCCvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta charset="utf-8"/>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="headerDiv">
                    <nav id="menu-mobile">
                        <div id="burger">
                            <span class="line1"></span>
                            <span class="line2"></span>
                            <span class="line3"></span>
                        </div>
                        <div class="ocultMenu">
                            <a href="/" class="linksHamburger">Pàgina principal</a>
                            <a href="provider_list.php" class="linksHamburger">Veure inicis de sessió</a>
                            <a href="provider_create.php" class="linksHamburger">Crear nou inici de sessió</a>
                            <a href="provider_create.php" class="linksHamburger">Iniciar sessió</a>
                            <a href="logout.php" class="linksHamburger">Tancar sessió</a>
                        </div>
                    </nav>
                    <div id="logoAndNav">
                        <img src="/assets/img/logo.png" alt="Logo">
                    </div>
                    <nav id="menu-desktop" class="navIcons">
                        <img src="/assets/img/usuari-GrocOscur.png" alt="user">
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container-fluid main">
        <div class="row">
            <div class="col-2 menu-lat">
                <aside>
                    <ul>
                        <li><a href="/">Pàgina principal</a></li>
                        <li><a href="provider_list.php">Veure Proveïdors</a></li>
                        <li><a href="provider_create.php">Crear nou Proveïdor</a></li>
                        <li><a href="provider_create.php">Iniciar sessió</a></li>
                        <li><a href="logout.php">Tancar sessió</a></li>
                    </ul>
                </aside>
            </div>
                <div id="principal" class="col-10 main">
                    <?= $content ?>
                </div>
</main>
</body>
    <script src="/assets/js/jqueryCRUD.js"></script>
    <script src="/assets/js/form_proveedores.js"></script>
    <script src="/assets/js/listProviders.js"></script>
    <script>
        let burger = document.getElementById('burger');
        burger.addEventListener('click',function(){
            burger.classList.toggle('active');
            let ocultMenu = document.querySelector('.ocultMenu');
            ocultMenu.classList.toggle('displayHambMenu');
        });
</script>
</html>