@component('mail::message')
# Vítejte na {{ config('app.name') }}!

Dobrý den,

úspěšně jste se zaregistrovali se na {{ config('app.name') }}. Váš e-mail, pod kterým se budete přihlašovat, je **{{ $user->email }}**.

Ověřte e-mailovou adresu a odemkněte plný potenciál portálu:

@component('mail::button', ['url' => url("registrace/overeni/{$user->token}")])
Ověřit e-mail
@endcomponent

@component('mail::panel')
{{ config('app.name') }} je místo, kde se můžete zaregistrovat a upravovat svůj uživateslký profil, a to vše v češtině.
@endcomponent

Děkujeme,<br>
tým {{ config('app.name') }}

@endcomponent
