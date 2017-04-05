@extends('enterprise.layout')

@section('content')

<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript"> 
        
    function formatTelephone(telephone){ 
        if(telephone.value.length == 0)
            telephone.value = '(' + telephone.value;
        if(telephone.value.length == 3)
            telephone.value = telephone.value + ') ';
        if(telephone.value.length == 9)
            telephone.value = telephone.value + '-';  
    }
    
</script>

<div class="container-fluid login-register">
    <div class="row">    
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p style="margin-top: 2%;">Perfil</p>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <div class="">                
                <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateLogo({{ Auth::guard('enterprises')->user()->id }})">
                    {{ csrf_field() }}
                    <div class="form-group col-lg-12">
                        <div class="form-group col-lg-8">
                            <label for="logo" class="btn"><img src="{{ URL::to('/') . '/' . Auth::guard('enterprises')->user()->logo }}" style="border-radius: 50%; width: 80px; height: 80px;" /></label>
                            <button type="submit" class="btn btn-primary" style="display: inline !important;">Atualizar Logo</button>
                            <input type="file" name="logo" id="logo" class="form-control" v-model="logo" style="display: inline !important;">
                            <span v-if="formErrors['logo']" class="error text-danger">@{{ formErrors['logo'] }}</span>                                        
                        </div>
                    </div>                                
                </form>
                <form class="form" role="form" method="POST" action="{{ url('/empresa/perfil/' . $enterprise->id) }}">
                    {{ csrf_field() }}
                    <div class="label-register enterprise-profile form-group{{ $errors->has('category_id') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="category_id" class="col-md-6 control-label label-register">Categoria</label>
                        <select name="category_id" class="form-control" />
                            <option value="">Selecione a categoria</option>
                            @foreach($categories as $category)
                                @if($enterprise->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif    
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="name" class="col-md-6 control-label label-register">Nome da empresa</label>
                        <input id="name" type="text" class="form-control label-register" name="name" value="{{ $enterprise->name }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('contact') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="contact" class="col-md-6 control-label label-register">Contato</label>
                        <input id="contact" type="text" class="form-control label-register" name="contact" value="{{ $enterprise->contact }}" required autofocus>
                        @if ($errors->has('contact'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('telephone') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="telephone" class="col-md-6 control-label label-register">Telefone</label>
                        <input id="telephone" type="text" class="form-control label-register" name="telephone" value="{{ $enterprise->telephone }}" required autofocus maxlength="14" onkeypress="formatTelephone(this)">
                        @if ($errors->has('telephone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="email" class="col-md-6 control-label label-register">E-mail</label>
                        <input id="email" type="email" class="form-control label-register" name="email" value="{{ $enterprise->email }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('site') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="site" class="col-md-6 control-label label-register">Site</label>
                        <input id="site" type="text" class="form-control label-register" name="site" value="{{ $enterprise->site }}" required autofocus>
                        @if ($errors->has('site'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('address') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="address" class="col-md-6 control-label label-register">Endereço</label>
                        <input id="address" type="text" class="form-control label-register" name="address" value="{{ $enterprise->address }}" required autofocus>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>                    
                    <div class="form-group">
                        <div class="col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-success" style="margin-top: 2%;">Enviar</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection
