<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Dashboard</div>
				</div>
				<div class="panel-body" style="text-align: center;">
					<h4>Selamat Datang Di Aplikasi Insan Qurani</h4>
					<p>Aplikasi Insan Qurani adalah aplikasi yang di design khusus untuk memenuhi aspek-aspek dalam kegiatan belajar mengajar di Sekolah Insan Qurani. </p>
					<p>Dalam aplikasi ini mencakup mendigitalkan kegiatan-kegiatan seperti Pendataan siswa, guru, kelas, tahunajaran, semester Mata Pelajaran, Penilaian Per Mata Pelajaran, Rapor dan lain-lain.</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="text-align: center;">
				Kalender Akademik
			</h3>
		</div>
		<div class="panel-body">
			<style>
				.panel-calendar .days{
					padding: 0;
					margin: 0;
					list-style: none;
					
					display: grid;
					grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
				}

				.panel-calendar .days li{
					text-align: center;
					height: 30px;
				}

				.panel-calendar .days li a{
					color: #000;
				}
			</style>

			<?php  


			$year = date('Y');

			$kalenderakademik = [];
			$query = $this->db->query("SELECT * FROM kalenderakademik WHERE YEAR(tanggal) = '{$year}'");
			if($query->num_rows() > 0){
				$kalenderakademik = $query->result();
			}


			$month = [
				1 => 'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember',
			];

			$divide_by = 4;

			$month_chunk = array_chunk($month, $divide_by, true);
			?>

			<?php foreach($month_chunk as $chunk): ?>
				<div class="row">
					<?php foreach($chunk as $month_number => $month_name): ?>
						<div class="col-md-<?php echo (12 / $divide_by) ?>">
							<div class="panel panel-default panel-calendar">
								<div class="panel-heading">
									<div class="panel-title"><?php echo $month_name ?> <?php  echo $year; ?></div>
								</div>
								<div class="panel-body">
									<ul class="days">
										<li style="font-weight: bold;">Min</li>
										<li style="font-weight: bold;">Sen</li>
										<li style="font-weight: bold;">Sel</li>
										<li style="font-weight: bold;">Rab</li>
										<li style="font-weight: bold;">Kam</li>
										<li style="font-weight: bold;">Jum</li>
										<li style="font-weight: bold;">Sab</li>
										
									</ul>

									<ul class="days">
										<?php 
										$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month_number, $year); 
										?>
										<?php for($i = 1; $i <= $days_in_month; $i++): ?>
											<?php if($i == 1): ?>
												<?php $day_number_in_week = date('w', strtotime($month_number. '/' . $i .'/'. $year)) ?>
												<li style="grid-column-start: <?php echo ($day_number_in_week + 1) ?>;"><a href=""><?php echo $i; ?></a></li>
											<?php else: ?>
												<li><a href=""><?php echo $i ?></a></li>
											<?php endif; ?>
											
										<?php endfor; ?>
									</ul>
									<table class="table table-striped">
										<tbody>
											<?php if($kalenderakademik): foreach($kalenderakademik as $_kalenderakademik): ?>
												
												<?php if(($year. '-'. $month_number) == date('Y-n', strtotime($_kalenderakademik->tanggal))): ?>
													<tr>
														<td><?php echo (date('j', strtotime($_kalenderakademik->tanggal))) ?></td>
														<td><?php echo $_kalenderakademik->keterangan ?></td>
													</tr>
												<?php endif; ?>
													
											<?php endforeach; endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	
</div>

