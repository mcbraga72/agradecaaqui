<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="author" content="@yield('author')">
        <meta name="description" content="@yield('description')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta id="csrf-token" name="csrf-token" content="{{{ csrf_token() }}}">
        <title>@yield('title', 'Agradeça Aqui')</title>
        <link rel="shortcut icon" href="images/logo.png" />

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="/css/site.css">
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/bootstrap-social.css">
        <link rel="stylesheet" href="/css/vendor/bootstrap-chosen/bootstrap-chosen.css">

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <header class="main-header">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>                    
                    </div>
                    <div class="navbar-collapse collapse" id="menu">                    
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/') }}" title="">HOME</a></li>
                            <li><a href="{{ url('/parceiros') }}" title="">PARCEIROS</a></li>
                            <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                            <li><a href="{{ url('/blog/') }}" title="">BLOG</a></li>
                            <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                            <li><a href="{{ url('/app') }}" title="">MEUS AGRADECIMENTOS</a></li>
                            <li class="dropdown app-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="avatar" src="{{ Auth::user()->photo }}" /><span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="caret-dropdown">
                                        <a href="{{ url('app/usuario/' . Auth::user()->id . '/edit') }}" class="item-menu-dropdown">PERFIL</a>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item-menu-dropdown">SAIR</a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>    
            </nav>
        </header>
        <div id="user_area">

            <!-- Create Enterprise Modal -->
            <div class="modal fade" id="enterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-name" id="myModalLabel">Cadastro de empresas</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createEnterprise">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="category_id">Categoria:</label>
                                    <select name="category_id" class="form-control" v-model="newEnterprise.category_id" />
                                        <option value="">Selecione a categoria</option>
                                        <option value="@{{ category.id }}" v-for="category in categories.data">@{{ category.name }}</option>
                                    </select>
                                    <span v-if="formErrors['category_id']" class="error text-danger">@{{ formErrors['category_id'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" class="form-control" v-model="newEnterprise.name" />
                                    <span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contato:</label>
                                    <input type="text" name="contact" class="form-control" v-model="newEnterprise.contact" />
                                    <span v-if="formErrors['contact']" class="error text-danger">@{{ formErrors['contact'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">E-mail:</label>
                                    <input type="email" name="email" class="form-control" v-model="newEnterprise.email" />
                                    <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telefone:</label>
                                    <input type="text" name="telephone" class="form-control" v-model="newEnterprise.telephone" />
                                    <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
                                </div>                                
                                <div class="form-group">
                                    <label for="state">Estado:</label>
                                    <select name="state" id="state" class="form-control" v-model="newEnterprise.state" v-on:change="onChange" required autofocus>
                                        <option value="">Selecione o estado</option>
                                        <option value="Acre">Acre</option>
                                        <option value="Alagoas">Alagoas</option>
                                        <option value="Amapá">Amapá</option>
                                        <option value="Amazonas">Amazonas</option>
                                        <option value="Bahia">Bahia</option>
                                        <option value="Ceará">Ceará</option>
                                        <option value="Distrito Federal">Distrito Federal</option>
                                        <option value="Espírito Santo">Espírito Santo</option>
                                        <option value="Goiás">Goiás</option>
                                        <option value="Maranhão">Maranhão</option>
                                        <option value="Mato Grosso">Mato Grosso</option>
                                        <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                        <option value="Minas Gerais">Minas Gerais</option>
                                        <option value="Pará">Pará</option>
                                        <option value="Paraíba">Paraíba</option>
                                        <option value="Paraná">Paraná</option>
                                        <option value="Pernambuco">Pernambuco</option>
                                        <option value="Piauí">Piauí</option>                        
                                        <option value="Rio de Janeiro">Rio de Janeiro</option>
                                        <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                        <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                        <option value="Rondônia">Rondônia</option>
                                        <option value="Roraima">Roraima</option>
                                        <option value="Santa Catarina">Santa Catarina</option>
                                        <option value="Sergipe">Sergipe</option>
                                        <option value="São Paulo">São Paulo</option>
                                        <option value="Tocantins">Tocantins</option>
                                    </select>    
                                    <span v-if="formErrors['state']" class="error text-danger">@{{ formErrors['state'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="city">Cidade:</label>
                                    <select name="city" id="city" class="form-control" v-model="newEnterprise.city" required autofocus>
                                        <option v-for="enterpriseOption in enterpriseOptions" v-bind:value="enterpriseOption">@{{ enterpriseOption }}</option>
                                    </select>
                                    <span v-if="formErrors['city']" class="error text-danger">@{{ formErrors['city'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="neighborhood">Bairro:</label>
                                    <input type="text" name="neighborhood" class="form-control" v-model="newEnterprise.neighborhood" />
                                    <span v-if="formErrors['neighborhood']" class="error text-danger">@{{ formErrors['neighborhood'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Endereço:</label>
                                    <input type="text" name="address" class="form-control" v-model="newEnterprise.address" />
                                    <span v-if="formErrors['address']" class="error text-danger">@{{ formErrors['address'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="type">Tipo:</label><br>
                                    <input type="radio" name="type" value="pf">Pessoa Física<br>
                                    <input type="radio" name="type" value="pj">Pessoa Jurídica<br>
                                </div>
                                <div class="form-group">
                                    <label for="cpf" id="cpfLabel">CPF:</label>
                                    <input type="text" id="cpf" name="cpf" class="form-control" v-model="newEnterprise.cpf" maxlength="14" onkeypress="return formatCPF(this, event)" />
                                    <span v-if="formErrors['cpf']" class="error text-danger">@{{ formErrors['cpf'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="cnpj" id="cnpjLabel">CNPJ:</label>
                                    <input type="text" id="cnpj" name="cnpj" class="form-control" v-model="newEnterprise.cnpj" maxlength="18" onkeypress="return formatCNPJ(this, event)" />
                                    <span v-if="formErrors['cnpj']" class="error text-danger">@{{ formErrors['cnpj'] }}</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="/js/vendor/chosen/chosen.jquery.js" type="text/javascript" charset="utf-8"></script>
            <script type="text/javascript">
                $('.chosen-select').chosen();

                $(document).ready(function() {
                    $('#cnpjLabel').hide();
                    $('#cnpj').hide();
                });

                $('input[name=type]').on('click', function(e) {
                    if ($('input[name=type]:checked').val() == 'pj') {
                        $('#cnpjLabel').show();
                        $('#cnpj').show();
                        $('#cpfLabel').hide();
                        $('#cpf').hide();
                    } else {                
                        $('#cpfLabel').show();
                        $('#cpf').show();
                        $('#cnpjLabel').hide();
                        $('#cnpj').hide();
                    }
                });

                function formatTelephone(telephone){ 
                    if(telephone.value.length == 0)
                        telephone.value = '(' + telephone.value;
                    if(telephone.value.length == 3)
                        telephone.value = telephone.value + ') ';
                    if(telephone.value.length == 10)
                        telephone.value = telephone.value + '-';  
                }

                function formatCPF(cpf, evt) {
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    } else {
                        if(cpf.value.length == 3)
                            cpf.value = cpf.value + '.';
                        if(cpf.value.length == 7)
                            cpf.value = cpf.value + '.';
                        if(cpf.value.length == 11)
                            cpf.value = cpf.value + '-';
                        return true;
                    }
                }

                function formatCNPJ(cnpj, evt) {
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    } else {
                        if(cnpj.value.length == 2)
                            cnpj.value = cnpj.value + '.';
                        if(cnpj.value.length == 6)
                            cnpj.value = cnpj.value + '.';
                        if(cnpj.value.length == 10)
                            cnpj.value = cnpj.value + '/';
                        if(cnpj.value.length == 15)
                            cnpj.value = cnpj.value + '-';
                        return true;
                    }
                }
            </script>                
            @yield('content')
        </div>    
        <footer class="nopadding">
            <div class="col-lg-12 social-networks">
                <a href="https://www.facebook.com/agradecaaquii/" target="_blank"><img src="{{ URL::to('/') }}/images/facebook.png" alt="Perfil no Facebook" title="Perfil no Facebook" /></a>
                <a href="https://www.instagram.com/agradecaaqui/" target="_blank"><img src="{{ URL::to('/') }}/images/instagram.png" alt="Perfil no Instagram" title="Perfil no Instagram" /></a>
            </div>
            <img src="{{ URL::to('/') }}/images/footerUserArea.png" width="100%" />
        </footer>        
    </body>
</html>
