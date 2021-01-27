<?php
namespace App\Helpers\Facade;

use Illuminate\Support\Facades\Facade;

class FacadeCart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'test';
    }
}
