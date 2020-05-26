<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ContactFormController extends Controller
{
    public function store() {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);
        
        Mail::to('production@joineryscene.co.nz')->send(new ContactFormMail($data));
        // Mail::to('dpisati@gmail.com')->send(new ContactFormMail($data));
        return Redirect::to(URL::previous() . "#contact")->with('message', ' Thanks for your message.');
        
        // return new ContactFormMail($data);
    }
}
