<?php
namespace Bzlies\Picture\tests;
use Orchestra\Testbench\TestCase;
use Bzlies\Picture\Picture;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureTest extends TestCase
{
  public $picture = '.\tests\2721.jpg';
  public $publicPath = '.\tests\public';
  public $finalPath = '.\tests\public' . DIRECTORY_SEPARATOR . 'uploads';
  public $finalPicturePath = '.\tests\public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . '2721.jpg';
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

  public function test_moves_picture()
  {
    $picture = new UploadedFile($this->picture, $this->picture);

    $this->assertFileNotExists($this->finalPicturePath, 'The picture is not in its place');
    Picture::makePictureFromWidth($picture, 300, $this->newName, $this->finalPath, true);
    $this->assertFileExists($this->finalPicturePath, 'the picture exists!');
  }



}
