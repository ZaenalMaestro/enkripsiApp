<footer class="sticky-footer bg-white">
   <div class="container my-auto">
      <div class="copyright text-center my-auto">
         <span>Copyright © Alriadi Try Putra 2021</span>
      </div>
   </div>
</footer>

</div>
</div>

<!-- scroll navigation -->
<a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
   <i class="fas fa-angle-up"></i>
</a>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Dekripsi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <!-- form update data -->
         <form method="post" class="update-data">
            <div class="modal-body">

               <!-- prograssbar -->
               <div class="progress d-none" id="pb-modal">
                  <div class="progress-bar pb-modal progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25</div>
               </div>
               <!-- endprogressbar -->

               <!-- nama video-->
               <div class="form-group">
                  <label for="formGroupExampleInput"><b>File</b></label>
                  <input type="text" class="form-control" id="judul-video" disabled>
               </div>
               <!-- masukkan key -->
               <div class="form-group">
                  <label for="keys"><b>Key</b></label>
                  <input type="password" maxlength="25" class="form-control key-update" placeholder="Masukkan key..." autocomplete="false" name="key">
                  <div class="invalid-feedback" id="kunci-video">
                     placeholder
                  </div>
               </div>

               <input type="hidden" name="id" class="id-video">
               <button type="button" class="btn btn-block tombol"></button>
            </div>

         </form>
         <!-- end form -->

      </div>
   </div>
</div>
<!-- end modal -->


<!-- Bootstrap core JavaScript-->
<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>