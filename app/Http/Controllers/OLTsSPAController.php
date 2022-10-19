<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationAttribute;

class OLTsSPAController extends Controller
{
    public function setupSPAPageRequestHander()
    {
        $data = [
            'client_logo' => ApplicationAttribute::getClientLogo()
        ];

        return view('index')->with($data);
    }
}
