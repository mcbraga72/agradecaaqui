@extends('template')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5">
      <h4 style="margin-top: 30%; margin-bottom: 10%; margin-left: 8%;">Área Administrativa - Login</h4>

      <form method="post" action="{{ url('/auth/login') }}">
        {!! csrf_field() !!}

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" class="form-control" id="password" placeholder="Senha" name="password" required>
        </div>

        <div class="checkbox">
            <label>
              <input type="checkbox" name="remember"><span style="margin-left: 5%;">Lembrar-me</span>
            </label>
        </div>

        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
        </div>

        <p class="text-center">
          <a class="btn btn-link" href="{{ url('/password/email') }}">Esqueceu sua senha?</a>
        </p>

        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

      </form>
    </div>
  </div>
</div>
@endsection