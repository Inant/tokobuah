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
            <a href="<?php echo site_url('admin/users/')?>"><i class="fas fa-arrow-left"></i> Back</a>
          </div>
          <div class="card-body">
            <form action="<?php base_url('admin/users/edit') ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $user->user_id ?>">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control <?php echo form_error('name') ? 'is-invalid' :  '' ?>" placeholder="Name" value="<?php echo $user->name ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('name') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control <?php echo form_error('email') ? 'is-invalid' :  '' ?>" placeholder="User email" value="<?php echo $user->email ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('email') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control-file <?php echo form_error('avatar') ? 'is-invalid' :  '' ?>" value="<?php echo set_value('avatar') ?>">
                <input type="hidden" name="old_avatar" value="<?php echo $user->avatar ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('avatar') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" value="<?php echo $user->username ?>" placeholder="Username">
                <div class="invalid-feedback">
                  <?php echo form_error('username') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Status</label> <br>
                <div class="form-check form-check-inline">
                  <input type="radio" name="status" id="active" class="form-check-input" value="Active" <?php echo $user->status == 'Active' ? 'checked' : '' ?> >
                  <label for="active" class="form-check-label">Active</label> &ensp;
                  <input type="radio" name="status" id="inactive" class="form-check-input" value="Inactive" <?php echo $user->status == 'Inactive' ? 'checked' : '' ?> >
                  <label for="inactive" class="form-check-label">Inactive</label>
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