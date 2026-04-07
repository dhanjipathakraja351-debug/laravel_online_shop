@extends('front.layouts.app')

@section('content')

<!-- BREADCRUMB -->
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                {{ $page->name }}
            </li>
        </ol>
    </div>
</section>

<!-- PAGE CONTENT -->
<section class="section-6 pt-5 pb-5">
    <div class="container">

        <h2 class="mb-4">{{ $page->name }}</h2>

        <div>
            {!! $page->content !!}
        </div>

    </div>
</section>

@endsection