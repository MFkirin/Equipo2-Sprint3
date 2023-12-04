<html lang="en">
<head>
    <title>Sale</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>
<body>
<?php
    class nameException extends Exception {
    public function __toString() {
        return 'Empty name field'.$this->getMessage();
    }
}

    require 'Customer.php';

    $servername = "localhost";
    $username = "root";
    /**$password = "secret";*/

    try {
    $conn = new PDO("mysql:host=$servername;dbname=db_proyecto;",$username/**, $password*/);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $customer = new Customer($conn);
        $errors = [];

        $customer->setCustomerId(1);
        $customer->setType('Particular');
        $customer->setLastName('Briones');
        $customer->setBussinesName('Futbolista');

        try{
            emptyName();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }

        if (!empty($_POST['customerName'])) {
            $customer->setName($_POST['customerName'] ?? 'Invalid Name');
        }
        else{
            $errors = "Name invalid";
        }

        if (!empty($_POST['email'])){
            $customer->setEmail($_POST['email']??'Invalid email');
        }else{
            $errors = "Email invalid";
            echo "<p>Invalid format for Email</p>";
        }

        if (!empty($_POST['dni'])) {
            $customer->setDni($_POST['dni'] ?? 'Invalid Dni');
        }else{
            $errors = "DNI invalid";
            echo "<p>Invalid format for DNI</p>";
        }

        if (!empty($_POST['phone'])) {
            $customer->setPhone($_POST['phone'] ?? 'Invalid Phone');
        }else{
            $errors = "Phone invalid";
            echo "<p>Invalid format for Phone</p>";
        }

        if (!empty($_POST['address'])) {
            $customer->setAddress($_POST['address'] ?? 'Invalid Address');
        }else{
            $errors = "Address invalid";
            echo "<p>Invalid format for Address</p>";
        }


    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    try {
        if(empty($errors)){
            $conn->beginTransaction();
            $insertQuery = "INSERT INTO client (type_user,name, last_name, address, dni, phone, bussines_name, email) 
            VALUES (:type_user, :name, :last_name, :user_address, :dni, :phone, :bussines_name, :email)";
            $stmt = $conn->prepare($insertQuery);

            $stmt->bindValue('type_user',$customer->getType());
            $stmt->bindValue('name',$customer->getName());
            $stmt->bindValue('last_name',$customer->getLastName());
            $stmt->bindValue('user_address',$customer->getAddress());
            $stmt->bindValue('dni',$customer->getDNI());
            $stmt->bindValue('phone',$customer->getPhone());
            $stmt->bindValue('bussines_name', $customer->getBussinesName());
            $stmt->bindValue('email',$customer->getEmail());
        

        $stmt->execute();
        $conn->commit();
        echo "<h1>Information stored!</h1>";
        }
        else{
            echo "<h1>Invalid Information</h1>";
        }
    }catch (Exception $e){
        $conn->rollBack();
        echo "Connection failed: " . $e->getMessage();
    }

    function emptyName():bool{
        if (empty($_POST['customerName'])){
            throw new nameException('Empty Name field');
        }
        return false;
    }
?>
    <a href="formulariVenta.html">Home</a>
</body>
</html>