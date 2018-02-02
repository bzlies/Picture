<?php
namespace Bzlies\Picture;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Picture
{
    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        // constructor body
    }

    public static function size($image)
    {
        return list($width, $height, $type, $attr) = getimagesize($image);
    }

    /**
     * Creates all directories in the path given
     * 
     * @param  String $dirs  Slash separated path: netflix/strangerthings/eleven
     * @return String        The result of the created path
     */
    public static function preparePath($dirs)
    {
      $dirString = './';
      $dirsArray = explode('/', $dirs);
      foreach ($dirsArray as $dir) {
        try {
          $dirString .= $dir . '/';
          if (!file_exists($dirString)) {
            mkdir($dirString);
          }
        } catch (Exception $e) {
          dd($e);
        }
      }
      return $dirString;
    }


    public static function makePictureFromWidth($picture, $width, $newFileName = null, $path = '/', $maintainAspectRatio = false)
    { 
      $finalPath = self::preparePath($path);
      $image = Image::make($picture);
      $extension = $picture->getClientOriginalExtension();
      if ($maintainAspectRatio) {
          $image->resize($width, null, function($constraint) {
              $constraint->aspectRatio();
          });
      } else {
        $image = Image::make($picture);
      }
      $newImageName = !is_null($newFileName) ? $newFileName : time();
      $newImageName .= $newImageName . '.' . $extension;
      $finalPath .= DIRECTORY_SEPARATOR . $newImageName;
      $image->save($finalPath);
      return $finalPath;
    }

}

      // $extension = $picture->extension();
      // $newImageName = time() . '.' . $extension;

      // if (!file_exists($basePath)) {
      //   Storage::makeDirectory($basePath, 0755, true, true);
      // }
      // if (!file_exists($basePath . '/uploads')) {
      //   Storage::makeDirectory($basePath . '/uploads', 0755, true, true);
      // }
      // if (!file_exists($path)) {
      //   Storage::makeDirectory($path, 0755, true, true);
      // }
      // if ( !file_exists($pathLarge) ) {
      //   Storage::makeDirectory($pathLarge, 0755, true, true);
      // }

      // $image = Image::make($picture);
      // // $image->crop($cropDimension, $cropDimension);
      // // $image->save($pathSmall . '/' . $newImageName);
      // $image->resize($width, null, function($constraint) {
      //   $constraint->aspectRatio();
      // });
      // // $image->resize($width);
      // // $iamge->encode(100);
      // $image->save($pathLarge . '/' . $newImageName);
      // return $pathLarge . '/' . $newImageName;


