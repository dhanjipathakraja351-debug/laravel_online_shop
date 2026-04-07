@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<section class="content-header">					
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">

            <!-- TOTAL ORDERS -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer text-dark">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <!-- TOTAL PRODUCTS -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalProducts }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="small-box-footer text-dark">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- TOTAL CUSTOMERS -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalCustomers }}</h3>
                        <p>Total Customers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer text-dark">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- TOTAL SALE -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>${{ number_format($totalSale, 2) }}</h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

            <!-- MONTHLY SALE -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>${{ number_format($monthlySale, 2) }}</h3>
                        <p>Revenue this month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

            <!-- LAST MONTH SALE -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>${{ number_format($lastMonthSale, 2) }}</h3>
                        <p>Revenue last month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

            <!-- LAST 30 DAYS -->
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>${{ number_format($last30DaysSale, 2) }}</h3>
                        <p>Revenue last 30 days</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-analytics"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

        </div>
    </div>

</section>

@endsection


@section('customjs')
<script>
    console.log('Dashboard Loaded');
</script>
@endsection