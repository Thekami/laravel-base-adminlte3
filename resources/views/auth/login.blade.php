@extends('layouts/auth')

@section('title')
<title>Iniciar sesión</title>
@endsection

@section('content')

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Auth</b>Laravel</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar sesión</p>

      @if(session('success') != null)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

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

      <form action="{{ route('loguearse') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user" placeholder="Usuario / Email">
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
        <div class="row">
          <div class="col">
            {{-- <input type="submit" value="Iniciar" class="btn btn-primary btn-block"> --}}
            <input type="submit" value="Iniciar" class="btn btn-primary btn-block">
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">Olvidé mi contraseña</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('registro') }}" class="text-center">Registrarme</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>

@endsection