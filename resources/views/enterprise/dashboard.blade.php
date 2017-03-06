@extends('enterprise.layout')

@section('content')
<div class="container-fluid">      
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Usuários agradecendo</span>
              <span class="info-box-number">{{ $data['numberOfIndividualUsersThanking'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-heart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Agradecimentos recebidos</span>
              <span class="info-box-number">{{ $data['enterpriseThanksReceived'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-sort-numeric-asc"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Colocação no ranking</span>
              <span class="info-box-number">1</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->        
      </div>
      <!-- /.row -->
</div>
@endsection