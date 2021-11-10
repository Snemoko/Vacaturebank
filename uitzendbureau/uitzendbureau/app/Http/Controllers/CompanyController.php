<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Advert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if($this->show()){
            $company = $this->show();
            return view('company.index', compact('company'));
        }else{
            return view('company.index');
        }
    }

    public function show(){
        $company = User::find(1)->company;

        return view('company.index', compact('company'));
    }


    public function form(Request $request){

        $company = company::where('user_id', Auth::user()->id);

        if($company->count() > 0){
            $this->update($request);
        }else{
            $this->create($request);
        }

        $company = $this->show();
        return view('company.index',compact('company'));

    }



    public function create(Request $request){
        $request->validate([
            "company_name" => 'required',
            "kvk" => 'max:20|required'
        ]);

        $roll = auth()->user()->roll;
        $id = auth()->user()->id;
        $kvk = $request->kvk;
        $bedrijfsnaam = $request->company_name;

        company::create([
            'company_name' => $bedrijfsnaam,
            'kvk' => $kvk,
            'user_id' => $id
        ]);

        $company = $this->show();
        return view('company.index', compact('company'));
    }

    public function update(Request $request){
        $request->validate([
            "company_name" => 'required',
            "kvk" => 'max:20|required'
        ]);
        $kvk = $request->kvk;
        $bedrijfsnaam = $request->company_name;


        $company = company::where('user_id', Auth::user()->id)->first();
        $company->kvk = $kvk;
        $company->company_name = $bedrijfsnaam;
        $company->save();

        return view('company.index', compact('company'));
    }


    public function ad(Request $request){
        // dd($request->file('file'));
        $request->validate([
            'file' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        $fileName = $request->file('file')->getClientOriginalName();
        $ad =Advert::select()->where('user_id',Auth::user()->id)->first();
        if($ad){
            File::delete(public_path('image/ad/'.$ad->text));
            $request->file('file')->storeAs('', $fileName, 'ad');
            $ad->text = $fileName;
            $ad->save();
            return view('company.index');
        };
        $request->file('file')->storeAs('', $fileName, 'ad');
        $filemodel = new Advert();
        $filemodel->text = $fileName;
        $filemodel->user_id = Auth::user()->id;
        $filemodel->save();
        return view('company.index');
    }

    public function delete(){
        $ad =Advert::select()->where('user_id',Auth::user()->id)->first();
        if($ad){
            File::delete(public_path('image/ad/'.$ad->text));
            DB::table('adverts')->where('user_id',Auth::user()->id)->delete();
        }
        return view('company.index');
    }


}

