@extends('app.dashboard')

@section('content')
	<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript">
	    tinymce.init({ 
	        selector:'textarea',
	        plugins: 'emoticons',
	        menubar: '',
	        toolbar: 'undo redo | cut copy paste | styleselect | bold italic | link image | emoticons' 
	    });
	    
	    var path = "{{ route('autocomplete') }}";
	    
	    $('input.typeahead').typeahead({
	        source: function (query, process) {
	            return $.get(path, { query: query }, function (data) {
	                return process(data);
	            });
	        }
	    });
	    
	</script>	
	<div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 home">            
            <form class="form-horizontal" role="form" method="POST" action="{{ url('entrar') }}">
            {{ csrf_field() }}                
	            {{--<div class="form-group{{ $errors->has('enterprise') ? ' has-error' : '' }}" style="display: none;">
	                <br><br>
	                <label for="enterprise" class="col-md-4 control-label form-home">EMPRESA</label>
	                <div class="col-md-6">
	                    <input id="enterprise" type="text" class="form-control" name="enterprise" value="{{ old('enterprise') }}" required autofocus placeholder="Nome">
	                    @if ($errors->has('enterprise'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('enterprise') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>--}}
                <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
	                <br><br>
	                <label for="userName" class="col-md-2 control-label form-home">PARA</label>
	                <div class="col-md-8">
	                    <input id="userName" type="text" class="form-control" name="userName" value="{{ Session::get('userName') }}" required autofocus placeholder="Nome">
	                    @if ($errors->has('userName'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('userName') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	            <div class="form-group{{ $errors->has('userEmail') ? ' has-error' : '' }}">
                    <br><br>
                    <label for="userEmail" class="col-md-2 control-label form-home">E-MAIL</label>
                    <div class="col-md-8">
                        <input id="userEmail" type="email" class="form-control" name="userEmail" value="{{ Session::get('userEmail') }}" required autofocus placeholder="E-mail do destinatário">
                        @if ($errors->has('userEmail'))
                            <span class="help-block">
                                <strong>{{ $errors->first('userEmail') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <img src="images/heart.png" /><label for="content" class="col-md-2 control-label form-home">AGRADEÇA AQUI</label>
                    <div class="col-md-8">
                        <textarea id="content" name="content" class="form-control" required placeholder="Seu agradecimento aqui :)">{{ Session::get('content') }}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                    	<button type="submit" class="btn social-network facebook-button"><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></button>
                    	<button type="submit" class="btn social-network twitter-button"><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></button>
                    	<button type="submit" class="btn social-network google-button"><i class="fa fa-2x fa-google-plus" aria-hidden="true"></i></button>
                    	<button type="submit" class="btn social-network whatsapp-button"><i class="fa fa-2x fa-whatsapp" aria-hidden="true"></i></button>
                        <button type="submit" class="btn pink-button">ENVIAR</button>
                    </div>
                </div>
            </form>
            <br><br>                
        </div>	        
	</div>    

@endsection