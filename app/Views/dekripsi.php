<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">


   <!-- form enkripsi video -->
   <div class="col-xl-6 col-md-6 mb-1">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Dekripsi Video</h6>
         </div>
         <div class="card-body">
            <!-- prograssbar -->
            <div class="progress d-none progress-enkripsi" style="border-radius: 0%;">
               <div class="progress-bar pb-dashboard progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- endprogressbar -->

            <form method="POST">
               <!-- pilih file -->
               <div class="form-group">
                  <label for="formGroupExampleInput"><b>File</b></label><br>
                  <input type="file" class="form-control-file" id="file_video">
                  <div class="invalid-feedback" id="error-video">
                     placeholder
                  </div>
               </div>

               <!-- masukkan key -->
               <div class="form-group">
                  <label for="formGroupExampleInput"><b>Key Dekripsi</b></label>
                  <input type="password" maxlength="25" id="key_twofish" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan key..." autocomplete="false">
                  <div class="invalid-feedback" id="error-key">
                     placeholder
                  </div>
               </div>

               <!-- tombol ekripsi dan dekripsi -->
               <div class="btn-group btn-block mt-3" role="group">
                  <button type="button" class="btn btn-success dekripsi">Dekripsi</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- end form enkripsi -->

   <!-- form  video  preview-->
   <div class="col-xl-6 col-md-6 mb-1">
      <div class="card shadow mb-4" style="height: 312px">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Download Video</h6>
         </div>

         <div class="card-body text-center">
            <h5 class="mb-5 mt-4 d-none judul-video"></h5>
            <a class="btn btn-danger d-none download-video download">
               <i class="fas fa-download"></i>
               Download
            </a>

            <div class="progress d-none mt-4 pb-show" style="border-radius: 0%;">
               <div class="progress-bar pb-download progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
         </div>
      </div>
   </div>
   <!-- end form video preview -->

</div>



<script src="js/sweetalert2.js"></script>
<script src="js/request-ajax-dekripsi.js"></script>

<script src="js/jquery.js"></script>

<script src="js/dataTables.js"></script>
<script src="js/dataTables.bootstrap4.js"></script>
<!-- menampilkan data -->
<script src="js/dataTableDashboard.js"></script>

<?= $this->endSection() ?>