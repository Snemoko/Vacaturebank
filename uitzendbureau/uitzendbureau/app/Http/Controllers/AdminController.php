<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advert;
use App\Models\Company;
use App\Models\Job_offer;
use App\Models\Job_seeker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->roll == 0){
            return view('admin.index');
        }
        return view('home');
    }

    public function UserView(){
        $users = User::all();
        if(Auth::user()->roll == 0){
            return view('admin.users',compact('users'));
        }
        return view('home');


    }

    public function UserRemove(Request $request){
        $request->validate([
            'id' => 'required'
        ]);
        if(Auth::user()->id == $request->id){
            $melding = "Je kan niet je eigen profiel verwijderen";
            $users = User::all();
            return view('admin.users', compact('melding','users'));
        }

        if(Company::select()->where('user_id',$request->id)->first() && Auth::user()->roll == 0){
            $company = Company::select()->where('user_id',$request->id)->first();
            if(Advert::all()->where('user_id', $request->id)->first()){
                $ad = Advert::all()->where('user_id', $request->id)->first();
                File::delete(public_path('image/ad/'.$ad->text));
                Advert::select()->where('id',$request->id)->delete();
            }
            Company::select()->where('user_id', $request->id)->delete();
        }else if(Job_seeker::select()->where('user_id', $request->id)->first() && Auth::user()->roll == 0){
            $seeker = Job_seeker::select()->where('user_id', $request->id)->first();
            $portfolio = $seeker->portfolio;
            $motivation = $seeker->motivation;
            if($portfolio == $motivation){
                unlink(storage_path('app/public/uploads/'.$portfolio));
            }else{
                unlink(storage_path('app/public/uploads/'.$portfolio));
                unlink(storage_path('app/public/uploads/'.$motivation));
            }

            DB::table('job_seekers')->where('user_id',$request->id)->delete();
        }
        User::select()->where('id',$request->id)->delete();
        return redirect()->back();
    }

    public function AdvertView(){
        if(Auth::user()->roll == 0){
            $ads = Advert::all();
            return view('admin.advert',compact('ads'));
        }else{
            return view('home');
        }
    }

    public function AdvertDelete(Request $request){
        $ad =Advert::select()->where('id',$request->id)->first();
        if($ad && Auth::user()->roll == 0){

            $request->validate([
                'id' => 'required',
                'text' => 'required'
            ]);
            File::delete(public_path('image/ad/'.$ad->text));
            Advert::select()->where('id',$request->id)->delete();
        }
        return redirect()->back();
    }

    public function CompanyView(){
        if(Auth::user()->roll == 0){
            $companys = Company::all();
            return view('admin.company', compact('companys'));
        }else{
            return view('home');
        }

    }

    public function CompanyDelete(Request $request){
        if(Auth::user()->roll == 0){
        Company::select()->where('id', $request->id)->delete();
        }
        return redirect()->back();
    }

    public function VacatureView(){
        if(Auth::user()->roll == 0){
        $job_offers = Job_offer::all();
        return view('admin.vacatures',compact('job_offers'));
        }else{
            return view('home');
        }
    }

    public function VacatureDelete(Request $request){
        if(Auth::user()->roll§ == 0){
            $request->validate([
                'id' => 'required'
            ]);
            $offer_files = Job_Offer::select('labor_contract', 'working_conditions', 'contract', 'dismissal', 'health_safety')->where('id', $request->id)->get();
            foreach($offer_files as $file){
                if($file->working_conditions){
                    unlink(storage_path('app/public/joboffers/'.$file->working_conditions));
                }if($file->labor_contract){
                    unlink(storage_path('app/public/joboffers/'.$file->labor_contract));
                }if($file->contract){
                    unlink(storage_path('app/public/joboffers/'.$file->contract));
                }if($file->dismissal){
                    unlink(storage_path('app/public/joboffers/'.$file->dismissal));
                }if($file->health_safety){
                    unlink(storage_path('app/public/joboffers/'.$file->health_safety));
                }
            }
            DB::table('job_offers')->where('id',$request->id)->delete();
            return redirect()->back();
        }else{
            return view('home');
        }

    }
}
