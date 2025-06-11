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
			<h1 class="h3 mb-2 text-gray-800">Candidate List</h1>
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
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">

					<button class="btn btn-danger btm-lg btn-delete-all" style="float:right;" disabled>Delete </button>

					<a href="<?php echo base_url('candidate/add'); ?>" class="btn btn-success btm-lg " style="float:right; margin-right: 10px !important;">Add </a>


				</div>
				<div class="card-body">
					<div class="table-responsive">
						<form id="bulk_delete_form" method="POST" action="<?php echo base_url('candidate/bulk_delete'); ?>">
							<table class="table table-bordered" id="candidateDataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>
											<input type="checkbox" name="select_all" id="select_all">
										</th>
										<th>Name</th>
										<th>Company Name</th>
										<th>Email</th>
										<th>Designation</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody></tbody>
							</table>
						</form>
					</div>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content -->

	<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete the selected records?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		const APIPATH = "<?php echo base_url('Candidate/get_all_candidates'); ?>";
	</script>