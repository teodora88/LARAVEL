<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as HandleController;

class Controller extends HandleController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
