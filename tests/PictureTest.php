<?php
namespace Bzlies\Picture\tests;
use Orchestra\Testbench\TestCase;
use Bzlies\Picture\Picture;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureTest extends TestCase
{
  public $picture = __DIR__ . '/2721.jpg';
  public $testPath = __DIR__ .'/uploads/pictures/allofthem/';

  public $publicPath = '.\\';
  public $finalPath = '.\\' . DIRECTORY_SEPARATOR . 'uploads';
  public $finalPicturePath = '.\\' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'picture.jpg';
  public $newName = 'picture';
  /**
   * Setup the test environment.
   */
  protected function setUp()
  {
    parent::setUp();
    $this->rrmdir('.tests\uploads');
    // rmdir($this->publicPath);
    // rmdir($this->publicPath . '/uploads');
      // Your code here
  }

  protected function getPackageProviders($app)
  {
    return [
      \Bzlies\Picture\PictureServiceProvider::class,
      \Intervention\Image\ImageServiceProvider::class
    ];
  }

  protected function getPackageAliases($app)
  {
    return [
      'Picture' => Bzlies\Picture\Facades\Picture::class,
      'Image' => Intervention\Image\Facades\Image::class,
      'Storage' => Illuminate\Support\Facades\Storage::class,
    ];
  }

  public function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object);
       }
     }
     rmdir($dir);
   }
  }

  public function makeTestFile()
  {
    return new UploadedFile($this->picture, $this->picture);
  }

  public function test_create_whole_path()
  {
    $testPath = 'tests/uploads/netflix/garbage';
    $test = Picture::preparePath($testPath);
    $this->assertDirectoryExists($testPath, '$testPath ' . $testPath , ' existe');
    $this->assertEquals('./tests/uploads/netflix/garbage/', $test);
    // $this->delTree('./tests/uploads');
  }

  public function test_make_picture()
  {
    $options = [
      'name' => 'picture',
      'path' => $this->testPath,
      'action' => 'resize',
      'width' => 300,
      'height' => null,
      'maintainAspectRatio' => true,
      'quality' => 90,
    ];
    Picture::_makePicture($this->makeTestFile(), $options);
    $this->assertFileExists('uploads/picture/long/path/picture.jpg');
  }


  // public function delTree($dir) {
  //  $files = array_diff(scandir($dir), array('.','..'));
  //   foreach ($files as $file) {
  //     (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
  //   }
  //   return rmdir($dir);
  // }
}
