<?php
$administrativeCount = 0;
$administratorCount = 0;
//Array employees JSON
$jsonEmployees = array();

foreach ($employees as $employee) {
    $type = $employee->getType();

    if ($type === 'administrative') {
        $administrativeCount++;
    } elseif ($type === 'administrator') {
        $administratorCount++;
    }
    //Agregem els employees al array
    $jsonEmployees[] = array(
        'id' => $employee->getId(),
        'name' => $employee->getName(),
        'lastname' => $employee->getLastname(),
        'type' => $type,
    );
}
//Passem el array al format JSON
$jsonData = json_encode($jsonEmployees, JSON_PRETTY_PRINT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista employees</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<section>
    <h2>Inicis de sessió</h2>
    <a href="../employee_create.php">
        <button type="button" class="create-login-button">Crear Nuevo Employee</button>
    </a>
    <input id="search" placeholder="Search..."/>
    <table id="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Cognom</th>
            <th>Rol</th>
            <th colspan="2">Operacions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= $employee->getId(); ?></td>
                <td><?= $employee->getName(); ?></td>
                <td><?= $employee->getLastname(); ?></td>
                <td><?= $employee->getType(); ?></td>
                <td><a href="../employee_update.php?id=<?= $employee->getId(); ?>" class="operation-link edit-link">Editar</a></td>
                <td><a href="#" class="operation-link delete-link" data-employee-id="<?= $employee->getId(); ?>">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div id="content-container"></div>

    <script>
        // Función para eliminar un empleado mediante una solicitud AJAX
        function deleteEmployee(employeeId) {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    url: '/employee_delete_process.php',
                    method: 'POST',
                    data: { id: employeeId },
                    success: function (response) {
                        resolve(response);
                    },
                    error: function (error) {
                        reject(error);
                    }
                });
            });
        }

        // Función para realizar la búsqueda en la tabla
        function searchTable() {
            let searchTerm = $('#search').val().toLowerCase();

            $('#table tbody tr').each(function () {
                let employeeName = $(this).find('td:eq(1)').text().toLowerCase();

                $(this).toggle(employeeName.includes(searchTerm));
            });
        }

        $(document).ready(function () {
            // Intercepta clics en enlaces de eliminación
            $('.delete-link').on('click', function (event) {
                event.preventDefault();

                let self = this;
                let employeeId = $(this).data('employee-id');

                // Utiliza la función deleteEmployee que devuelve una promesa
                deleteEmployee(employeeId)
                    .then(function (response) {
                        console.log('Empleado eliminado con éxito:', response);
                        $(self).closest('tr').remove();
                    })

                    .catch(function (error) {
                        console.error('Error al eliminar el empleado:', error);
                    });
            });

            // Realiza la búsqueda en la tabla cuando cambia el valor del input
            $('#search').on('input', searchTable);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <canvas id="myChart" width="800" height="300"></canvas>
    <script>
        $(document).ready(function () {
            let ctx = document.getElementById('myChart').getContext('2d');

            let data = {
                labels: ['Administrative', 'Administrator'],
                datasets: [{
                    label: 'Type of employees (Administrator / Administrative)',
                    backgroundColor: 'rgb(75, 192, 192)',
                    borderColor: 'rgb(75, 192, 192)',
                    data: [<?= $administrativeCount ?>, <?= $administratorCount ?>],
                }]
            };

            let myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</section>
</body>
</html>
