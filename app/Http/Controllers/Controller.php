<?php

namespace App\Http\Controllers;
use App\Http\Middleware\LogUserActivity;
use Illuminate\Routing\Controller as BaseController;
abstract class Controller
{
}
// Record user Activities
class Controllers extends BaseController
{
    public function __construct()
    {
        $this->middleware(LogUserActivity::class);
    }
}