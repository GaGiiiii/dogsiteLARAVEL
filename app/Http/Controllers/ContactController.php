<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUs;
use Mail;

class ContactController extends Controller{
    
  public function store(Request $request){
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'content' => 'required'
    ]);

      // ContactUs::create($request->all()); ONE WAY
    
      $msg = new ContactUs;
      $msg->name = $request->input('name');
      $msg->email = $request->input('email');
      $msg->phone = $request->input('phone');
      $msg->content = $request->input('content');
      $msg->save();

      Mail::send('contact/email', array(
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'phone' => $request->get('phone'),
        'user_message' => $request->get('content')
      ), function($message){
        $message->from('dragoslav.gagi8@gmail.com');
        $message->to('dragoslav.gagi8@yahoo.com')->subject('DogSite Contact Message');
      });

      return redirect('/')->with('sentMail', 'Thank You For Contacting Us! Your Message Was Sent.');
  }
}
