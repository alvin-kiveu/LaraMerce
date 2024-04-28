<?php

namespace Plugins\MyApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testController()
    {
        return 'This is a test controller';
    }
}
