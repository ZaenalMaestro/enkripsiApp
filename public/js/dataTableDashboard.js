$(document).ready(function () {
   $('#tabel-video').DataTable({
      "processing": true,
      "ajax": 'http://localhost:8080/show',
      "columns": [{
            "data": "nomor"
         },
         {
            "data": "nama_video"
         },
         {
            "data": "status"
         },
         {
            "data": "aksi"
         },

      ],
      "columnDefs": [{
            "targets": [0, 2, 3],
            "className": "text-center"
         },
         {
            "targets": 2,
            "width": "60px",
            "render": function (data, type, row) {
               if (data == 'enkripsi') {
                  return '<span class="badge badge-primary">Enkripsi</span>';
               } else {
                  return '<span class="badge badge-success">Dekripsi</span>';
               }
            }
         },
         {
            "targets": 3,
            "width": "200px",
            "render": function (data, type, row) {
               if (data.status == 'enkripsi') {
                  return `<button type="button" class="btn btn-sm btn-success to-dekripsi" data-id="${data.id}" data-name="${data.nama_video}" data-toggle="modal" data-target="#exampleModalCenter"> 
                                 <i class = "fas fa-unlock"></i> Dekripsi
                              </button>
                              <a href="video/${data.nama_video}" download class="btn btn-sm btn-danger ml-2">
                                 <i class="fas fa-download"></i><span> Download</span>
                              </a>`;
               } else {
                  return `<button type="button" class="btn btn-sm btn-primary to-enkripsi" data-id="${data.id}" data-name="${data.nama_video}" data-toggle="modal" data-target="#exampleModalCenter"> 
                                 <i class = "fas fa-unlock"></i> Enkripsi
                              </button>
                              <a href="video/${data.nama_video}" download class="btn btn-sm btn-danger ml-2">
                                 <i class="fas fa-download"></i><span> Download</span>
                              </a>`;
               }
            }
         }
      ]
   });
});