<?php

class Usuario
{
    public $nombre;
    public $email;
    public $CIF;

    public function __construct($nombre, $email, $CIF)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->CIF = $CIF;
    }

    public function mostrarInfo()
    {
        echo "Información del proveedor<br>";
        echo "Nombre: " . htmlspecialchars($this->nombre) . "<br>";
        echo "Correo electrónico: " . htmlspecialchars($this->email) . "<br>";
        echo "CIF: " . htmlspecialchars($this->CIF) . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $CIF = $_POST["CIF"];

    $usuario = new Usuario($nombre, $email, $CIF);

    $usuario->mostrarInfo();
}
?>
