@include('components.header')

<main class="hold-transition login-page">
    <div class="login-box">
    <!-- /.login-logo -->
        <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1">{{config('app.name')}}</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if ($errors->any())
                <div class="alert alert-danger ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group col-12 p-1">
                <p class="text-danger" id="err"></p>
            </div>
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="text" placeholder="Email or mobile" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{__('login')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-0">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </p>
            <p class="mb-0">
                <a href="/register" class="text-center">Register a new account</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->
</main>
<script>
$(document).ready(function() {
    $('#email,#password').on('keyup' ,function(){
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            url:"{{route('credentialValidate')}}",
            type:'POST',
            data:{
                '_token': "{{csrf_token()}}",
                'email':email,
                'password':password
            },
            success:function(data){
                $('#err').html(data);
            }
        });
    });
});
</script>

