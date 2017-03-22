@component('mail::message')

Dobrý den,

zasíláme vám odkaz pro ověření vaší e-mailové adresy **{{ $user->email }}**.

Kliknutím na tlačítko níže ověřte e-mailovou adresu a odemkněte plný potenciál stránek {{ config('app.name') }}:

@component('mail::button', ['url' => url("registrace/overeni/{$user->token}")])
Ověřit e-mail
@endcomponent

Děkujeme,<br>
tým {{ config('app.name') }}

@component('mail::subcopy')
Pokud máte problém s tlačítkem *"Ověřit e-mail"*, zkopírujte a vložte tuto URL adresu do prohlížeče:
[{{ url("registrace/overeni/{$user->token}") }}]({{ url("registrace/overeni/{$user->token}") }})
@endcomponent

@endcomponent
