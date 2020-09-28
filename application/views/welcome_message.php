<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SIMAPEDU-Login</title>
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/logo.png" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php echo base_url() ?>assets/logo.png">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>themes/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>themes/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>themes/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>themes/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>themes/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url() ?>assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url() ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="assets/js/app.js"></script>
	<script src="<?php echo base_url() ?>assets/js/demo_pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body class="bg-slate-800" style="background-image:url(<?php echo base_url('assets/mekkah.jpg') ?>);background-size:cover">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form" action="<?php echo base_url() . 'user_login' ?>" method="POST">
					<div class="card mb-0" style="border-radius:20px;background-color:rgba(0,0,0,.5)">
						<div class="card-body">

							<div class="text-center mb-3">
								<img src="<?php echo base_url() ?>assets/logo.png" width="100px" alt="">

							</div>

							<div class="pesan">

							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="id">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										<input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
										Remember
									</label>
								</div>

								<a href="login_password_recover.html" class="ml-auto">Forgot password?</a>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>


						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<script>
		var mainurl = "<?php echo base_url(); ?>";
		$(document).on('submit', '.login-form', function(event) {
			event.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				dataType: 'json',
				data: $(this).serialize(),

				beforeSend: function() {
					// swal({
					//     title: 'Menunggu',
					//     html: 'Memuat data',
					//     onOpen: () => {
					//         swal.showLoading()
					//     }
					// })
				},
				success: function(res) {
					console.log('res', res);
					if (res.sukses) {
						$('.pesan').html(
							`<div class="alert alert-success" role="alert">
							 ` + res.sukses + `
							</div>
							`
						).show();
						location = mainurl + "dashboard";
					} else {
						$('.pesan').html(
							`<div class="alert alert-warning" role="alert">
							 ` + res.error + `
							</div>
							`
						).show();
					}
				}
			});

			/* Act on the event */
		});
	</script>

</body>

</html>