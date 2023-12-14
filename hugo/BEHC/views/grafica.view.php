<?php
$pdo = new PDO('mysql:host=mysql-server;dbname=projecte', 'root', 'secret');
$statement = $pdo->prepare("SELECT email, phone FROM provider");
$statement->execute();
$providers = $statement->fetchAll(PDO::FETCH_ASSOC);

// Count the occurrences of each email
$emailCounts = array_count_values(array_column($providers, 'email'));

// Prepare an array for chart data
$chartData = [];
foreach ($emailCounts as $email => $count) {
    $chartData[] = [
        'email' => $email,
        'count' => $count,
    ];
}

// Encode the data into JSON format
$encodedData = json_encode($chartData);
?>
<main>
    <section class="grafica">
        <canvas id="providerChart"></canvas>
    </section>
    <script>
        const graph = document.querySelector("#providerChart");

        // Use the PHP variable $encodedData to get provider data
        const chartData = <?php echo $encodedData; ?>;

        const data = {
            labels: chartData.map(provider => provider.email),
            datasets: [{
                data: chartData.map(provider => provider.count),
                backgroundColor: generateColors(chartData.length),
            }]
        };

        const config = {
            type: 'pie',
            data: data,
        };

        new Chart(graph, config);

        // Function to generate different colors
        function generateColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }

        // Function to generate a random color
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
</main>
