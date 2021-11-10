<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Job_Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Job_seeker;
use App\Models\Offer;
use App\Models\Seeking_Category;
use App\Models\User;
use Illuminate\Contracts\Queue\Job;


class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $jobs = DB::table('job_Offers')
                    ->join('offers', 'job_offers.id', '=', 'offers.offer_id')
                    ->join('categories', 'offers.category_id', '=', 'categories.id')
                    ->get();

        return view('board.index', compact('jobs'));
    }

    public function create(){
        if(!Company::select()->where('user_id', Auth::user()->id)->first()){
            $text = "Maak eerst een bedrijf's profiel voordat u een vacature plaatst!";
            return view('company.index', compact('text'));
        }else{
            $categories = Category::select("category")->get();
            return view('board.create', compact("categories"));
        }

    }

    public function manage(){
        if(Auth::user()->company){
            $variables = [
                "my_jobs" =>
                    DB::table('job_Offers')
                    ->join('offers', 'job_offers.id', '=', 'offers.offer_id')
                    ->join('categories', 'offers.category_id', '=', 'categories.id')
                    ->where('company_id', Auth::user()->company->id)
                    ->get(),
                "categories" =>
                    DB::table('categories')
                    ->get()
            ];
            return view('board.manage', compact('variables'));
        }
        $my_jobs = null;
        return view('board.manage', compact('my_jobs'));
    }

    public function store(Request $request){
        $request->validate([
            'job_title' => 'required',
            'category' => 'required',
            'text' => 'required',
            'hours' => 'required|max:2',
            'ethic' => 'nullable',
            'labor_contract' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:202248',
            'working_conditions' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:202248',
            'contract' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:202248',
            'dismissal' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:202248',
            'health_safety' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:222048'
        ]);

        $job_offer = new Job_Offer;
        $job_offer->job_title = request('job_title');
        $job_offer->text = request('text');
        $job_offer->hours = request('hours');
        $job_offer->ethic = request('ethic');

        foreach($request->file() as $key => $item){
            $file = $item->getClientOriginalName();
            $fileName = time().'_'.$file;
            $item->storeAs('joboffers', $fileName, 'public');
            if($key == 'working_conditions'){
                $job_offer->working_conditions = $fileName;
            }elseif($key == 'labor_contract'){
                $job_offer->labor_contract = $fileName;
            }elseif($key == 'contract'){
                $job_offer->contract = $fileName;
            }elseif($key == 'dismissal'){
                $job_offer->dismissal = $fileName;
            }elseif($key == 'health_safety'){
                $job_offer->health_safety = $fileName;
            }
        }

        $job_offer->company_id = Auth::user()->company->id;
        $job_offer->save();

        $seeking_category = new Offer;
        $categories = Category::select("id")->where("category", request('category'))->get();
        foreach($categories as $category){
            $seeking_category->category_id = $category->id;
        }
        $offers = Job_Offer::select("id")->where("company_id", Auth::user()->company->id)->get();
        foreach($offers as $offer){
            $seeking_category->offer_id = $offer->id;
        }
        $seeking_category->save();

        return redirect('/board');
    }

    public function delete(Request $request){
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
        DB::table('offers')->where('offer_id',$request->id)->delete();
        return redirect('/board/manage');
    }

    public function update(Request $request){
        $request->validate([
            'job_title' => 'required',
            'category' => 'required',
            'text' => 'required',
            'hours' => 'required|max:2',
            'ethic' => 'nullable',
            'labor_contract' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:20428',
            'working_conditions' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:20428',
            'contract' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:20248',
            'dismissal' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:20428',
            'health_safety' => 'nullable|mimes:csv,txt,xlx,xls,pdf|max:20428'
        ]);

        $id = $request->id;
        $job_offer = Job_Offer::select()->where('id',$id)->first();

        $NewRequest = new Request();

        if($job_offer->job_title !== null){
            $NewRequest->query->add(['job_title' => $job_offer->job_title]);
        }if($job_offer->hours !== null){
            $NewRequest->query->add(['hours' => $job_offer->hours]);
        }if($job_offer->text !== null){
            $NewRequest->query->add(['text' => $job_offer->text]);
        }if($job_offer->ethic !== null){
            $NewRequest->query->add(['ethic' => $job_offer->ethic]);
        }


            $NewRequest->query->add(['job_title' => $request->job_title]);
            $NewRequest->query->add(['hours' => $request->hours]);
            $NewRequest->query->add(['text' => $request->text]);
            $NewRequest->query->add(['ethic' => $request->ethic]);

        if($request->file()){

            if($job_offer->working_conditions !== null){
                $NewRequest->query->add(['working_conditions' => $job_offer->working_conditions]);
            }if($job_offer->labor_contract !== null){
                $NewRequest->query->add(['labor_contract' => $job_offer->labor_contract]);
            }if($job_offer->contract !== null){
                $NewRequest->query->add(['contract' => $job_offer->contract]);
            }if($job_offer->dismissal !== null){
                $NewRequest->query->add(['dismissal' => $job_offer->dismissal]);
            }if($job_offer->health_safety !== null){
                $NewRequest->query->add(['health_safety' => $job_offer->health_safety]);
            }


            foreach($request->file() as $key => $item){
                $file = $item->getClientOriginalName();
                $fileName = time().'_'.$file;
                $item->storeAs('joboffers', $fileName, 'public');

                if($key == 'working_conditions'){
                    $NewRequest->query->add(['working_conditions' => $fileName]);
                    unlink(storage_path('app/public/joboffers/'.$job_offer->working_conditions));
                }elseif($key == 'labor_contract'){
                    $NewRequest->query->add(['labor_contract' => $fileName]);
                    unlink(storage_path('app/public/joboffers/'.$job_offer->labor_contract));
                }elseif($key == 'contract'){
                    $NewRequest->query->add(['contract' => $fileName]);
                    unlink(storage_path('app/public/joboffers/'.$job_offer->contract));
                }elseif($key == 'dismissal'){
                    $NewRequest->query->add(['dismissal' => $fileName]);
                    unlink(storage_path('app/public/joboffers/'.$job_offer->dismissal));
                }elseif($key == 'health_safety'){
                    $NewRequest->query->add(['health_safety' => $fileName]);
                    unlink(storage_path('app/public/joboffers/'.$job_offer->health_safety));
                }
            }
        }

        Job_Offer::where('id',$id)->update(array(
            'job_title' => $NewRequest->job_title,
            'hours' => $NewRequest->hours,
            'text' => $NewRequest->text,
            'ethic' => $NewRequest->ethic,
            'working_conditions' => $NewRequest->working_conditions,
            'labor_contract' => $NewRequest->labor_contract,
            'contract' => $NewRequest->contract,
            'dismissal' => $NewRequest->dismissal,
            'health_safety' => $NewRequest->health_safety
            ));

        return redirect('/board');
    }

    public function search(Request $request){
        $request->validate([
            'search' => 'nullable'
            ]);
        $search = $request->search;
        $job_offers =   DB::table('job_Offers')
                            ->join('offers', 'job_offers.id', '=', 'offers.offer_id')
                            ->join('categories', 'offers.category_id', '=', 'categories.id')
                            ->where('job_title','LIKE','%'.$request->search.'%')
                            ->orWhere('category', 'LIKE', '%'.$request->search.'%')
                            ->get();
        return view('board.search',compact('job_offers'));
    }


}
