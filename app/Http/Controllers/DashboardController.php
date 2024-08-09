<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

use App\Models\Stream;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // dd('dashboard');
        $totalStream = Stream::all();
        $totalSubject = Subject::all();
        $totalTeacher = User::role('teacher')->get();
        return view('dashboard', compact('totalStream', 'totalSubject', 'totalTeacher'));
    }
}
