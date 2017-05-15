@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h4 class="dashboard-title">Dashboard</h4>
        </div>
    </div>
    <div class="row dashboard">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuários</span>
                    <span class="info-box-number">{{ $data['users'] }}</span>
                </div>    
            </div>    
        </div>    
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Empresas</span>
                    <span class="info-box-number">{{ $data['enterprises'] }}</span>
                </div>    
            </div>    
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-sort-alpha-asc"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Categorias de Empresas</span>
                    <span class="info-box-number">{{ $data['categories'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-heart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Agradecimentos</span>
                    <span class="info-box-number">{{ $data['thanks'] }}</span>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>     
@endsection