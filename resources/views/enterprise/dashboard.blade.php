@extends('enterprise.layout')

@section('content')
<div class="container-fluid">      
    <div class="row">
        <br>
        <div class="col-xs-12 col-sm-11 col-md-6 col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuários agradecendo</span>
                    <span class="info-box-number">{{ $data['numberOfIndividualUsersThanking'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-11 col-md-6 col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-heart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Agradecimentos recebidos</span>
                    <span class="info-box-number">{{ $data['enterpriseThanksReceived'] }}</span>
                </div>
            </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-xs-12 col-sm-11 col-md-6 col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-sort-numeric-asc"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Colocação no ranking</span>
                    <span class="info-box-number">1</span>
                </div>           
            </div>
        </div>
    </div>
</div>

<!-- Complete Register Alert Modal -->
<div class="modal fade" id="checkPaymentAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-name about" id="myModalLabel">Prezado cliente</h4>
            </div>
            <div class="modal-body">
                <img class="logo-modal" src="{{ asset('images/logo.png') }}" />
                <h4 class="modal-name complete-register" id="myModalLabel">Efetue seu pagamento até o dia {{ $data['lastRenewalDay'] }}. Após este dia, sua empresa será automaticamente alterada para o perfil padrão e você perderá todos os benefícios do plano Premium!</h4><br>
            </div>  
            <div class="modal-footer">
                <button type="button" id="openCompleteRegister" onclick="location.href='{{ url('/empresa/premium') }}';" class="btn btn-success" data-dismiss="modal" aria-label="Close">Renovar assinatura<i class="fa fa-check fa-fw" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Agora não<i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    @if($data['isRenewalPeriod'] == 1)
        $('#checkPaymentAlert').modal('show');
    @endif
    
    
    $('#closeModal').click(function() {
        $('#completeRegisterAlert').modal('hide');          
    });

</script>

@endsection