<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Job_seeker;
use App\Models\Category;
use App\Models\Seeking_Category;
use Illuminate\Support\Facades\Auth;


class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $user = User::with('Job_seeker')->where('id',$id)->firstOrFail();
        return view('profile.index', compact('user'));
    }

    public function download($file){
        $url = storage_path('app/public/uploads/'.$file);
        $download=DB::table('Job_seekers')->get();
        return response()->download($url);
    }


    public function manage(){
        $categories = DB::table('categories')
        ->get();
        return view('profile.aanvullen', compact('categories'));
    }

    public function create(Request $request){

        $request->validate([
            'portfolio' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048',
            'motivation' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);


            $user_motivation = Auth::user()->Job_seeker->motivation ?? FALSE;
            $user_portfolio = Auth::user()->Job_seeker->portfolio ?? FALSE;

            if($user_motivation && $request->motivation || $user_portfolio && $request->portfolio){
                $this->delete($request);
            }


            $fileModel = new Job_seeker;

            if($request->file()) {

                $fileName = time().'_'.$request->file('portfolio')->getClientOriginalName();
                $fileName2 = time().'_'.$request->file('motivation')->getClientOriginalName();


                $request->file('portfolio')->storeAs('uploads', $fileName, 'public');
                $request->file('motivation')->storeAs('uploads', $fileName2, 'public');
                $fileModel->portfolio = time().'_'.$request->file('portfolio')->getClientOriginalName();
                $fileModel->motivation = time().'_'.$request->file('motivation')->getClientOriginalName();
                $fileModel->user_id = Auth::user()->id;


                $fileModel->save();

                return back();
            }
            return view('profile.index');
    }

    public function delete($request){
        $portfolio = Auth::user()->Job_seeker->portfolio;
        $motivation = Auth::user()->Job_seeker->motivation;
        if($request->file('portfolio') && $request->file('motivation')){
                unlink(storage_path('app/public/uploads/'.$portfolio));
                unlink(storage_path('app/public/uploads/'.$motivation));
                DB::table('job_seekers')->where('user_id',Auth::user()->id)->delete();
                return;
        }
    }

    public function createCat(Request $request){
        $request->validate([
            'category' => 'required'
            ]);

        $categories = Category::select("id")->where("category", request('category'))->first();
        dd($categories);
        $catExists = DB::table('seeking__categories')
        ->where('seeker_id', '=', Auth::user()->Job_seeker->id)
        ->where('category_id', '=', $categories->id)
        ->get();
        if(!$catExists){
            $seeking_category = new Seeking_Category;
            $seeking_category->category_id = $categories->id;
            $seeking_category->seeker_id = Auth::user()->job_seeker->id;
            $seeking_category->save();
        }
        dd($categories);
        // $categories moeten alle categories zijn. geeft error in profiel.aanvullen
        return view("profile.aanvullen", compact('categories'));
    }
}
