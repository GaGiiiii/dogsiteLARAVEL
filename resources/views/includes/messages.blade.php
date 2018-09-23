@if(count($errors) > 0)
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      <p class="p-error">{{$error}}</p>
    </div>
  @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
      {{session('error')}}
    </div>
@endif

