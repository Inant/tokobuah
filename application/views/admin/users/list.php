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
            <a href="<?php echo site_url('admin/users/add')?>"><i class="fas fa-plus"></i> Add New</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $user) : ?>
                    <tr>
                      <td width="150">
                        <?php cetak($user->name) ?>
                      </td>
                      <td width="150">
                        <?php cetak($user->email)  ?>
                      </td>
                      <td>
                        <img src="<?php cetak(base_url('upload/avatars/'.$user->avatar)) ?>" alt="" width="64">
                      </td>
                      <td>
                        <?php cetak($user->username) ?>
                      </td>
                      <td>
                        <?php
                          if ($user->status == 'Active') {
                        ?>  
                            <div class="badge badge-success">
                              <?php cetak($user->status) ?>
                            </div>
                        <?php
                          }
                          else {
                        ?>
                            <div class="badge badge-danger">
                              <?php cetak($user->status) ?>
                            </div>
                        <?php
                          }
                        ?>
                      </td>
                      <td width="250">
                        <a href="<?php cetak(site_url('admin/users/edit/'.$user->user_id)) ?>" class="btn btn-small text-primary"><i class="fas fa-edit"></i> Edit</a>
                        <a onclick="deleteConfirm('<?php cetak(site_url('admin/users/delete/'.$user->user_id)) ?>')" href="#" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
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
  <script>
    function deleteConfirm(url) {
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
    }
  </script>
</body>

</html>