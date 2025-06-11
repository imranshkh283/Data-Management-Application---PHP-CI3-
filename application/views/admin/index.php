<div class="container">

	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-login-image"
							style="background:url(<?= $this->config->item('base_url') ?>assets/img/logo-500x500.jpg); background-repeat: no-repeat; background-size: cover;"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
								</div>
								<?php if ($this->session->flashdata('error')): ?>
									<div class="alert alert-danger" role="alert">
										<span class="block sm:inline"><?php echo $this->session->flashdata('error'); ?></span>
									</div>
								<?php endif;
								if ($this->session->flashdata('success')): ?>
									<div class="alert alert-success" role="alert">
										<span class="block sm:inline"><?php echo $this->session->flashdata('success'); ?></span>
									</div>
								<?php endif; ?>

								<?php echo form_open('login/authenticate', ['class' => 'user']); ?>
								<div class="form-group">
									<input type="email" class="form-control form-control-user"
										id="exampleInputEmail" aria-describedby="emailHelp"
										value="admin@admin.com" name="email" placeholder="Enter Email Address..." required>
									<?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user"
										id="exampleInputPassword" name="password"
										value="admin@admin.com"
										placeholder="Password" required>
									<?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
								</div>
								<div class="form-group">
									<div class="custom-control custom-checkbox small">
										<input type="checkbox" class="custom-control-input" id="customCheck">
										<label class="custom-control-label" for="customCheck">Remember
											Me</label>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-user btn-block">
									Login
								</button>

								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>