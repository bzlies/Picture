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

    public static function sayHello($name)
    {
        return 'Hello ' . $name;
    }

    public static function makeDirs()
    {

    }

    public static function size($image)
    {
        return list($width, $height, $type, $attr) = getimagesize($image);
    }


    public function _createPublicDir($path)
    {
        if (!file_exists($path))
        {
            Storage::makeDirectory($path);
        }
    }

    public static function createUploadDir($publicPath, $newDirName)
    {
        if (Storage::exists($publicPath)) {
            Storage::makeDirectory(directory);
        } else {
            echo 'O diretório publico não existe';
        }

        if (Storage::exists($publicPath . '/' . $newDirName)) {
            echo 'O diretório uploads existe';
        } else {
            echo 'O diretório uploads NAO existe';
        }

    }

    public static function makePictureFromWidth($picture, $width, $path = '/', $maintainAspectRatio = false)
    {
        $image = Image::make($picture);
        if ($maintainAspectRatio) {
            $image->resize($width, null, function($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image = Image::make($picture);
        }
        $extension = $picture->extension();
        $newImageName = time() . '.' . $extension;
        $image->save($pathLarge . '/' . $newImageName);
        return $pathLarge . '/' . $newImageName;
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


