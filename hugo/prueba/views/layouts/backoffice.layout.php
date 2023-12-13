<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llista de factures</title>
    <link href="/assets/css/Normalize.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/grid.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/backoffice-skeleton.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/styles_order.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/modal.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/content-back.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/vehicle_list.css" type="text/css" rel="stylesheet">

    <!-- JavaScript -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" defer></script>
    <script src="/assets/js/modal.js" defer></script>
    <script src="/assets/js/searcher.js" defer></script>
    <script src="/assets/js/menu_aside.js" defer></script>
    <script src="/assets/js/menu-burguer.js" defer></script>
</head>

<body>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="headerDiv">
                    <a href="/"><div id="logoAndNav">
                        <img src="/assets/img/logoBHEC.png" alt="Logo">
                    </div></a>
                    <nav id="menu-desktop" class="navIcons">
                        <a href="#"><img src="/assets/img/icones/usuari-Groc.png" alt="user" class="icon"
                                         id="usuari"></a>
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
                                    <li><a href="#"><i class="fas fa-home"></i> Inici</a></li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-file-invoice"></i> Factures <i
                                                    class="fas fa-chevron-right"></i></a>
                                        <ul class="submenu-content">
                                            <li><a href="/invoice_create.php">Crear Factura</a></li>
                                            <li><a href="/invoice_list.php">Visualitzar Factures</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-users"></i> Clients <i
                                                    class="fas fa-chevron-right"></i></a>
                                        <ul class="submenu-content">
                                            <li><a href="#">Alta de Client</a></li>
                                            <li><a href="#">Visualitzar Clients</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-shopping-cart"></i> Comandes <i
                                                    class="fas fa-chevron-right"></i></a>
                                        <ul class="submenu-content">
                                            <li><a href="/order_update.php">Crear Comanda</a></li>
                                            <li><a href="/order_list.php">Visualitzar Comandes</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-user-tie"></i> Empleats <i
                                                    class="fas fa-chevron-right"></i></a>
                                        <ul class="submenu-content">
                                            <li><a href="#">Alta d'Empleat</a></li>
                                            <li><a href="#">Visualitzar Empleats</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-truck"></i> Proveïdors <i
                                                    class="fas fa-chevron-right"></i></a>
                                        <ul class="submenu-content">
                                            <li><a href="/provider_create.php">Alta Proveïdor</a></li>
                                            <li><a href="/provider_list.php">Visualitzar Proveïdors</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-car"></i> Vehicles <i
                                                    class="fas fa-chevron-right"></i></a>
                                        <ul class="submenu-content">
                                            <li><a href="#">Alta Vehicle</a></li>
                                            <li><a href="#">Visualitzar Vehicles</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="container-fluid">
    <div class="row">
        <aside class="col-2 aside">
            <nav id="main-menu">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Inici</a></li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-file-invoice"></i> Factures <i
                                    class="fas fa-chevron-right"></i></a>
                        <ul class="submenu-content">
                            <li><a href="/invoice_create.php">Crear Factura</a></li>
                            <li><a href="/invoice_list.php">Visualitzar Factures</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-users"></i> Clients <i class="fas fa-chevron-right"></i></a>
                        <ul class="submenu-content">
                            <li><a href="#">Alta de Client</a></li>
                            <li><a href="#">Visualitzar Clients</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-user-tie"></i> Empleats <i
                                    class="fas fa-chevron-right"></i></a>
                        <ul class="submenu-content">
                            <li><a href="#">Alta d'Empleat</a></li>
                            <li><a href="#">Visualitzar Empleats</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-truck"></i> Proveïdors <i class="fas fa-chevron-right"></i></a>
                        <ul class="submenu-content">
                            <li><a href="#">Alta Proveïdor</a></li>
                            <li><a href="/provider_list.php">Visualitzar Proveïdors</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-shopping-cart"></i> Comandes <i
                                    class="fas fa-chevron-right"></i></a>
                        <ul class="submenu-content">
                            <li><a href="/order_update.php">Crear Comanda</a></li>
                            <li><a href="/order_list.php">Visualitzar Comandes</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-car"></i> Vehicles <i class="fas fa-chevron-right"></i></a>
                        <ul class="submenu-content">
                            <li><a href="/vehicle_create.php">Alta Vehicle</a></li>
                            <li><a href="/vehicle_list.php">Visualitzar Vehicles</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>
        <article class="col-10">
            <?= $content ?>
        </article>
    </div>
</main>

<section id="menu-modal" class="menu-modal">
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
</section>

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="logoAndName">
                    <img src="/assets/img/logoBHEC.png" alt="logo">
                    <h2 class="h2-title">BHEC</h2>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>

</html>
