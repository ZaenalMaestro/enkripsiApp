<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row">
   <!-- form enkripsi video -->
   <div class="col-xl-6 col-md-6 mb-1">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Pengujian</h6>
         </div>
         <div class="card-body">
            <!-- prograssbar -->
            <div class="progress d-none">
               <div class="progress-bar pb-dashboard progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- endprogressbar -->

            <!-- video -->
            <video id="preview" class="d-none" width="506px" height="218px" controls="controls" style="border:0;">
            </video>
            <!-- end video -->

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
                  <label for="formGroupExampleInput"><b>Key</b></label>
                  <input type="password" id="key_twofish" maxlength="25" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan key..." autocomplete="false">
                  <div class="invalid-feedback" id="error-key">
                     placeholder
                  </div>
               </div>

               <!-- tombol pengujian -->
               <button type="button" class="btn btn-block btn-success pengujian">Mulai Pengujian</button>
            </form>
         </div>
      </div>
   </div>
   <!-- end form enkripsi -->

   <!-- Data uji -->
   <div class="col-xl-6 col-md-6 mb-1">
      <div class="card shadow mb-2">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Pengujian</h6>
         </div>

         <div class="card-body" style="height: 242px">
               <table cellpadding="10">
                  <tr>
                     <td><b>Nama Video</b></td>
                     <td>:</td>
                     <td class="nama_file" style="width: 200px">-</td>
                  </tr>
                  <tr>
                     <td><b>Ukuran Video</b></td>
                     <td>:</td>
                     <td class="ukuran_file">-</td>
                  </tr>
                  <tr>
                     <td><b>Kecepatan Enkripsi</b></td>
                     <td>:</td>
                     <td class="kecepatan_enkripsi">-</td>
                  </tr>
                  <tr>
                     <td><b>Kecepatan Dekripsi</b></td>
                     <td>:</td>
                     <td class="kecepatan_dekripsi">-</td>
                  </tr>
               </table>
         </div>

      </div>
   </div>
   <!-- end data uji -->

</div>

<div class="row">
   <div class="col-md-12">
      <div class="card shadow mb-2">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Hasil Pengujian</h6>
         </div>
         <div class="card-body">
            <!-- table daftar file ter-enkripsi -->
            <div class="table-responsive">
               <table id="tabel-video" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama Video</th>
                        <th class="text-center">Ukuran Video</th>
                        <th class="text-center">Kecepatan Enkripsi</th>
                        <th class="text-center">Kecepatan Dekripsi</th>
                     </tr>
                  </thead>
                  <tbody class="tabel-video">

                  </tbody>
               </table>
            </div>
            <!-- end table -->

         </div>
      </div>
   </div>
</div>


<!-- script js -->
<script src="js/sweetalert2.js"></script>
<script src="js/pengujian.js"></script>

<script src="js/jquery.js"></script>
<script src="js/dataTables.js"></script>
<script src="js/dataTables.bootstrap4.js"></script>

<!-- menampilkan data -->
<script src="js/dataTableTesting.js"></script>

<?= $this->endSection() ?>