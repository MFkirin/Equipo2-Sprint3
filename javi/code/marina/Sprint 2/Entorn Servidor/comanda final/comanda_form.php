<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $surname = $_POST["surname"] ?? "";
    $id = $_POST["id"] ?? 0;
    $plate = $_POST["plate"] ?? -1;
    $invoice = $_POST["invoice"] ?? -1;
    $num_vehicles = $_POST["num_vehicles"] ?? 0;
    $state = $_POST["state"] ?? "";

    require 'Comanda.php';

    // Control d'errors
    $errors = [];

    //VALIDACIÓ
    $error = Comanda::validateID($id);
    if (!empty($error)) {
        $errors[] = $error;
    }

    $error = Comanda::validateName($name);
    if (!empty($error)) {
        $errors[] = $error;
    }

    $error = Comanda::validateSurname($surname);
    if (!empty($error)) {
        $errors[] = $error;
    }

    $error = Comanda::validateNumberVehicles($num_vehicles);
    if (!empty($error)) {
        $errors[] = $error;
    }

    $error = Comanda::validateNumberPlate($plate);
    if (!empty($error)) {
        $errors[] = $error;
    }

    $error = Comanda::validateState($state);
    if (!empty($error)) {
        $errors[] = $error;
    }

    $error = Comanda::validateInvoice($invoice);
    if (!empty($error)) {
        $errors[] = $error;
    }

    // SI PASSA LA VALIDACIÓ -> GUARDE EN BASE DE DADES
    /**
     * @param $id
     * @param $num_vehicles
     * @param $state
     * @param $invoice
     * @param $errors
     * @return void
     */
    function insertar($id, $num_vehicles, $state, $invoice, &$errors)
    {
        if (empty($errors)) {
            try {
                $pdo = new PDO("mysql:host=mysql-server; dbname=db_proyecto", "root", "secret");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("INSERT INTO comanda (id, num_vehiculo, estado, id_factura) VALUES (?, ?, ?, ?)");
                $stmt->execute([$id, $num_vehicles, $state, $invoice]);

                $errors[] = "Data add correctly!";
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }

    //insertar($id, $num_vehicles, $state, $invoice, $errors); //Ús de la funció

    //Update
    /**
     * @param $state
     * @param $id
     * @param $errors
     * @return void
     */
    function update($state, $id, &$errors)
    {
        if (empty($errors)) {
            try {
                $pdo = new PDO("mysql:host=mysql-server; dbname=db_proyecto", "root", "secret");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("UPDATE comanda SET estado = ? WHERE id = ?");
                $stmt->execute([$state, $id]);

                $errors[] = "Data updated correctly!";
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }

    //update($state, $id, $errors);

    //Delete
    /**
     * @param $id
     * @param $num_vehiculo
     * @param $state
     * @param $invoice
     * @param $errors
     * @return void
     */
    function delete($id, $num_vehiculo, $state, $invoice, &$errors)
    {
        if (empty($errors)){
            try{
                $pdo = new PDO("mysql:host=mysql-server; dbname=db_proyecto", "root", "secret");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare(" DELETE FROM comanda WHERE id = :id AND num_vehiculo = :num_vehiculo AND estado = :estado AND id_factura = :id_factura");
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":num_vehiculo", $num_vehiculo);
                $stmt->bindParam(":estado", $state);
                $stmt->bindParam(":id_factura", $invoice);
                $stmt->execute();

                $errors[] = "Data deleted correctly!";
            }catch(PDOException $e){
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }

    delete($id, $num_vehicles, $state, $invoice, $errors); //borrar

    // SI NO -> EMMAGATZEMME ELS ERRORS PER A MOSTRAR-LOS A L'USUARI
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

//Em falten els botons per a unir-los amb les funcions corresponents

