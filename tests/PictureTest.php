<?php
namespace Bzlies\Picture\tests;
use Orchestra\Testbench\TestCase;
use Bzlies\Picture\Picture;

class PictureTest extends TestCase
{
  public $picture = './tests/2721.jpg';
  public $publicPath = './tests/public';

  /**
   * Setup the test environment.
   */
  protected function setUp()
  {
      parent::setUp();

      // Your code here
  }

  protected function getPackageProviders($app)
  {
    return 'Bzlies\Picture\PictureServiceProvider';
  }

  protected function getPackageAliases($app)
  {
    return [
        'Picture' => 'Bzlies\Picture',
        'Storage' => Illuminate\Support\Facades\Storage::class,
    ];
  }

  public function test_creates_directories()
  {
    $this->assertDirectoryDoesntExists($this->publicPath, 'O diretório público nao existe');
    // Picture::_createPublicDir($this->publicPath);
  }


}
