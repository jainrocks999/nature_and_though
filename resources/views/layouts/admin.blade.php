 <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Nature & Thought</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<style>
	.nav .collapse .nav-link {
		padding-left: 30px;
		color: #ccc;
	}

	.nav .collapse .nav-link:hover {
		color: #000;
	}

	</style>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="{{ route('dashboard')}}" class="logo">
					Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span >Admin</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
										<div class="u-text">
											<h4>Admin</h4>
											<p class="text-muted">admin@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
									<a class="dropdown-item" href="#"></i> My Balance</a>
									<a class="dropdown-item" href="#"><i class="fa fa-power-off"></i> Logout</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
 			@include('partials.menu')
			<!-- <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-center">									
							<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
							<p>
								<b>We'll let you know when it's done</b></p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div> -->
			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif

			@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{ session('error') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif
			<div class="main-panel">
				<main>
					@yield('content') 
				</main>
			</div>
		</div>
	</div>
	<!-- </body>
	 <script src="assets/js/core/jquery.3.2.1.min.js"></script>
	 <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	 <script src="assets/js/core/popper.min.js"></script>
	 <script src="assets/js/core/bootstrap.min.js"></script>
	 <script src="assets/js/plugin/chartist/chartist.min.js"></script>
	 <script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
	 <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	 <script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	 <script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
	 <script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
	 <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
	 <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	 <script src="assets/js/ready.min.js"></script>
	 <script src="assets/js/demo.js"></script>
</html> -->
			
		
			
			