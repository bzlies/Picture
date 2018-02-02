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


  public static function createFromWidth($picture, $width, $name, $path)
  {
    $options = [
      'name' => $name,
      'path' => $path,
      'action' => 'resize',
      'width' => $width,
      'height' => null,
      'maintainAspectRatio' => true,
      'quality' => 90,
    ];
    return self::_makePicture($picture, $options);
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

  /**
   * Método principal da classe, cria uma imagem e transfere
   * para o local desejado
   *
   * @param Array $options
   */
  public static function _makePicture($picture, $options = [
    'name' => 'boooo',
    'path' => 'uploads',
    'action' => 'resize',
    'width' => 300,
    'height' => null,
    'maintainAspectRatio' => true,
    'quality' => 90,
  ])
  {
    $pictureDestinationPath = self::preparePath($options['path']);
    $extension = $picture->getClientOriginalExtension();
    $image = Image::make($picture);

    switch ($options['action']) {
      case 'crop':
        # code...
        break;
      case 'resize':
        if ($options['maintainAspectRatio']) {
          $image->resize($options['width'], null, function($constraint) {
            $constraint->aspectRatio();
          });
        } else {
          $image->resize($options['width'], $options['height']);
        }
        break;
      default:
        # code...
        break;
    }

    $finalPath = $pictureDestinationPath .
                  '/' .
                  $options['name'] . '.' . $extension;
    $image->save($finalPath);
    return $finalPath;
  }

}



