<?php
/**
 *   In this class will be En aquesta classe estaràn els atributs i funcions del client
 *   per tal d'emmagatzemar les seves dades en el sistema i oferir-lu una millor experiencia en ell
 *
 *   @name Equip3-Cataleg i Procés de Venta
 *   @since 02-10-2023
 *   @version 1.0
 */
class Customer {
    private int $customerId;
    private string $lastName;
    private string $userName;
    private string $type;
    private string $bussinesName;
    private string $customerName;
    private string $customerPhone;
    private string $email;
    private string $dni;
    private string $address;
    private int $creditCard;
    private $pdo; // PDO Conection

    //constructor
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Method that generate a random DNI
     * @return string a valid DNI
     */
    public function createDNI() {
        return $this->randNumber() . $this->randLetter();
    }

    /** Method to create a new customer */
    public function createCustomer($name, $phone, $email, $dni, $address, $creditCard) {
        $sql = "INSERT INTO customers (customerName, customerPhone, email, dni, address, creditCard) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $phone, $email, $dni, $address, $creditCard]);
        $this->customerId = $this->pdo->lastInsertId();
    }

    /** Method to obtain a customer by her/him ID */
    public static function getCustomerById(PDO $pdo, $customerId) {
        $sql = "SELECT * FROM customers WHERE customerId = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$customerId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $customer = new Customer($pdo);
            $customer->customerId = $data['customerId'];
            $customer->customerName = $data['customerName'];
            $customer->customerPhone = $data['customerPhone'];
            $customer->email = $data['email'];
            $customer->dni = $data['dni'];
            $customer->address = $data['address'];
            $customer->creditCard = $data['creditCard'];
            return $customer;
        } else {
            return null;
        }
    }

    /** Method to update a customer information */
    public function updateCustomer(string $name,string $phone,string $email,string $address,string $creditCard) {
        $sql = "UPDATE customers SET customerName = ?, customerPhone = ?, email = ?, address = ?, creditCard = ? WHERE customerId = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $phone, $email, $address, $creditCard, $this->customerId]);
    }

    public function deleteCustomer() {
        $sql = "DELETE FROM customers WHERE customerId = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->customerId]);
        /** Reset the attributes */
        $this->customerId = null;
        $this->customerName = null;
        $this->customerPhone = null;
        $this->email = null;
        $this->dni = null;
        $this->address = null;
        $this->creditCard = null;
    }

    /**
     * Mètode que genera un Nom per al client aleatori
     * @return string el nom del usuari
     */
    public function getName(): string {
        return $this->customerName;
    }

    /**
     * @return mixed
     */
    public function getCustomerId():int
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId(int $customerId)
    {
        $this->customerId = $customerId;
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
     * @return mixed
     */
    public function getLastName():string
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Mètode que retorna el DNI del client
     * @return string el DNI del client
     */
    public function getDNI(): string {
        return $this->dni;
    }

    /**
     * @return mixed
     */
    public function getUserName():string
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getBussinesName():string
    {
        return $this->bussinesName;
    }

    /**
     * @param mixed $bussinesName
     */
    public function setBussinesName(string $bussinesName)
    {
        $this->bussinesName = $bussinesName;
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

    public function setName(string $name){
        $this->customerName = $name;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setPhone(string $phone){
        $this->customerPhone = $phone;
    }
    public function setCard(string $card){
        $this->creditCard = $card;
    }

    public function setDni(string $dni){
        $this->dni = $dni;
    }

    public function setAddress(string $address){
        $this->address = $address;
    }

}
?>