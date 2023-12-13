<section class="row">
    <section class="col-10">
        <h1>Facturas</h1>
        <div id="div-table">
            <div class="table-searcher">
                <input type="text" class="table-searcher-input" placeholder="Buscar...">
                <button class="table-searcher-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <table id="invoices-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nº Factura</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Comanda</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td data-title="Id"><?= $invoice->getId() ?></td>
                        <td data-title="Nº Factura:"><?= $invoice->getNumber() ?></td>
                        <td data-title="Preu:"><?= $invoice->getPrice() ?></td>
                        <td data-title="Data:"><?= $invoice->getDate()->format('Y-m-d') ?></td>
                        <td><?= $invoice->getCustomer() ? $invoice->getCustomer()->getName() : "No disponible" ?></td>
                        <td data-title="Comanda:"><?= $invoice->getOrderId() ?></td>
                        <td>
                            <a href="/invoice_detail.php?id=<?= $invoice->getId() ?>">
                                <button>Ver detalles</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</section>
