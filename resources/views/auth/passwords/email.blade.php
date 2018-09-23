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
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          <p class="p-success">{{ session('status')}}</p>
        </div>
      @endif
      <form method="POST" action="{{ route('password.email') }}" id="contact_form">
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
        <div class="submit col-md-12">
            <button type="submit" id="form_button">
                {{ __('Send Password Reset Link') }}
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







