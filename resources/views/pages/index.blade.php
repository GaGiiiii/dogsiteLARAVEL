@extends('layouts/app')

@section('content')
@include('includes/loginLogout')
@include('includes/unauth')
@include('includes/comments')
@include('includes/date')

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
              @guest
                <div class="intro-lead-in">Welcome To DogSite!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <a href="#portfolio" class="page-scroll btn btn-xl">Tell Me More</a>
              @else
                <div class="intro-lead-in">Welcome To DogSite!</div>
                <div class="intro-heading">It's Nice To See You {{ Auth::user()->name }}</div>
                <a href="#portfolio" class="page-scroll btn btn-xl">Tell Me More</a>
              @endguest
            </div>
        </div>
    </header>

    <!-- Breeds Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row breeds-heading">
                <div class="col-lg-12 text-center JSMessage">
                    <h2 class="section-heading">Breeds</h2>
                    <h3 class="section-subheading text-muted">Learn everything about every dog breed.</h3>
                    @guest
                      <h4 class="section-subheading text-muted" style="margin-top: 4rem">To create your own breed you need to <a href="{{url('/login')}}">LOGIN</a>.</h4>
                    @endguest
                </div>
            </div>
            <div class="row">

              @if(count($dogs) > 0)
                <?php $index = -1; ?>
                @foreach($dogs as $dog)
                  <?php $index++; ?>      
      
                  <div class="col-md-4 col-sm-6 col-xs-8 breed-card" id="dogIndex<?php echo $index; ?>">
                    <div class="border-wrapper">
                      <div class="breed-card-image">
                          <a href="#portfolioModal<?php echo $index; ?>" data-toggle="modal">               
                            {{-- <img src="https://www.cesarsway.com/sites/newcesarsway/files/styles/large_article_preview/public/Common-dog-behaviors-explained.jpg?itok=FSzwbBoi" alt="" class="breed-image"> --}}
                            <img src="{{url('/uploads')}}/breed_images/{{$dog->breed_image}}" class="breed-image">                         
                          </a>  
                          </div>
                      <div class="breed-card-content">
                        <div class="row">
                          <div class="data-container">
                            <div class="col-md-12">
                              <a href="#portfolioModal<?php echo $index; ?>" data-toggle="modal" class="breed-name-link"><h4>{{$dog->breed}}</h4></a>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                              <span class="clock"><i class="fa fa-clock-o"></i></span>
                              <span class="time"><?php echo convert_date($dog->created_at); ?> &nbsp;|&nbsp;</span>
                              {{-- <span class="time">Aug 19, 2016 &nbsp;|&nbsp;</span> --}}
                              <a href="{{url('/profile')}}/{{$dog->user->id}}"><span class="admin"><i class="fa fa-user"></i> {{$dog->user->name}}</span></a> 
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                              <span class="right_msg text-right"><i class="fa fa-comments-o"></i></span>
                              <span class="count">{{count($dog->comments)}}</span>
                            </div>
                          </div>  
                          <div class="col-md-12 wrap">
                            {{-- <p class="breed-card-description">{!!$dog->description!!}</p> --}}
                            {{-- This is from Laravel helpers --}}
                            <p class="breed-card-description">{!! str_limit($dog->description, $limit = 100, $end = '...') !!}</p>
                            {{-- {{ str_limit($dog->description, $limit = 100, $end = '...') }} --}}
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-8">
                              <a href="#portfolioModal<?php echo $index; ?>" data-toggle="modal" class="blog_link"><br>Read more <i class="fa fa-check" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
      
                @endforeach
                <div class="col-md-12 col-sm-12">{{$dogs->links()}} </div>
              @else
                <p>No dogs found.</p>
              @endif
      
            </div>
            
          </div>  
        </section>   

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading contact-subheading text-muted">Tell us what you think about us.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 JSContactMessage">
                    {!! Form::open(['action' => 'ContactController@store', 'method' => 'post', 'id' => 'contactForm']) !!} 
                        <div class="row">
                          @include('includes/messages')
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Your Name *', 'required' => 'true'])}}
                                    {{-- (name, value, 'attributes') --}}
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    {{Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Your Email *', 'required' => 'true'])}}
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    {{Form::number('phone', '', ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Your Phone *', 'required' => 'true'])}}
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::textarea('content', '', ['id' => 'message', 'class' => 'form-control', 'placeholder' => 'Your Message *', 'required' => 'true'])}}
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                {{Form::submit('Send Message', ['class' => 'btn btn-xl'])}}
                            </div>
                        </div>
                      {!! Form::close() !!}<!-- // End form -->
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; DogSite 2018</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li>
                          <a href="https://www.facebook.com/GaGishaAa" target='_blank'><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                          <a href="mailto:dragoslav.gagi8@yahoo.com"><i class="fa fa-envelope"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                  <span class="copyright"><a href="{{url('/credits')}}">Credits</a></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->

    @include('dogs/showModal')
    
@endsection