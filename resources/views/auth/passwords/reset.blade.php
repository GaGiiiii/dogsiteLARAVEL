@extends('layouts/forms')

@section('content')
  <div id="container">
    <h1>&bull; Reset Password &bull;</h1>
    <div class="underline">
    </div>
    <div class="icon_wrapper">
      <img class="icon" src="{{asset('img/dog.png')}}">
    </div>
    <div class="row">
      @include('includes/messages')
      <form method="POST" action="{{ route('password.update') }}" id="contact_form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="col-md-12">        
          <input id="email" type="email" placeholder="Email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
          {{-- (name, value, 'attributes') --}}
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="col-md-12">        
          <input id="password" type="password" placeholder="Password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
          {{-- (name, value, 'attributes') --}}
          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <div class="col-md-12">
          <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div class="submit col-md-12">
            <button type="submit" id="form_button">
                {{ __('Reset Password') }}
            </button>
        </div>
        <div class="col-md-12 go-back">
          <a href="{{url('/')}}">Home | </a>
          <a href="{{ URL::previous() }}">Go Back</a>
        </div>      
      </form><!-- // End form -->
    </div>
  </div><!-- // End #container -->
@endsection






