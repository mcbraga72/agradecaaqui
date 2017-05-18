<img src="{{ URL::to('/') }}/images/logoEmail.png" /><br><br>
<p>Sua empresa recebeu um agradecimento.</p> 
<p>Nome do cliente: {{ $userName }}</p>
<p>E-mail do cliente: {{ $userEmail }}</p>
<p>Agradecimento</p>
<p>{{ strip_tags($content) }}</p><br><br>
<p>Atenciosamente,</p>
<p>Equipe de atendimento - Agradeça Aqui</p>
