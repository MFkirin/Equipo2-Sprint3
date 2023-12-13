<html lang="en">
<head>
    <title>Sale</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>
<body>
<?php
    require 'Customer.php';
    $customer = new Customer();


    $names = ["Javier Ramos","javier ramos","kiko rivera","Kiko Rivera"];
    $email = ["jara@gmail.com","kiko@gmail.com","Kiko@gmail.com","jara@gmail.com"];
    $dni = ["12345678X","87654321A","13572468B","192837465C"];
    $phone = ["333333333","111111111","222222222","444444444"];
    $address = ["ca salva","cal nay","ca robert","ca gerard"];

    for ($i = 0;$i<sizeof($names);$i++) {
        if (!empty($_POST['customerName'])) {
            if ($names[$i] = $_POST['customerName']) {
                $customer->setName($_POST['customerName'] ?? 'Invalid Name');
            }
            else{
                echo "<p>Name not found in the database</p>";
            }
        }
    }
    for ($i = 0;$i<sizeof($email);$i++) {
        if (!empty($_POST['email'])){
            if ($email[$i] = $_POST['email']) {
                $customer->setEmail($_POST['email']??'Invalid email');
            }else{
                echo "<p>Email not found in the database</p>";
            }
        }
    }
    for ($i = 0;$i<sizeof($dni);$i++) {
        if (!empty($_POST['dni'])) {
            if ($dni[$i] = $_POST['dni']) {
                $customer->setDni($_POST['dni'] ?? 'Invalid Dni');
            }else{
                echo "<p>Dni not found in the database</p>";
            }
        }
    }
    for ($i = 0;$i<sizeof($phone);$i++) {
        if (!empty($_POST['phone'])) {
            if ($phone[$i] = $_POST['phone']) {
                $customer->setPhone($_POST['phone'] ?? 'Invalid Phone');
            }else{
                echo "<p>Phone not found in the database</p>";
            }
        }
    }
    for ($i = 0;$i<sizeof($address);$i++) {
        if (!empty($_POST['address'])) {
            if ($address[$i] = $_POST['address']) {
                $customer->setAddress($_POST['address'] ?? 'Invalid Address');
            }else{
                echo "<p>Address not found in the database</p>";
            }
        }
    }
?>
    <h1>Information</h1>
    <table>
        <tr>
            <th>Name</th>
            <?php if (!empty($_POST['customerName'])) {
                echo "<td>" . $customer->getName() . "</td>";
            }
            ?>
        </tr>
        <tr>
            <th>Email</th>
            <?php if (!empty($_POST['email'])) {
                echo "<td>" . $customer->getEmail() . "</td>";
            }
            ?>
        </tr>
        <tr>
            <th>Phone</th>
            <?php if (!empty($_POST['phone'])) {
                echo "<td>" . $customer->getPhone() . "</td>";
            }
            ?>
        </tr>
        <tr>
            <th>Dni</th>
            <?php if (!empty($_POST['dni'])) {
                echo "<td>" . $customer->getDNI() . "</td>";
            }
            ?>
        </tr>
        <tr>
            <th>Address</th>
            <?php if (!empty($_POST['address'])) {
                echo "<td>" . $customer->getAddress() . "</td>";
            }
            ?>
        </tr>
    </table>
    <a href="formulariVenta.html">Home</a>
</body>
</html>