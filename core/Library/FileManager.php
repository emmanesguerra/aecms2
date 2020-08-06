<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Library;

/**
 * Description of FileSystem
 *
 * @author alvin
 */

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class FileManager
{
    public static function MoveFiles($disk, $filename, $key, $year, $month)
    {
        $exists = Storage::disk('temporary')->exists($filename);
        if($exists) {
            $file = Storage::disk('temporary')->get($filename);
            Storage::disk($disk)->put("$year/$month/$key/$filename", $file);
            Storage::disk('temporary')->delete($filename);
        }
        
        return;
    }
    
    public static function ResizeAndSave($file, $width, $newname, $disk, $folder = '')
    {
        $manager = new ImageManager(array('driver' => 'imagick'));

        $image = $manager->make($file);
        if($image->width() > $width) {
            self::Resize($image, $width, $newname);
                
            Storage::disk($disk)->put($folder.$newname, $image);
        } else {
            Storage::disk($disk)->put($folder.$newname, file_get_contents($file));
        }
        
        return;
    }
    
    public static function Resize(Image $image, $width, $newname)
    {
        return  $image->orientate()
                        ->resize($width, null, function($constraint){ 
                            $constraint->upsize();
                            $constraint->aspectRatio();
                        })->save($newname);
    }
}
