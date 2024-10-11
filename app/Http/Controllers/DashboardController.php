<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function render() : View {
        $user = Auth::user();
        $companies = $user->companies()->get();
        return view('pages.dashboard.home.index', compact('user', 'companies'));
    }
}
