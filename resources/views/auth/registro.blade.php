@extends('layouts/auth')

@section('title')
<title>Registro</title>

@section('content')

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Auth</b>Laravel</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registra una nueva cuenta</p>

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <form action="{{ route('registrarse') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          {{-- @if($errors->has('name')) <span class="text-danger" style="width: 100%">{{ $errors->first('name') }}</div> @endif --}}
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Nombre de usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirm" placeholder="Repite contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col">
            {{-- <button type="submit" class="btn btn-primary btn-block">Registro</button> --}}
            <input type="submit" value="Registro" class="btn btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
    </div>
    <!-- /.form-box -->
  </div>
@endsection
