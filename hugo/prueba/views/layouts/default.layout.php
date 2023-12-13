<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
    <link type="text/css" rel="stylesheet" href="/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/grid.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/frontoffice-skeleton.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/content.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/modal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="/assets/js/validacioCarret.js" defer></script>
    <script src="/assets/js/modal.js" defer></script>
    <script src="/assets/js/menu-burguer.js" defer></script>
    <script src="/assets/js/front-searcher.js" defer></script>
    <script src="/assets/js/showHidePwd.js" defer></script>

</head>

<body>
<header class="container-fluid">
    <div class="row navegador-header">
        <div class="col-12">
            <nav class="primer-nav">
                <img src="/assets/img/logoBHEC.png" width="50px">

                <ul class="hidden">
                    <li>
                        <a href="#">Catàleg</a>
                    </li>
                    <li>
                        <a href="#">Contacte</a>
                    </li>
                </ul>
            </nav>

            <div class="barra-busqueda-header hidden">
                <div>
                    <input type="text" class="input-busqueda-header" placeholder="Buscar...">
                    <button class="boto-busqueda-header"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <nav class="navegador-icones-header">
                <ul>
                    <li class="hidden-desktop">
                        <a href="#">
                            <img src="/assets/ico/busqueda-Groc.png" alt="Imatge Notificació" id="busqueda">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/assets/ico/notificacio-Groc.png" alt="Imatge Notificació" id="notificacio">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/assets/ico/llistaDeDesitjos-Groc.png" alt="Imatge Llista De Dessitjos" id="desitjos">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/assets/ico/garatge-Groc.png" alt="Imatge Garatge" id="garatge">
                        </a>
                    </li>
                    <li>
                        <a>
                            <img src="/assets/ico/usuari-Groc.png" alt="Imatge Usuari" id="usuari">
                        </a>
                    </li>
                </ul>
            </nav>

            <nav id="menu-mobile">
                <div id="burger">
                    <span class="line1"></span>
                    <span class="line2"></span>
                    <span class="line3"></span>
                </div>
                <div class="ocultMenu">
                    <nav id="main-menu">
                        <ul>
                            <li>
                                <a href="#">
                                    Catàleg
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Contacte
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
    </div>
</header>

<main class="container-fluid">
    <section class="row">
        <?= $content ?>
    </section>
</main>

<div id="menu-modal" class="menu-modal">
    <div class="menu-content">
        <a href="#" class="close-button" onclick="closeMenuModal()">&times;</a>
        <div class="user-info">
            <img src="/assets/img/usuari.png" alt="Imagen de perfil">
            <div class="user-details">
                <h3>Tu Nombre</h3>
                <p>correo@example.com</p>
            </div>
        </div>
        <ul class="menu-links">
            <li class="dropdown">
                <a href="#">Mis pedidos</a>
            <li><a href="#">Novetats</a></li>
            </li>
            <li class="dropdown">
                <a href="#" id="administration-menu-btn">Administració</a>
                <ul class="dropdown-content" id="administration-menu">
                    <li><a href="#">Configuració del compter</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </li>
            <li><a href="/order_list.php" id="administration-menu-btn">Comandes</a></li>
        </ul>
    </div>

    <div id="banda-amb-logo">
        <div id="rectangle-blau">
            <p id="titol-rectangle">BHEC</p>
            <div id="cercle-gris">
                <img src="/assets/img/logoBHEC.png" alt="Imagen del semicírculo">
            </div>
        </div>
    </div>

    <div id="div-sessio">
        <ul>
            <li id="tancar-sessio"><a href="/logout.php">Tancar Sessió</a></li>
        </ul>
    </div>
</div>

<footer class="container-fluid">
    <div class="row">
        <div class="col-12 nom-logo">
            <img src="/assets/img/logoBHEC.png" alt="Logotip Empresa" width="50px">
            <h3>BHEC</h3>
        </div>
        <hr class="separator" />
    </div>

    <div class="row">
        <nav class="col-12">
            <ul>
                <li>
                    <a href="#">FAQ</a>
                </li>
                <li>
                    <a href="#">Terms & Conditions</a>
                </li>
                <li>
                    <a href="#">Privacy Policy</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>
</body>

</html>