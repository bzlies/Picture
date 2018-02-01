<?php
namespace Bzlies\Picture\Facades;
use Illuminate\Support\Facades\Facade;

class Picture extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Picture';
    }
}
