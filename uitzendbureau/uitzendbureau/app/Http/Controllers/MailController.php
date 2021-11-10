<?php

namespace App\Http\Controllers;

use App\Mail\SollicitatieMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\CompanySollicitatieMail;
use App\Models\Company;

class MailController extends Controller
{

    public function sollicitatiemail(Request $request){
        $mail = new SollicitatieMail;
        $company = Company::select()->where('id',$request->company_id)->first()->user_id;
        $user =  User::select()->where('id',$company)->first();
        Mail::to($user->email)->send(new SollicitatieMail($mail));
        $verzonden = "Uw sollicitatie is gelukt";
        return redirect()->back();
    }


    public function BedrijfMail(Request $request){
        $mail = new CompanySollicitatieMail;
        Mail::to($request->email)->send(new CompanySollicitatieMail($mail));
        return redirect()->back();
    }
}
