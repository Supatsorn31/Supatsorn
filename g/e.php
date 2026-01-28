<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>สุภัสสร ปาปะโน(แพท)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        /* จัดเลย์เอาต์ให้ยืดหยุ่น */
        .dashboard { 
            display: flex; 
            gap: 20px; 
            align-items: flex-start; 
            flex-wrap: wrap;
        }
        .charts-area { flex: 2; display: flex; gap: 10px; min-width: 400px; }
        .table-area { flex: 1; min-width: 250px; }
        
        canvas { max-width: 100%; height: auto !important; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
    </style>
</head>

<body>
    <h1>สุภัสสร ปาปะโน(แพท)</h1>

    <div class="dashboard">
        <div class="charts-area">
            <div style="width: 50%;"><canvas id="barChart"></canvas></div>
            <div style="width: 50%;"><canvas id="pieChart"></canvas></div>
        </div>

        <div class="table-area">
            <table>
                <tr>
                    <th>ประเทศ</th>
                    <th>ยอดขาย</th> 
                </tr>
                <?php
                include_once("connectdb.php");
                $sql = "SELECT p_country, SUM(p_amount) AS total FROM popsupermarket GROUP BY p_country";
                $rs = mysqli_query($conn, $sql);

                $labels = [];
                $values = [];

                while ($data = mysqli_fetch_array($rs)) {
                    $labels[] = $data['p_country'];
                    $values[] = $data['total'];
                ?>
                <tr>
                    <td><?php echo $data['p_country'];?></td>
                    <td><?php echo number_format($data['total'], 2);?></td>
                </tr>
                <?php 
                }
                mysqli_close($conn);
                ?> 
            </table>
        </div>
    </div>

    <script>
        const labels = <?php echo json_encode($labels); ?>;
        const dataValues = <?php echo json_encode($values); ?>;
        
        const colors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)'
        ];

        // กราฟแท่ง
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'ยอดขาย',
                    data: dataValues,
                    backgroundColor: colors
                }]
            },
            options: { plugins: { legend: { display: false } } }
        });

        // กราฟวงกลม
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: colors
                }]
            }
        });
    </script>
</body>
</html>