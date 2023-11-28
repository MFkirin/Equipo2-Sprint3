<?php
    /**
    *   En aquesta classe estaràn els atributs i funcions del client 
    *   per tal d'emmagatzemar les seves dades en el sistema i oferir-lu una millor experiencia en ell
    *   
    *   @name Equip3-Cataleg i Procés de Venta
    *   @since 02-10-2023
    *   @version 1.0
    */
    class Vehicle {
        private string  $matricula; 
        private int     $id;
        private string  $color;
        private string  $danys;
        private string  $model;
        private string  $carburant;
        private int    $km;
        private string  $marca;
        private string  $descripcio;
        private float   $iva;
        private string  $n_bast;
        private string  $canvi_m;
        private int    $preu_venta;
        private int    $preu_compra;
        private string    $nou_ocasio;
        private string  $imatge; 

        //Constructor
        public function __construct(string $marca, string $model, string $image, string $matricula){
                $this->matricula = $matricula;
                $this->marca = $marca;
                $this->model = $model;
                $this->preu_venta = rand(100000,2000000);
                $this->imatge = $image;
        }
        
        /**
        * Mètode que genera una matrícula en el seu format corresponent
        */
        static function generaMatricula(): string {
            $lletres = chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90));
            return rand(0000,9999).$lletres;
        }

        
        /**
        * Mètode que retorna una imatge aleatoria del array d'imatges
        */
        static function generaImatge($imatges): string {
            return $imatges[array_rand($imatges)]; 
        }
        
        /**
        * Mètode que retorna una Marc aleatoria del array de marques
        */
        static function generaMarca($marques): string {
            return $marques[array_rand($marques)];
        }
        
        /**
        * Mètode que retorna el Model de manera aleatoria del array de Models
        */
        static function generaModel($models): string {
            return $models[array_rand($models)];           
        }
        
        /**
        * Mètode que retorna la matrícula del vehicle
        */
        public function getMatricula(): string {    
            return $this->matricula;
        }
        
        /**
        * Mètode que retorna la imatge del vehicle
        */
        public function getImatge() {    
            return $this->imatge;
        }
        
        /**
        * Mètode que retorna la marca del vehicle
        */
        public function getMarca() {    
            return $this->marca;
        }
        
        /**
        * Mètode que retorna el model del vehicle
        */
        public function getModel() {    
            return $this->model;
        }
        
        /**
        * Mètode que retorna el preu de la venta del vehicle
        */
        public function getPreuVenta() {    
            return $this->preu_venta;
        }
    }
?>
