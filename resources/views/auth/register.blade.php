<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition register-page" style="background-color: #008B8B;">
        <div class="register-box">
            <img src="{{Vite::asset('resources/images/logo.png')}}" style="width: 130px;margin:20px;margin-left:100px;">

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Créer mon compte</p>

                    <form method="post" action="{{ route('register') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Nom d'utilisateur">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirmer mot de passe">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>

                        <div class="row">
                           
                            <!-- /.col -->
                            <div class="col-4" style="background: black;">
                                <button type="submit" class="btn btn-primary btn-block" style="background: black;border:none;">Créer </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <a href="{{ route('login') }}" class="text-center">J'ai déjà un compte</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->

            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
