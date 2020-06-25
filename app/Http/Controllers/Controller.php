<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function storeFiles($folderName, $requestName)
    {
        $name = \request()->file($requestName)->getClientOriginalName();
        Request::file($requestName)->move("/".$folderName, $name);
        return "/$folderName/" . $name;
    }
}
