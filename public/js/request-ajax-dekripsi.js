// baseurl
let baseurl = 'http://localhost:8080';

// video preview
const input = document.getElementById('file_video');
const video = document.getElementById('preview');

// inisilisasi formdata
const formData = new FormData();

/*
 * mengambil file video dan key enkripsi
 */
const fileField = document.querySelector('input[type="file"]');
const key_twofish = document.querySelector('#key_twofish');

// ketika tombol dekripsi diklik
const buttonDekripsi = document.querySelector('.dekripsi');
buttonDekripsi.addEventListener('click', function () {
   // validasi input
   if (validateErrors(fileField, key_twofish) == false) {
      formData.append('video', fileField.files[0]);
      formData.append('key', key_twofish.value);
      xhrRequest(baseurl + '/dekripsi', 'POST', formData, 'dekripsi');
   }
});


// validasi input
function validateErrors(fileField, key_twofish, video) {
   let pesanError = {};

   //validasi file input 
   if (fileField.files[0] == undefined) {
      pesanError.video = 'File tidak boleh kosong';
   } else if (fileField.files[0].type != 'video/mp4') {
      pesanError.video = 'Format file bukan .mp4';
   } else if (fileField.files[0].size > 5242880) {
      pesanError.video = 'file upload maksimal 5 Mb';
   }


   // validasi key input
   if (key_twofish.value == '') {
      pesanError.key = 'Key tidak boleh kosong';
   } else if (key_twofish.value.length < 8) {
      pesanError.key = 'Key minimal 8 karakter';
   }

   /*
   return true : jika ada pesan error
   return false : jika tidak ada pesan error
   */
   return tampilError(pesanError, fileField, key_twofish);
}

// tampilkan pesan error
function tampilError(pesanError, fileField, key_twofish) {
   if (pesanError.hasOwnProperty('video') == true || pesanError.hasOwnProperty('key') == true) {
      if (pesanError.hasOwnProperty('video')) {
         fileField.classList.add('is-invalid');
         document.getElementById('error-video').innerHTML = pesanError.video
      } else {
         fileField.classList.remove('is-invalid');
      }

      if (pesanError.hasOwnProperty('key')) {
         key_twofish.classList.add('is-invalid');
         document.getElementById('error-key').innerHTML = pesanError.key
      } else {
         key_twofish.classList.remove('is-invalid');
      }
      return true;
   } else {
      fileField.classList.remove('is-invalid');
      key_twofish.classList.remove('is-invalid');
      return false;
   }
}

// melakukan request ajax
function xhrRequest(url, request, fileField, pesan) {
   const xhr = new XMLHttpRequest();
   if (request.toLowerCase() == 'post') {
      const progressbar = document.querySelector('.progress-enkripsi');

      xhr.open(request, url);
      xhr.upload.addEventListener('progress', e => {
         const percent = e.lengthComputable ? (e.loaded / e.total) * 99 : 0;
         progressbar.classList.add('d-block');
         const progress = document.querySelector('.pb-dashboard');
         progress.style.width = percent.toFixed(0) + '%';
         progress.textContent = percent.toFixed(0) + '%';

      });

      xhr.onload = function () {
         input.value = null;
         key_twofish.value = '';
         if (this.readyState == 4 && this.status == 200) {
            const respond = JSON.parse(xhr.responseText);

            progressbar.classList.remove('d-block');
            progressbar.classList.add('d-none');          

            if (respond.status === 200) {
               const judulVideo = document.querySelector('.judul-video');
               judulVideo.classList.remove('d-none');
               judulVideo.textContent = respond.nama_video

               const downloadVideo = document.querySelector('.download-video');
               downloadVideo.classList.remove('d-none')
               downloadVideo.setAttribute('href', respond.link_download)

               Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Video Berhasil di-' + pesan,
                  showConfirmButton: false,
                  timer: 2000
               });
            } else {
               progressbar.classList.replace('d-block', 'd-none');
               progressbar.classList.add('d-none');

               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Video Tidak dapat di-' + pesan,
                  showConfirmButton: false,
                  timer: 2000
               });
               setTimeout(() => location.reload(), 3000);
            }
         }
      }
      xhr.send(fileField);
   } 
}


