<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AstrologerPage;

class ChatWithAStrologerController extends Controller
{
    public function index()
    {
        return view('chat-with-astrologer', AstrologerPage::viewData('chat'));
    }

    public function report()
    {
        return view('dasha-calculator-report', AstrologerPage::viewData('chat'));
    }
}
