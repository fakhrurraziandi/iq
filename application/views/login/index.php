<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form action="" id="form-login">
				<div class="panel panel-default" style="border-top: 1px solid rgb(231, 231, 231);">
					<div class="panel-heading">
						
						<div class="row">
							<div class="col-md-4 text-center" style="text-align: center;">
								<img src="<?php echo base_url('assets/img/iq logo.png') ?>" alt="" style="width: 100%;margin-top: 14px; margin-left: 10px;">
							</div>
							<div class="col-md-8">
								<h2 style="font-weight: 700; color: #1C6D44;">Siddiq</h2>
								<p style="font-weight: 700; color: #1C6D44;">Sistem Informasi Digital Dayah <br>Insan Qur'ani</p>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username">
						</div>
						<div class="form-group">
							<label for="password" style="width: 100%;">Password </label>
							<input type="password" class="form-control" id="password" name="password">
						</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-success btn-block" id="btn-login">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/scripts/login.js') ?>"></script>