<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jumbojett\OpenIDConnectClient;
use Illuminate\Support\Facades\DB;
use App\Repository\Azure\Api\GraphApiAccessTokenProvider;
use Microsoft\Graph\Graph;

class SiteController extends Controller
{

    public function home(Request $request, string $locale = 'nl'){
        return view('pages.home');
    }
    public function test(Request $request, string $locale = 'nl'){
        return view('pages.test');
    }
}