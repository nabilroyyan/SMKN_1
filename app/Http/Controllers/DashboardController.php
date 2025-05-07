<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalPelanggaran = Pelanggaran::count();
        return view('dashboard', compact('totalPelanggaran'));
    }
}
