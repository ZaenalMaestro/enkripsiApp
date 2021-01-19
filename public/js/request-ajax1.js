const uploadForm = document.querySelector('.uploadForm');
const file_video = document.querySelector('#file_video');

uploadForm.addEventListener('submit', function (e) {
   e.preventDefault();

   const xhr = new XMLHttpRequest();

   xhr.open('POST', 'http://localhost:8080/tes');
   xhr.upload.addEventListener('progress', e => {
      const percent = e.lengthComputable ? (e.loaded / e.total) * 100 : 0;
      const progress = document.querySelector('.progress-bar');
      progress.style.width = percent.toFixed(0) + '%';
      progress.textContent = percent.toFixed(0) + '%';

   });

   xhr.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
         Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Video Berhasil di-enkripsi',
            showConfirmButton: false,
            timer: 2000
         });
      }
   }

   const fileField = document.querySelector('input[type="file"]');
   formData = new FormData()
   formData.append('video', fileField.files[0]);
   formData.append('key', '2323');

   xhr.send(formData);

})