<?php

/**
 * Clase Empleado representa a un empleado en el sistema.
 */
class Empleado {
    public int $id;                 // ID único del empleado.
    public string $nombre;                // Nombre del empleado.
    public string $apellido;              // Apellido del empleado.
    public string $tipo;                  // Tipo de empleado.
    public string $contrasena;            // Contraseña del empleado.
    protected string $errorMensaje = "La propiedad '%s' no existe en la clase %s.";

    /**
     * Constructor de la clase Empleado.
     *
     * @param int $id El ID único del empleado.
     * @param string $nombre El nombre del empleado.
     * @param string $apellido El apellido del empleado.
     * @param string $tipo El tipo de empleado.
     * @param string $contrasena La contraseña del empleado.
     */
    public function __construct(int $id, string $nombre, string $apellido, string $tipo, string $contrasena) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipo = $tipo;
        $this->contrasena = $contrasena;
    }

    /**
     * Obtiene el valor de una propiedad del empleado.
     *
     * @param string $propiedad El nombre de la propiedad a obtener.
     * @return mixed El valor de la propiedad especificada.
     * @throws InvalidArgumentException Si la propiedad no existe en la clase.
     */
    public function obtener($propiedad) {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        throw new InvalidArgumentException(sprintf($this->errorMensaje, $propiedad, get_class($this)));
    }

    /**
     * Establece el valor de una propiedad del empleado.
     *
     * @param string $propiedad El nombre de la propiedad a establecer.
     * @param mixed $valor El valor que se asignará a la propiedad.
     * @throws InvalidArgumentException Si la propiedad no existe en la clase.
     */
    public function establecer($propiedad, $valor) {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        } else {
            throw new InvalidArgumentException(sprintf($this->errorMensaje, $propiedad, get_class($this)));
        }
    }
}