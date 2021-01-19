<div class="table-responsive mt-5">
   <table id="tabel-video" class="table table-striped table-bordered" style="width:100%">
      <thead>
         <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nama Video</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php $no = 1;
         foreach ($data as $video) : ?>
            <tr>
               <td class="text-center"><?= $no++ ?></td>
               <td class="text-justify"><?= $video['nama_video'] ?></td>
               <td class="text-center"><span class="badge badge-<?= ($video['status'] == 'enkripsi') ? 'primary' : 'success' ?>"><?= $video['status'] ?></span></td>
               <td class="text-center">
                  <?php if ($video['status'] == 'enkripsi') : ?>
                     <a href="#" class="btn btn-sm btn-success">Dekripsi</a>
                  <?php else : ?>
                     <a href="#" class="btn btn-sm btn-primary">Enkripsi</a>
                  <?php endif ?>
                  <a href="#" class="btn btn-sm btn-info">Download</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>