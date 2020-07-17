<?php
if (!function_exists('photo_profile')) {
    function photo_profile()
    {
        $files = glob(ROOTPATH . 'public/uploads/profile*');
        if (count($files)) {
            $location = $files[0];
        } else {
            $location = ROOTPATH . 'public/uploads/demo.jpg';
        }

        $data = fopen($location, 'rb');
        $size = filesize($location);
        $contents = fread($data, $size);
        fclose($data);
        return 'data:image/jpg;base64,' . base64_encode($contents);
    }
}

/* 
 * Created by Pudyasto Adi Wibowo
 * Email : pawdev.id@gmail.com
 * pudyasto.wibowo@gmail.com
 */
