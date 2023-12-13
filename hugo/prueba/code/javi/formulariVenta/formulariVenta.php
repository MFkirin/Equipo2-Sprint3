<html lang="en">
    <head>
        <title>Sale</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="saleInformation.php" method="post">
            <h1>
                Consumer Data:
            </h1>
            <div>
                <label for="customerName">Name:</label>
                <input type="text" name="customerName" required placeholder="Your name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+(?:\s+[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+){1,5}(?<!\s)$" />
            </div>
            <div>
                <div>
                    <select class="form-control" aria-label="Default select example" id="type-Doc">
                        <option value="selectDoc" disabled id="selectDoc" selected>Select</option>
                        <option value="dni">DNI</option>
                        <option value="nie">NIE</option>
                        <option value="passport">PASSPORT</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="document">Document</label>
                    <input type="text" id="document" name="dni" class="text"/>
                </div>
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input id="phone" name="phone" title="phone" placeholder="634634335" required pattern="[0-9]{9}" class="text">
            </div>
            <div>
                <label for="email">Email:</label>
                <input id="email" name="email" title="Email" placeholder="example@gmail.com" required pattern="/^([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}$/igm" type="email" class="text">
            </div>
            <div id="address">
                <label>Address</label>
                <input id="address" name="address" title="address" placeholder="address" class="text" required>
            </div>
            <div id="payment-method">
                <h3>Select payment method</h3>
                <div>
                    <select name="payment-method" id="payment-option" class="form-control form-select form-select-lg mb-3">
                        <option value="mastercard">MasterCard</option>
                        <option value="paypal">Paypal</option>
                        <option value="visa">Visa</option>
                    </select>
                </div>
                <div>
                    <input type="checkbox" id="terms" value="Accept-Terms" required>
                    <label>I accept the terms and conditions</label>
                </div>
                <button id="pay" type="submit">Pay</button>
                <?php
                    require 'Customer.php';
                    $customer = new Customer();
                    $customer->setName($_POST['customerName']);
                    $customer->setEmail($_POST['email']);
                    $customer->setDni($_POST['dni']);
                    $customer->setPhone($_POST['phone']);
                    $customer->setAddress($_POST['address']);
                ?>
            </div>
        </form>
        <a href="saleInformation.php">Information</a>
    </body>
</html>