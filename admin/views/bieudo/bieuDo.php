<!-- header -->
<?php
include "./views/layout/header.php"
?>
<!-- end header -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include "./views/layout/navbar.php"
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include "./views/layout/sidebar.php"
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Biểu đồ thống kê doanh thu đơn hàng</h1>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div id="myChart" style="width:100%; height:800px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!--footer-->
        <?php include './views/layout/footer.php'; ?>

        <!-- /.control-sidebar -->
    </div>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            const data = google.visualization.arrayToDataTable([
                ['Ngày đặt', 'Tổng doanh thu (₫)'], // Gồm Ngày đặt và Tổng doanh thu
                <?php
                if (!empty($listThongKe) && is_array($listThongKe)) {
                    foreach ($listThongKe as $index => $item) {
                        // Loại bỏ định dạng không cần thiết (nếu có)
                        $totalRevenue = str_replace(['₫', '.', ','], '', $item['totalRevenue']);
                        echo "['{$item['ngay_dat']}', {$totalRevenue}]";
                        echo $index < count($listThongKe) - 1 ? ',' : '';
                    }
                } else {
                    echo "['Không có dữ liệu', 0]";
                }
                ?>
            ]);

            const options = {
                title: 'Thống kê doanh thu theo ngày đặt',
                chartArea: { width: '70%' },
                hAxis: {
                    title: 'Ngày đặt',
                },
                vAxis: {
                    title: 'Doanh thu (₫)',
                },
                height: 800,
                width: '100%',
                colors: ['#FF5733'],
            };

            const chart = new google.visualization.ColumnChart(document.getElementById('myChart'));

            // Định dạng số tiền với đầy đủ đơn vị "₫"
            const formatter = new google.visualization.NumberFormat({
                pattern: '#,###₫' // Định dạng tiền tệ với dấu phân cách hàng nghìn và "₫"
            });
            formatter.format(data, 1); // Định dạng cột thứ 2 (Tổng doanh thu)

            chart.draw(data, options);
        }
    </script>

</body>

</html>
