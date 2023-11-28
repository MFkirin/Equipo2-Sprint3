<?php
    /**
    *   En aquesta classe estaràn els atributs i funcions del client 
    *   per tal d'emmagatzemar les seves dades en el sistema i oferir-lu una millor experiencia en ell
    *   
    *   @name Equip3-Cataleg i Procés de Venta
    *   @since 02-10-2023
    *   @version 1.0
    */
    class Client {

        private int $id;
        private string $name;
        private array $nomClient;
        private array $nomUsuari;
        private array $email;
        private string $dni;
        private array $direccio;
        private string $targeta;

        //constructor
        public function __construct() {
            $this->nomClient=["Pedro","Manolo","Pepito","Juan","Antonio","Luís"];
            $this->nomUsuari=["Tron","Machupichu","Pepinillo","Slash","Slim","Alfalfa"];
            $this->email=["a@gmail.com","b@gmail.com","c@gmail.com","d@gmail.com","d@gmail.com","e@gmail.com"];
            $this->dni= $this->generarDNI();
            $this->direccio=["La Vega","Fontanejos","Alcala","Puerta del Sol","Les Fonts","Brooklin"];
            $this->targeta=rand(000000000000,999999999999);
        }

        /**
        * Mètode que genera un DNI aleatori
        * @return retorna un DNI complet  
        */
        public function generarDNI() {
            return $this->randNums(8) . $this->randLetter(1);
        }

        /**
        * Mètode que genera un Nom per al client aleatori
        * @return retorna el nom del usuari  
        */
        public function generarNom(): string {
            return $this->nomClient[array_rand($this->nomClient)];
        }

        /**
        * Mètode que genera un nom d'usuari aleatori
        * @return retorna el nom d'usuari del client 
        */
        public function generarUsuari(): string {
            return $this->nomUsuari[array_rand($this->nomUsuari)];
        }

        /**
        * Mètode que genera el email del client de manera aleatoria
        * @return retorna el email del client 
        */
        public function generarEmail(): string {
            return $this->email[array_rand($this->email)];
        }

        /**
        * Mètode que retorna el DNI del client
        * @return retorna el DNI del client 
        */
        public function getDNI(): string {
            return $this->dni;
        }

        /**
        * Mètode que retorna la direcció del client
        * @return retorna la direcció del client 
        */
        public function generarDireccio(): string {
            return $this->direccio[array_rand($this->direccio)];
        }

        /**
        * Mètode que retorna la tagrgeta del client
        * @return retorna la targeta del client 
        */
        public function generarTargeta(): string {
            return $this->targeta;
        }

        /**
        * Mètode que genera 9 números aleatoris per a formar el DNI del client
        * @return retorna 9 número en tipo de string 
        */
        public function randNums($i): string {
            return rand(00000000,99999999);
        }

        /**
        * Mètode que genera 1 lletra aleatoria que correspondrà al DNI
        * @return retorna 1 lletra en majúscula aleatoria de la A-Z 
        */
        public function randLetter($i): string {
            $lletres = chr(rand(65,90));
            return $lletres;
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function setName(string $name): void
        {
            $this->name = $name;
        }


    }

?>
