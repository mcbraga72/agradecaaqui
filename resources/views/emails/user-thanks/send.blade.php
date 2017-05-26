<img src="{{ URL::to('/') }}/images/logoEmail.png" /><br><br>
<p>Você recebeu um agradecimento de um de nossos usuários. Veja abaixo os dados:</p> 
<p>Nome: {{ $userName }}</p>
<p>E-mail: {{ $userEmail }}</p>
<p>Agradecimento</p>
<p>{{ strip_tags($content) }}</p><br><br>
<p>Clique <a href="{{ URL::to('/') }}/app/agradecimento-usuario/{{ $hash }}">aqui</a> para reponder.</p><br><br>
<p>Atenciosamente,</p>
<p>Equipe de atendimento - Agradeça Aqui</p>
