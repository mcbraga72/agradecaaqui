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

    function formatCellphone(cellphone){ 
        if(cellphone.value.length == 0)
            cellphone.value = '(' + cellphone.value;
        if(cellphone.value.length == 3)
            cellphone.value = cellphone.value + ') ';
        if(cellphone.value.length == 10)
            cellphone.value = cellphone.value + '-';  
    }
    
</script>

<div class="container-fluid login-register">
    <div class="row">    
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <div class="">
                <form class="form" role="form" method="POST" action="{{ url('/empresa/perfil/' . $enterprise->id) }}">
                    {{ csrf_field() }}
                    <div class="label-register enterprise-profile form-group{{ $errors->has('category_id') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <label for="category_id" class="col-md-8 control-label label-register">Categoria:</label>
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
                    <div class="label-register enterprise-profile form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <br><br>
                        <label for="name" class="col-md-8 control-label label-register">Nome da empresa</label>                        
                        <input id="name" type="text" class="form-control label-register" name="name" value="{{ $enterprise->name }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('contact') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <br><br>
                        <label for="contact" class="col-md-8 control-label label-register">Contato</label>                        
                        <input id="contact" type="text" class="form-control label-register" name="contact" value="{{ $enterprise->contact }}" required autofocus>
                        @if ($errors->has('contact'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('telephone') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <br><br>
                        <label for="telephone" class="col-md-8 control-label label-register">Telefone</label>                        
                        <input id="telephone" type="text" class="form-control label-register" name="telephone" value="{{ $enterprise->telephone }}" required autofocus maxlength="14" onkeypress="formatTelephone(this)">
                        @if ($errors->has('telephone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <br><br>
                        <label for="email" class="col-md-8 control-label label-register">E-mail</label>                        
                        <input id="email" type="email" class="form-control label-register" name="email" value="{{ $enterprise->email }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('address') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <br><br>
                        <label for="address" class="col-md-8 control-label label-register">Endereço</label>                        
                        <input id="address" type="text" class="form-control label-register" name="address" value="{{ $enterprise->address }}" required autofocus>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-success">Enviar</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection
