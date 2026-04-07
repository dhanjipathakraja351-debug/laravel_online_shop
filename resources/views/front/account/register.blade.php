@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item">Register</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-10">
    <div class="container">
        <div class="login-form">    

            <!-- ✅ SUCCESS MESSAGE -->
            <div id="successMsg" class="alert alert-success d-none"></div>

            <!-- ❌ ERROR MESSAGE -->
            <div id="errorMsg" class="alert alert-danger d-none"></div>

            <form action="" method="POST" name="registrationForm" id="registrationForm">
                @csrf

                <h4 class="modal-title">Register Now</h4>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                </div>

                <!-- ✅ FIX NAME -->
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="password_confirmation">
                </div>

                <div class="form-group small">
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div> 

                <button type="submit" class="btn btn-dark btn-block btn-lg">Register</button>

            </form>			

            <div class="text-center small">
                Already have an account? 
                <a href="{{ route('login') }}">Login Now</a>
            </div>

        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
$('#registrationForm').submit(function(e){

    e.preventDefault();

    $.ajax({
        url: "{{ route('storeRegister') }}",
        method: "POST",
        data: $(this).serialize(),

        success: function(response){

            if(response.status){

                $('#errorMsg').addClass('d-none');

                $('#successMsg')
                    .removeClass('d-none')
                    .text(response.message);

                setTimeout(function(){
                    window.location.href = "{{ route('login') }}";
                },1500);

            } else {

                let errors = '';

                $.each(response.errors,function(key,value){
                    errors += value[0] + '<br>';
                });

                $('#successMsg').addClass('d-none');

                $('#errorMsg')
                    .removeClass('d-none')
                    .html(errors);
            }

        }
    });

});
</script>
@endpush