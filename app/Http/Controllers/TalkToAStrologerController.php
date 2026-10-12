<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AstrologerPage;

class TalkToAStrologerController extends Controller
{
    public function index()
    {
        return view('talk-to-astrologer', AstrologerPage::viewData('talk'));
    }
}
