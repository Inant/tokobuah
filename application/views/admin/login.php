<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('admin/_partials/head.php') ?>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <?php
        if ($this->session->flashdata('gagal')) {
            ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('gagal'); ?>
          </div>
      <?php
        }
      ?>
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="<?php echo base_url('admin/login/aksiLogin') ?>" method="post">
          <div class="form-group has-feedback">
            <div class="form-label-group">
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="form-label-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
              <label for="password">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="" id="">
                Remember
              </label>
            </div>
          </div>
          <input type="submit" value="Login" class="btn btn-primary btn-block">
        </form>
      </div>
    </div>
  </div>
  
  <?php $this->load->view('admin/_partials/js.php') ?>

</body>

</html>