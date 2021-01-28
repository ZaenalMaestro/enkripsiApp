<?php

function isDirEmpty($dir)
{
   if (!is_readable($dir)) return NULL;
   return (count(scandir($dir)) == 2);
}

function delete_all_video_temp(){
   if (!isDirEmpty('video/temp')) {
      $files = glob('video/temp/*');
      foreach ($files as $file) {
         if (is_file($file)) {
            unlink($file);
         }
      }
   }
}
