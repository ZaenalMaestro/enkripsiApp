<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">


   <!-- form enkripsi video -->
   <div class="col-xl-6 col-md-6 mb-1">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Enkripsi Video</h6>
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
                  <label for="formGroupExampleInput"><b>Key Enkripsi</b></label>
                  <input type="password" maxlength="25" id="key_twofish" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan key..." autocomplete="false">
                  <div class="invalid-feedback" id="error-key">
                     placeholder
                  </div>
               </div>

               <!-- tombol ekripsi dan dekripsi -->
               <div class="btn-group btn-block mt-3" role="group">
                  <button type="button" class="btn btn-primary enkripsi">Enkripsi</button>
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
            <h6 class="m-0 font-weight-bold text-primary">Video Preview</h6>
         </div>

         <div class="progress d-none progress-preview" style="border-radius: 0%;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
         <h3 class="my-auto mx-auto" id="teks-video">Video preview</h3>
         <video id="preview" class="d-none" controls="controls" style="border-color:1px solid #fff;height: 258px">
         </video>

      </div>
   </div>
   <!-- end form video preview -->

</div>


<div class="row">
   <div class="col-md-12">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Video</h6>
         </div>
         <div class="card-body">
            <!-- table daftar file ter-enkripsi -->
            <div class="table-responsive">
               <table id="tabel-video" class="table table-striped table-bordered display" style="width:100%">
                  <thead>
                     <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama Video</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                     </tr>
                  </thead>
                  <tbody class="table-video"></tbody>
               </table>
            </div>

            <!-- end table -->

         </div>
      </div>
   </div>
</div>


<script src="js/sweetalert2.js"></script>
<script src="js/request-ajax.js"></script>
<script src="js/update-data.js"></script>

<script src="js/jquery.js"></script>

<script src="js/dataTables.js"></script>
<script src="js/dataTables.bootstrap4.js"></script>
<!-- menampilkan data -->
<script src="js/dataTableDashboard.js"></script>

<?= $this->endSection() ?>