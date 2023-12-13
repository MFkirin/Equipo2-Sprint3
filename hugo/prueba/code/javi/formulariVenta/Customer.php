<?php
/**
 *   En aquesta classe estaràn els atributs i funcions del client
 *   per tal d'emmagatzemar les seves dades en el sistema i oferir-lu una millor experiencia en ell
 *
 *   @name Equip3-Cataleg i Procés de Venta
 *   @since 02-10-2023
 *   @version 1.0
 */
class Customer {
    private $customerName;
    private $customerPhone;
    private $email;
    private $dni;
    private $address;
    private $creditCard;

    //constructor
    public function __construct() {

    }

    /**
     * Mètode que genera un DNI aleatori
     * @return string un DNI complet
     */
    public function createDNI() {
        return $this->randNumber() . $this->randLetter();
    }

    /**
     * Mètode que genera un Nom per al client aleatori
     * @return string el nom del usuari
     */
    public function getName(): string {
        return $this->customerName;
    }

    /**
     * Mètode que genera un nom d'usuari aleatori
     * @return string el nom d'usuari del client
     */
    public function getPhone(): string {
        return $this->customerPhone;
    }

    /**
     * Mètode que genera el email del client de manera aleatoria
     * @return string el email del client
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Mètode que retorna el DNI del client
     * @return string el DNI del client
     */
    public function getDNI(): string {
        return $this->dni;
    }

    public function getAddress(): string {
        return $this->address;
    }

    /**
     * Mètode que retorna la tagrgeta del client
     * @return string la targeta del client
     */
    public function getCard(): string {
        return $this->creditCard;
    }

    /**
     * Mètode que genera 9 números aleatoris per a formar el DNI del client
     * @return string 9 número en tipo de string
     */
    public function randNumber(): string{
        return rand(00000000,99999999);
    }

    public function setName($name){
        $this->customerName = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPhone($phone){
        $this->customerPhone = $phone;
    }
    public function setCard($card){
        $this->creditCard = $card;
    }

    public function setDni($dni){
        $this->dni = $dni;
    }

    public function setAddress($address){
        $this->address = $address;
    }

}
?>