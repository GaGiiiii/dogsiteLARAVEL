@extends('layouts/forms')

@section('content')
  <div id="container">
    <h1>&bull; Register Here &bull;</h1>
    <div class="underline">
    </div>
    <div class="icon_wrapper">
      <img class="icon" src="{{asset('img/dog.png')}}">
    </div>
    <div class="row">
      @include('includes/messages')
      <form method="POST" action="{{ route('register') }}" id="contact_form" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">        
          <input id="name_input" placeholder="Name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
          {{-- (name, value, 'attributes') --}}
          {{-- @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif --}}
        </div>
        <div class="col-md-12">        
          <input id="email" type="email" placeholder="Email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
          {{-- (name, value, 'attributes') --}}
          {{-- @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif --}}
        </div>
        <div class="col-md-12">        
          <input id="password" type="password" placeholder="Password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
          {{-- (name, value, 'attributes') --}}
          {{-- @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif --}}
        </div>
        <div class="col-md-12">        
          <input id="password-confirm" placeholder="Confirm Password" type="password" name="password_confirmation" required>
          {{-- (name, value, 'attributes') --}}
        </div>
        <div class="col-md-12">
          Upload Image
          <input type="file" name="profile_image" id="profile-image">
        </div>
        <div class="submit col-md-12">
            <button type="submit" id="form_button">
                {{ __('Register') }}
            </button>
          {{-- (value, attr) --}}
        </div>
        <div class="col-md-12 go-back">
          <a href="{{url('/')}}">Home | </a>
          <a href="{{ URL::previous() }}">Go Back | </a>
          <a href="{{ url('/login') }}">Login</a>
        </div>      
      </form><!-- // End form -->
    </div>
  </div><!-- // End #container -->
@endsection




