<section class="row">
    <section class="col-10">
        <h1>Detalles de Factura</h1>

        <?php if (isset($invoice)): ?>
            <table id="invoice-details">
                <tbody>
                <tr>
                    <th>ID:</th>
                    <td><?= $invoice->getId() ?></td>
                </tr>
                <tr>
                    <th>Nº Factura:</th>
                    <td><?= $invoice->getNumber() ?></td>
                </tr>
                <tr>
                    <th>Precio:</th>
                    <td><?= $invoice->getPrice() ?></td>
                </tr>
                <tr>
                    <th>Fecha:</th>
                    <td><?= $invoice->getDate()->format('Y-m-d') ?></td>
                </tr>
                <tr>
                    <th>Cliente:</th>
                    <td><?= $invoice->getCustomer() ? $invoice->getCustomer()->getName() : "No disponible" ?></td>
                </tr>
                <tr>
                    <th>Comanda:</th>
                    <td><?= $invoice->getOrderId() ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="/invoice_list.php">
                            <button>Volver a la lista de facturas</button>
                        </a>
                        <a href="/invoice_update.php?id=<?= $invoice->getId() ?>">
                            <button>Actualizar Factura</button>
                        </a>
                        <a href="/invoice_delete.php?id=<?= $invoice->getId() ?>">
                            <button>Borrar Factura</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <form action="/invoice_pdf.php" method="post" target="_blank">
                <?php
                $fields = [
                    'Factura' => $invoice->getNumber(),
                    'Fecha' => $invoice->getDate()->format('d-m-Y'),
                    'Nombre' => $invoice->getCustomer()->getName(),
                    'Pedido' => $invoice->getOrderId(),
                    'Precio' => $invoice->getPrice(),
                ];

                foreach ($fields as $name => $value) {
                    echo "<input type='hidden' name='{$name}' value='{$value}'>";
                }
                ?>
                <button type="submit">Generar PDF</button>
            </form>
        <?php else: ?>
            <p>Factura no encontrada</p>
        <?php endif; ?>
    </section>
</section>