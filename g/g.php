<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>สุภัสสร ปาปะโน (แพท)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: auto; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }

        /* จัดวาง กราฟ และ ตาราง ในแถวเดียวกัน */
        .dashboard-row { 
            display: flex; 
            justify-content: center; 
            align-items: stretch; 
            gap: 15px; 
        }

        .item-box { 
            background: white; 
            padding: 15px; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ล็อคความสูงเพื่อไม่ให้กราฟยืด */
        .chart-area {
            position: relative;
            height: 280px; 
            width: 100%;
        }

        .box-bar { flex: 2; }
        .box-donut { flex: 1.2; }
        .box-table { flex: 1; min-width: 220px; }

        table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 10px; }
        th { background-color: #4e73df; color: white; padding: 10px; }
        td { padding: 8px; border-bottom: 1px solid #eeeeee; text-align: center; }
        .text-right { text-align: right; padding-right: 10px; }
        h3 { font-size: 16px; margin-top: 0; color: #555; }
    </style>
</head>

<body>
    <div class="container">
        <h1>สุภัสสร ปาปะโน (แพท)</h1>

        <div class="dashboard-row">
            <?php
            include_once("connectdb.php");
            
            // Array สำหรับแปลงเลขเดือนเป็นชื่อเดือนภาษาไทย
            $monthThai = [
                1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน",
                5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม",
                9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"
            ];

            $sql = "SELECT MONTH(p_date) AS Month, SUM(p_amount) AS Total_Sales 
                    FROM popsupermarket 
                    GROUP BY MONTH(p_date) 
                    ORDER BY Month";
            $rs = mysqli_query($conn, $sql);
            
            $labels = []; 
            $data_points = []; 
            $table_rows = "";

            while ($data = mysqli_fetch_array($rs)) {
                $m_name = $monthThai[$data['Month']]; // ดึงชื่อเดือนภาษาไทย
                $labels[] = $m_name;
                $data_points[] = $data['Total_Sales'];
                
                // เก็บข้อมูลตารางไว้ในตัวแปรเพื่อนำไปแสดงผลด้านล่าง
                $table_rows .= "<tr>
                                    <td>{$m_name}</td>
                                    <td class='text-right'>".number_format($data['Total_Sales'], 2)."</td>
                                </tr>";
            }
            ?>

            <div class="item-box box-bar">
                <h3>ยอดขายรายเดือน</h3>
                <div class="chart-area">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>

            <div class="item-box box-donut">
                <h3>สัดส่วนยอดขาย</h3>
                <div class="chart-area">
                    <canvas id="myDoughnutChart"></canvas>
                </div>
            </div>

            <div class="item-box box-table">
                <h3>สรุปยอด</h3>
                <table>
                    <thead>
                        <tr>
                            <th>เดือน</th>
                            <th>ยอดขาย (บาท)</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $table_rows; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const labels = <?php echo json_encode($labels); ?>;
        const salesData = <?php echo json_encode($data_points); ?>;
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#f6c23e'];

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { font: { family: 'Sarabun' } } }
            }
        };

        // สร้าง Bar Chart
        new Chart(document.getElementById('myBarChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'ยอดขาย',
                    data: salesData,
                    backgroundColor: colors,
                    borderRadius: 5
                }]
            },
            options: {
                ...commonOptions,
                plugins: { legend: { display: false } }
            }
        });

        // สร้าง Doughnut Chart
        new Chart(document.getElementById('myDoughnutChart'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: salesData,
                    backgroundColor: colors
                }]
            },
            options: commonOptions
        });
    </script>
</body>
</html>