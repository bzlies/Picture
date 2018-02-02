<?php
namespace Bzlies\Picture\tests;
use Orchestra\Testbench\TestCase;
use Bzlies\Picture\Picture;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureTest extends TestCase
{
  public $picture = '.\tests\2721.jpg';
  public $publicPath = '.\tests';
  public $finalPath = '.\tests' . DIRECTORY_SEPARATOR . 'uploads';
  public $finalPicturePath = '.\tests' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'picture.jpg';
  public $newName = 'picture';
  /**
   * Setup the test environment.
   */
  protected function setUp()
  {
    parent::setUp();
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

  // public function test_creates_directories()
  // {
  //   $this->assertDirectoryNotExists($this->publicPath, 'O diretório público nao existe');
  //   Picture::createUploadDir($this->publicPath, '/uploads');
  //   $this->assertDirectoryExists($this->publicPath, 'Diretorio publico criado');
  //   rmdir($this->publicPath, true);
  // }

  // public function test_moves_picture()
  // {
  //   $picture = new UploadedFile($this->picture, $this->picture);

  //   $this->assertFileNotExists($this->finalPicturePath, 'The picture is not in its place');
  //   Picture::makePictureFromWidth($picture, 300, $this->newName, $this->finalPath, true);
  //   $this->assertFileExists($this->finalPicturePath, 'the picture exists!');
  // }
  // 
  public function test_create_whole_path()
  {
    $testPath = 'tests/uploads/netflix/garbage';
    $test = Picture::preparePath($testPath);
    $this->assertDirectoryExists('tests/uploads', 'Uploads existe');
    $this->assertDirectoryExists('tests/uploads/netflix', 'netflix existe');
    $this->assertDirectoryExists($testPath, '$testPath ' . $testPath , ' existe');
    $this->assertContains($test, './' .$testPath, 'test ' . $test . ' e ' . $testPath);
    $this->delTree('./tests/uploads');
  }


  public function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  } 
}
