<?php

	$dataDay = $data['dataDay'];
	$dataMonth = $data['dataMonth'];
	$dataTotalMonth = $data['dataTotalMonth'];
	$totalPriceDay = 0;
	$totalProductDay = 0;
	$totalPriceMonth = 0;
	foreach ($dataDay as $item){
		$totalPriceDay += $item['price'];
		$totalProductDay += $item['number'];
	}
	foreach ($dataMonth as $item){
		$totalPriceMonth += intval($item['price']);
	}
	$lastDay = count($dataMonth);

?>
<div class="container mt-3" style="">
	<div class="alert alert-dark" role="alert">
		<h1>Chào mừng bạn đến với trang quản trị viên</h1>
	</div>
	<div class="card">
		<div class="card-header">
			<h4>Thống kê bán hàng</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-4 d-flex">
					<div class="mr-3"><i class="fas fa-shopping-bag" style="font-size: 50px; color: #d15d00; vertical-align: middle; margin-top: 5px;"></i></div>
					<div>
						<div style="font-size: 18px;">Tổng tiền giao dịch/tháng</div>
						<div style="font-size: 30px;font-weight: 700;"><?php echo $this->Lib->formatPrice($totalPriceMonth); ?></div>
					</div>
				</div>
				<div class="col-4 d-flex">
					<div class="mr-3"><i class="fas fa-shopping-cart" style="font-size: 50px; color: #d15d00; vertical-align: middle; margin-top: 5px;"></i></div>
					<div>
						<div style="font-size: 18px;">Tổng tiền giao dịch/ngày</div>
						<div style="font-size: 30px;font-weight: 700;"><?php echo $this->Lib->formatPrice($totalPriceDay); ?></div>
					</div>
				</div>
				<div class="col-4 d-flex">
					<div class="mr-3"><i class="fab fa-product-hunt" style="font-size: 50px; color: #d15d00; vertical-align: middle; margin-top: 5px;"></i></div>
					<div>
						<div style="font-size: 18px;">Sản phẩm giao dịch/ngày</div>
						<div style="font-size: 30px;font-weight: 700;"><?php echo $totalProductDay; ?> Sản phẩm</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4>Biểu đồ theo tháng</h4>
				</div>
				<div class="card-body">
<!--					<div id="chart_div2" style="width: 100%;">-->
					<div id="chart_div"></div>
				</div>
			</div>
		</div>

	</div>
	<?php if(!empty($dataDay)) : ?>
	<div class="col-12 mt-3">
		<div class="card">
			<div class="card-header">
				<h4>Tỉ lệ sản phẩm bán theo ngày</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-6"><div id="donutchart1" style="width: 100%;"></div></div>
					<div class="col-6"><div id="donutchart2" style="width: 100%;"></div></div>
				</div>


			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if(!empty($dataTotalMonth)) : ?>
		<div class="col-12 mt-3">
			<div class="card">
				<div class="card-header">
					<h4>Tỉ lệ sản phẩm bán theo tháng</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6"><div id="donutchart3" style="width: 100%;"></div></div>
						<div class="col-6"><div id="donutchart4" style="width: 100%;"></div></div>
					</div>


				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load("current", {packages:["corechart"]});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Tên sản phẩm', 'Số lượng'],
			<?php
				foreach ($dataDay as $item){
					echo "['" . $item['name'] . "', " . $item['number'] . '],';
				}
			?>
			// ['Work',     2],
		]);

		var options = {
			title: 'Tỉ lệ sản phẩm theo số lượng',
			pieHole: 0.4,
		};

		var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
		chart.draw(data, options);
	}
</script>
<script type="text/javascript">
	google.charts.load("current", {packages:["corechart"]});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Tên sản phẩm', 'Doanh thu'],
			<?php
			foreach ($dataDay as $item){
				echo "['" . $item['name'] . "', " . $item['price'] . '],';
			}
			?>
			// ['Work',     11],
		]);

		var options = {
			title: 'Tỉ lệ sản phẩm theo doanh thu',
			pieHole: 0.4,
		};

		var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
		chart.draw(data, options);
	}
</script>
	<script type="text/javascript">
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Tên sản phẩm', 'Số lượng'],
				<?php
				foreach ($dataTotalMonth as $item){
					echo "['" . $item['name'] . "', " . $item['number'] . '],';
				}
				?>
				// ['Work',     2],
			]);

			var options = {
				title: 'Tỉ lệ sản phẩm theo số lượng',
				pieHole: 0.4,
			};

			var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
			chart.draw(data, options);
		}
	</script>
	<script type="text/javascript">
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Tên sản phẩm', 'Doanh thu'],
				<?php
				foreach ($dataTotalMonth as $item){
					echo "['" . $item['name'] . "', " . $item['price'] . '],';
				}
				?>
				// ['Work',     11],
			]);

			var options = {
				title: 'Tỉ lệ sản phẩm theo doanh thu',
				pieHole: 0.4,
			};

			var chart = new google.visualization.PieChart(document.getElementById('donutchart4'));
			chart.draw(data, options);
		}
	</script>
<script type="text/javascript">
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Ngày', 'Doanh số'],
			<?php
				foreach ($dataMonth as $key => $item){
					echo '[' . $key . ', ' . $item['price'] . '], ';
				}
			?>
			// [0, 1], [1, 33], [2, 269], [3, 100]
		]);

		var options = {
			title: 'Biểu đồ doanh số theo tháng',
			hAxis: {title: 'Ngày', minValue: 1, maxValue: <?php echo $lastDay; ?>},
			vAxis: {title: 'Doanh số', minValue: 0, maxValue: <?php echo $totalPriceMonth; ?>},
			trendlines: {
				0: {
					type: 'exponential',
					visibleInLegend: true,
				}
			}
		};

		var chart = new google.visualization.ScatterChart(document.getElementById('chart_div3'));
		chart.draw(data, options);
	}

</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
	google.charts.load('current', {packages: ['corechart', 'line']});
	google.charts.setOnLoadCallback(drawBasic);

	function drawBasic() {

		var data = new google.visualization.DataTable();
		data.addColumn('number', 'Ngày');
		data.addColumn('number', 'Doanh thu');

		data.addRows([
			<?php
			foreach ($dataMonth as $key => $item){
				echo '[' . $key . ', ' . $item['price'] . '], ';
			}
			?>
			// [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
			// [6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
			// [12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
			// [18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
			// [24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
			// [30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
			// [36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
			// [42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
			// [48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
			// [54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
			// [60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
			// [66, 70], [67, 72], [68, 75], [69, 80]
		]);

		var options = {
			hAxis: {
				title: 'Ngày',
			},
			vAxis: {
				title: 'Doanh thu'
			}
		};

		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

		chart.draw(data, options);
	}
</script>
