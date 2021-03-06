
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>School Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">
<?php 
include 'sidebar.php';
?>
      <div id="content-wrapper">

        <div class="container-fluid">

   <?php 
      if (isset($_POST['upload'])) {
        insert();
      }
      
      function insert(){
      include 'class/connect.php';
        if (isset($_FILES['file'])) 
            {  
               
               $file_name = $_FILES['file']['name'];
               $sizes = $_FILES['file']['size'];
               $types = $_FILES['file']['type'];
               $tmp = $_FILES['file']['tmp_name'];
               $folder_location = 'uploads/file/'.$file_name;
               $move = move_uploaded_file($tmp,$folder_location);
                
               if ($move) {
                  $name = $_POST['name'];
                   $qry = "INSERT INTO `downloads`(`name`, `file`) VALUES ('$name','$file_name')";
                   if (mysqli_query($conn,$qry)or die(mysqli_error($conn))) {
                      ?>
                      <div class="btn alert alert-info alert-dismissable flex-center" role="alert">
                          <button type="button " class="close" data-dismiss="alert" aria-label="close">
                          <?php echo $name ?> Document Was Uploaded 
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <?php
               }
               else{
                   ?>
                   <div class="btn btn-block alert alert-danger alert-dismissable" role="alert">
                          <button type="button " class="close" data-dismiss="alert" aria-label="close">
                          <strong>Failed !</strong>The Product failed to upload try again .
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                   <?php
               }
           }
        }
        else{
          echo "help";
        }
        mysqli_close($conn);
      }
                ?>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
            <div class="card-header">
              <h3 class="text-center">Downloads Form</h3>
            </div>
              <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Name of The file</label>
                    <input type="text" class="form-control-file" id="name" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlFile1">Example file input</label>
                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                  </div>
                  <button type="submit" name="upload" class="btn btn-primary btn-block">Add Download</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Created On</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Name</th>
                      <th>Status</th>
                      <th>Created On</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                  include'class/connect.php';
                  $qry = "SELECT * FROM `downloads`";
                  $exec = mysqli_query($conn,$qry);
                  while($result = mysqli_fetch_array($exec)){
                   
                    ?>
                  <tr>
                      <td><?php echo $result['name'] ?></td>
                      <td><?php echo $result['status'] ?></td>
                      <td><?php echo date("M jS, Y",strtotime($result['timestamp'])); ?></td>
                      <td>
                      <button class="delete btn btn-sm btn-danger" id='del_<?= $result['id'] ?>' style="padding: 2px;margin: 0px;margin-left:5px;">
                                          <i class="fa fa-trash"></i><span>
                                              
                                          </span>
                                      </button>
                      </td>
                    </tr>
                 <?php }
                  ?>
                    
                  </tbody>
                </table>

          </div>
        </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>School Admin</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="index.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <script src="../js/bootbox.js"></script>

    <!-- Demo scripts for this page-->
    <!-- <script src="js/demo/datatables-demo.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function(){
  // Delete 
  $('.delete').click(function(){
    var el = this;
    var id = this.id;
    var splitid = id.split("_");
    // Delete id
    var deleteid = splitid[1];
 
    // Confirm box
    bootbox.confirm("Are you sure want to delete?", function(result) {
 
       if(result){
         // AJAX Request
         $.ajax({
           url: 'delete.php',
           type: 'POST',
           data: { id:deleteid },
           success: function(response){
             // Removing row from HTML Table
             $(el).closest('tr').css('background','tomato');
             $(el).closest('tr').fadeOut(800, function(){ 
               $(this).remove();
             });
           }
         });
       }
 
    });
 
  });
});
    </script>
  </body>

</html>
