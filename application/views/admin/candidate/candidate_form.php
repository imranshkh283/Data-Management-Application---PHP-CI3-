<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content">

		<!-- Topbar -->
		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

			<!-- Sidebar Toggle (Topbar) -->
			<form class="form-inline">
				<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					<i class="fa fa-bars"></i>
				</button>
			</form>

			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto">

				<!-- Nav Item - Search Dropdown (Visible Only XS) -->
				<li class="nav-item dropdown no-arrow d-sm-none">
					<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-search fa-fw"></i>
					</a>
					<!-- Dropdown - Messages -->
					<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
						aria-labelledby="searchDropdown">
						<form class="form-inline mr-auto w-100 navbar-search">
							<div class="input-group">
								<input type="text" class="form-control bg-light border-0 small"
									placeholder="Search for..." aria-label="Search"
									aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary" type="button">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>



				<div class="topbar-divider d-none d-sm-block"></div>

				<!-- Nav Item - User Information -->
				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
						<img class="img-profile rounded-circle"
							src="<?php echo base_url('assets/img/undraw_profile.svg'); ?>">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="userDropdown">
						<a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">
							<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Logout
						</a>
					</div>
				</li>

			</ul>

		</nav>
		<!-- End of Topbar -->

		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?php echo $title_mode; ?></h1>

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo $this->session->flashdata('error'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
				</div>
				<div class="card-body">
					<?php echo form_open('candidate/submit_form'); ?>
					<input type="hidden" name="id" value="<?php echo $data->id; ?>">
					<input type="hidden" name="mode" value="<?php echo $mode; ?>">

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name"
							value="<?php echo set_value('name', $data->name); ?>" placeholder="Enter your name">
						<?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="company_name">Company Name</label>
						<input type="text" class="form-control" id="company_name" name="company_name"
							value="<?php echo set_value('company_name', $data->company_name); ?>" placeholder="Enter your company name">
						<?php echo form_error('company_name', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="designation">Designation</label>
						<input type="text" class="form-control" id="designation" name="designation"
							value="<?php echo set_value('designation', $data->designation); ?>" placeholder="Enter your designation">
						<?php echo form_error('designation', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" class="form-control" id="email" name="email"
							value="<?php echo set_value('email', $data->email); ?>" placeholder="Enter email">
						<?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
					</div>
					<?php $btnConvention = (isset($mode) && $mode == 'add') ? 'Add'  : 'Update'; ?>
					<button type="submit" class="btn btn-primary"><?php echo $btnConvention; ?> Profile</button>
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content -->