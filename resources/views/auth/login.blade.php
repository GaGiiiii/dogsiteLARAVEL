@extends('layouts/forms')

@section('content')
  <div id="container">
    <h1>&bull; Login Here &bull;</h1>
    <div class="underline">
    </div>
    <div class="icon_wrapper">
      <img class="icon" src="{{asset('img/dog.png')}}">
    </div>
    <div class="row">
      @include('includes/messages')
      <form method="POST" action="{{ route('login') }}" id="contact_form">
        @csrf
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
          <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
              </label>
          </div>
        </div>
        <div class="submit col-md-12">
            <button type="submit" id="form_button">
                {{ __('Login') }}
            </button>
        </div>
        <div class="col-md-12 go-back">
          <a href="{{url('/')}}">Home | </a>
          <a href="{{ URL::previous() }}">Go Back | </a>
          <a href="{{ url('/register') }}">Register</a>
        </div>      
      </form><!-- // End form -->
    </div>
  </div><!-- // End #container -->
@endsection





