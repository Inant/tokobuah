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
            <a href="<?php echo site_url('admin/products/')?>"><i class="fas fa-arrow-left"></i> Back</a>
          </div>
          <div class="card-body">
            <form action="<?php echo base_url('admin/products/add') ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control <?php echo form_error('name') ? 'is-invalid' :  '' ?>" placeholder="Product name" value="<?php echo set_value('name') ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('name') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control <?php echo form_error('price') ? 'is-invalid' :  '' ?>" placeholder="Product price" value="<?php echo set_value('price') ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('price') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="category">Categories</label>
                <select id="category" name="category" class="form-control <?php echo form_error('category') ? 'is-invalid' :  '' ?>">
                  <option value="">Pilih kategori</option>
                  <?php
                    foreach ($categories as $category) {
                        ?>
                      <option value="<?php echo $category->id ?>" <?php echo $category->id == set_value('category') ? 'selected' : '' ?> ><?php echo $category->category_name ?></option>
                  <?php
                    }
                  ?> 
                </select>
                <div class="invalid-feedback">
                  <?php echo form_error('category') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file <?php echo form_error('image') ? 'is-invalid' :  '' ?>" value="<?php echo set_value('image') ?>">
                <div class="invalid-feedback">
                  <?php echo form_error('image') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control <?php echo form_error('description') ? 'is-invalid' : '' ?> "><?php echo set_value('description') ?></textarea>
                <div class="invalid-feedback">
                  <?php echo form_error('description') ?>
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
   <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
</body>

</html>