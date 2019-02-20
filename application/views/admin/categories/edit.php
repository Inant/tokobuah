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
            <a href="<?php echo site_url('admin/categories/')?>"><i class="fas fa-arrow-left"></i> Back</a>
          </div>
          <div class="card-body">
            <form action="<?php base_url('admin/categories/edit') ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value = "<?php echo $category->id ?>">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control <?php echo form_error('name') ? 'is-invalid' :  '' ?>" placeholder="Product name" value="<?php echo $category->category_name ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('name') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="image">Image</label><br>  
                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small> <br>
                <input type="file" name="image" id="image" class="form-control-file <?php echo form_error('image') ? 'is-invalid' :  '' ?>" value="<?php echo set_value('image') ?>">
                <input type="hidden" name="old_image" value="<?php echo $category->image ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('image') ?>
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