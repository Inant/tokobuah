<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('admin/_partials/head.php') ?>
</head>

<body id="page-top">

  <?php $this->load->view('admin/_partials/navbar.php') ?>

  <div id="wrapper">

    <?php $this->load->view('admin/_partials/sidebar.php') ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <?php 
          $this->load->view('admin/_partials/breadcrumb.php');
          if ($this->session->flashdata('success')){
        ?>
            <div class="alert alert-success" role="alert">
              <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php
          }
        ?>

        <div class="card mb-3">
          <div class="card-header"> 
            <a href="<?php echo site_url('admin/products/')?>"><i class="fas fa-arrow-left"></i> Back</a>
          </div>
          <div class="card-body">
            <form action="<?php echo base_url('admin/users/add') ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control <?php echo form_error('name') ? 'is-invalid' :  '' ?>" placeholder="Name" value="<?php echo set_value('name') ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('name') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control <?php echo form_error('email') ? 'is-invalid' :  '' ?>" placeholder="User email" value="<?php echo set_value('email') ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('email') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control-file <?php echo form_error('avatar') ? 'is-invalid' :  '' ?>" value="<?php echo set_value('avatar') ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('avatar') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" value="<?php echo set_value('username') ?>" placeholder="Username">
                <div class="invalid-feedback">
                  <?php echo form_error('username') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" value="<?php echo set_value('password') ?>" placeholder="Password">
                <div class="invalid-feedback">
                  <?php echo form_error('password') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="confirm_password">Password confirmation</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo form_error('confirm_password') ? 'is-invalid' : '' ?>" value="<?php echo set_value('confirm_password') ?>" placeholder="Password confirmation">
                <div class="invalid-feedback">
                  <?php echo form_error('confirm_password') ?>
                </div>
              </div>
              <input type="submit" value="Save" name="btn" class="btn btn-primary">
            </form>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <?php $this->load->view('admin/_partials/footer.php') ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <?php $this->load->view('admin/_partials/scrolltop.php') ?>
  <?php $this->load->view('admin/_partials/modal.php') ?>
  <?php $this->load->view('admin/_partials/js.php') ?>

</body>

</html>