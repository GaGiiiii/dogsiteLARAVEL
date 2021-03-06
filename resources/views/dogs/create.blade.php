@extends('layouts/forms')

@section('content')

  {{-- <div class="navbar-margin"></div> --}}

  <div id="container">
    <h1>&bull; Create Breed &bull;</h1>
    <div class="underline">
    </div>
    <div class="icon_wrapper">
      <img class="icon" src="{{asset('img/dog.png')}}">
    </div>
    <div class="row">
      @include('includes/messages')
      {!! Form::open(['action' => 'DogsController@store', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'contact_form']) !!}  
        <div class="col-md-12">        
          {{Form::text('breed', '', ['id' => 'name_input', 'placeholder' => 'Breed Name', 'required' => 'true'])}}
          {{-- (name, value, 'attributes') --}}
        </div>
        <div class="col-md-12">
          {{Form::label('description', 'BREED DESCRIPTION', ['class' => 'placeholder'])}}
          <img src="{{asset('img/arrow-angle-pointing-down.png')}}" alt="">
          {{Form::textarea('description', '', ['id' => 'message_input', 'cols' => '30', 'rows' => '5', 'required' => 'true'])}}
        </div>
        <div class="col-md-12" style="margin-top: 1rem">
          {{Form::label('breed_image', 'BREED IMAGE', ['class' => 'placeholder'])}}    
          <img src="{{asset('img/arrow-angle-pointing-down.png')}}" alt="">
          {{Form::file('breed_image', ['required' => 'true'])}}
          {{-- (name, value, 'attributes') --}}
        </div>
        <div class="submit col-md-12">
          {{Form::submit('Create', ['id' => 'form_button'])}}
          {{-- (value, attr) --}}
        </div>
        <div class="col-md-12 go-back">
          <a href="{{url('/')}}">Home | </a>
          <a href="{{ URL::previous() }}">Go Back</a>
        </div>      
      {!! Form::close() !!}<!-- // End form -->
    </div>
  </div><!-- // End #container -->

@endsection