<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Job_seeker;
use App\Models\User;
use App\Models\Seeking_Category;



class JobSeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $users = DB::table('users')
            ->join('job_seekers', 'users.id', '=', 'job_seekers.user_id')
            ->join('seeking__categories', 'job_seekers.id', '=', 'seeking__categories.seeker_id')
            ->join('categories', 'seeking__categories.id', '=', 'categories.id')
            ->get();

        return view('jobSeeker.board', compact('users'));
    }

    public function search(Request $request){
        $request->validate([
            'search' => 'nullable'
            ]);
        $users = DB::table('users')
        ->join('job_seekers', 'users.id', '=', 'job_seekers.user_id')
        ->join('seeking__categories', 'job_seekers.id', '=', 'seeking__categories.seeker_id')
        ->join('categories', 'seeking__categories.category_id', '=', 'categories.id')
            ->where('users.first_name','LIKE', '%'.$request->search.'%')
            ->OrWhere('users.last_name','LIKE','%'.$request->search.'%')
            ->OrWhere('categories.category','LIKE','%'.$request->search.'%')
        ->get();
        return view('jobseeker.board',compact('users'));
    }
}
