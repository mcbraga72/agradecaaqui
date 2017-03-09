<link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-social.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>          
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/') }}" title="">HOME</a></li>
                <li><a href="{{ url('/apoiadores') }}" title="">APOIADORES</a></li>
                <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                <li><a href="{{ url('/entrar') }}" title="">LOGIN</a><i class="fa fa-3x fa-user-circle-o" aria-hidden="true"></i></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
            <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
        </div>
    </div>            
</div>    