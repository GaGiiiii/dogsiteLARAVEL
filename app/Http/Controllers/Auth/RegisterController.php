<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|alpha-dash',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'image|nullable|max:2999',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
      Session::flash('userRegister', 'Your registration was successfull. <i class="fa fa-check" aria-hidden="true"></i> Welcome ' . $data['name']);

      // Handle Image Upload
      if($data['profile_image']){
        // Get filename with the extension
        $fileNameWithExt = $data['profile_image']->getClientOriginalName();
        // Get just filename
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $data['profile_image']->getClientOriginalExtension();
        // Filename to store 
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        // Upload Image 
        // $path = $data['profile_image']->storeAs('public/profile_images', $fileNameToStore);


        $file = $data['profile_image'];
        Storage::disk('uploads')->put('profile_images/' . $fileNameToStore, File::get($file));
      }else{
        $fileNameToStore = 'noimage.jpg';
      }

      return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
          'profile_image' => $fileNameToStore,
      ]);
    }
}
