<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สุภัสสร ปาปะโน (แพท)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; padding-top: 20px; }
        .container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header-title { color: #0d6efd; margin-bottom: 25px; }
    </style>
</head>

<body>
<div class="container">
    <h1 class="header-title text-center">สุภัสสร ปาปะโน (แพท)</h1>

    <form method="post" action="" class="row g-3 mb-4">
        <div class="col-auto">
            <input type="text" name="a" class="form-control" placeholder="ค้นหาข้อมูล..." autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" name="Submit" class="btn btn-primary">ค้นหาด่วน</button>
        </div>
    </form>
    
    <hr>

    <div class="table-responsive">
        <table id="myTable" class="table table-striped table-hover border" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภท</th>
                    <th>วันที่</th>
                    <th>ประเทศ</th>
                    <th class="text-end">จำนวนเงิน</th>
                    <th class="text-center">รูปภาพ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include_once("connectdb.php");
            @$kw = $_POST['a'];
            // ป้องกัน SQL Injection เบื้องต้น
            $kw = mysqli_real_escape_string($conn, $kw);
            $sql = "SELECT * FROM `popsupermarket` WHERE p_country LIKE '%{$kw}%' OR p_product_name LIKE '%{$kw}%' OR p_category LIKE '%{$kw}%'";
            $rs = mysqli_query($conn, $sql);
            $total = 0;
            
            while ($data = mysqli_fetch_array($rs)) {
                $total += $data['p_amount'];
            ?>
                <tr>
                    <td><?= $data['p_order_id']; ?></td>
                    <td><?= $data['p_product_name']; ?></td>
                    <td><span class="badge bg-info text-dark"><?= $data['p_category']; ?></span></td>
                    <td><?= $data['p_date']; ?></td>
                    <td><?= $data['p_country']; ?></td>
                    <td align="right"><?= number_format($data['p_amount'], 0); ?></td>
                    <td align="center">
                        <img src="images/<?= $data['p_product_name']; ?>.jpg" 
                             width="50" class="img-thumbnail" 
                             onerror="this.src='https://via.placeholder.com/50?text=No+Img'">
                    </td>
                </tr>
            <?php
            }
            mysqli_close($conn);
            ?>
            </tbody>
            <tfoot class="table-secondary">
                <tr>
                    <th colspan="5" class="text-end">ยอดรวมทั้งสิ้น:</th>
                    <th class="text-end text-primary"><?= number_format($total, 0); ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/th.json" // เมนูภาษาไทย
            },
            "pageLength": 10,
            "order": [[0, "desc"]] // เรียงจาก Order ID ล่าสุด
        });
    });
</script>
</body>
</html>