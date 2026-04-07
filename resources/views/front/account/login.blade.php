@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">

        <!-- ✅ SUCCESS MESSAGE -->
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        <!-- ❌ ERROR MESSAGE -->
        <div id="errorMsg" class="alert alert-danger d-none"></div>

        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item">Login</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-10">
    <div class="container">
        <div class="login-form">    

            <!-- ✅ FORM FIX -->
            <form method="POST" id="loginForm">
                @csrf

                <h4 class="modal-title">Login to Your Account</h4>

                <div class="form-group">
                    <input type="text" 
                           class="form-control" 
                           placeholder="Email" 
                           name="email">
                </div>

                <div class="form-group">
                    <input type="password" 
                           class="form-control" 
                           placeholder="Password" 
                           name="password">
                </div>

                <div class="form-group small">
                    <a href="{{ route('forgot.password') }}">Forgot Password?</a>
                </div> 

                <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">              

            </form>			

            <div class="text-center small">
                Don't have an account? 
                <a href="{{ route('register') }}">Sign up</a>
            </div>

        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
$('#loginForm').submit(function(e){

    e.preventDefault();

    $.ajax({
        url: "{{ route('loginUser') }}",
        method: "POST",
        data: $(this).serialize(),

        success: function(response){

    if(response.status){
        window.location.href = response.redirect; // ✅ CORRECT
    } else {
        $('#errorMsg').removeClass('d-none').text(response.message);
    }

}

      
    });

});
</script>
@endpush