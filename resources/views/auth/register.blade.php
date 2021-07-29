<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Log up</title>
  </head>
  <body>
     <div class="card bg-light">
        <article class="card-body mx-auto">
            <h4 class="card-title mt-3 text-center">@lang('home.create')</h4>
                <a href="{{ route('social.oauth', 'google') }}" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i> @lang('home.logingg')</a>
                <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i> @lang('home.loginfb')</a>
            </p>
            <p class="divider-text">
                <span class="bg-light">@lang('home.or')</span>
            </p>
            <form action="{{route('post.register')}}" method="POST">
                @csrf
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="Full name" type="text" value="{{old('fullname')}}" />
                </div>
                @if($errors->has('fullname'))
                    <span class="text-danger">
                        {{ $errors->first('fullname') }}
                    </span>
                @endif
                <input type="hidden" name="is_admin" value="0">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number" type="number"  value="{{old('phone')}}" />
                </div>
                @if($errors->has('phone'))
                    <span class="text-danger">
                        {{ $errors->first('phone') }}
                    </span>
                @endif
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email address" type="email" value="{{old('email')}}" />
                </div>
                @if($errors->has('email'))
                <span class="text-danger">
                    {{ $errors->first('email') }}
                </span>
                @endif
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Create password" type="password" name="password"  value="{{old('password')}}" />
                </div>
                 @if($errors->has('password'))
                    <span class="text-danger">
                        {{ $errors->first('password') }}
                    </span>
                 @endif
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmation password" type="password" name="password_confirmation" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">@lang('home.signup')</button>
                </div>
                <p class="text-center">@lang('home.account') ? <a href="{{ route('get.login')}}"> @lang('home.login') </a></p>
            </form>
        </article>
    </div>
  </body>
</html>
