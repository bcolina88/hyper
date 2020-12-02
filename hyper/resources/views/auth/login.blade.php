@extends('layouts.app')


 <div class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
            <form method="POST" action="{{ route('login') }}">
             {{ csrf_field() }}
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Iniciar sesión en su cuenta</p>
                
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-user"></i>
                        </span>
                      </div>
                      <input class="form-control {{ $errors->has('email') ? ' is-danger' : '' }}"
                                                       name="email"
                                                       id="email"
                                                       type="text"
                                                       placeholder="hello@email.com"
                                                       value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-lock"></i>
                        </span>
                      </div>
                      <input class="form-control {{ $errors->has('password') ? ' is-danger' : '' }}"
                                                       name="password"
                                                       id="password"
                                                       type="password"
                                                       placeholder="Password"
                                                       value="" required>
                        @if ($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>


                    

                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">Login</button>
                  </div>
                  <div class="col-6 text-right">
                   <!-- <a class="btn btn-link px-0" href="{{ route('password.request') }}">Forgot password?</a> -->
                  </div>
                </div>
              </div>
              </form>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
