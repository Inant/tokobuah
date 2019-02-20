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
          if ($this->session->flashdata('success')) {
              ?>
            <div class="alert alert-success" role="alert">
              <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php
          }
        ?>

        <div class="card mb-3">
          <div class="card-header"> 
            <a href="<?php echo site_url('admin/categories/create')?>"><i class="fas fa-plus"></i> Add New</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categories as $category) : ?>
                    <tr>
                      <td width="150">
                        <?php cetak($category->category_name) ?>
                      </td>
                      <td>
                        <img src="<?php cetak(base_url('upload/categories/'.$category->image)) ?>" alt="" width="64">
                      </td>
                      <td width="250">
                        <a href="<?php cetak(site_url('admin/categories/edit/'.$category->id)) ?>" class="btn btn-small text-primary"><i class="fas fa-edit"></i> Edit</a>
                        <a onclick="deleteConfirm('<?php cetak(site_url('admin/categories/delete/'.$category->id)) ?>')" href="#" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
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