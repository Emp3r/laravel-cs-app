@component('mail::message')
# Vítejte na {{ config('app.name') }}!

Dobrý den,

úspěšně jste se zaregistrovali se na Kuchtit.cz. Váš e-mail, pod kterým se budete přihlašovat, je **{{ $user->email }}**.

Ověřte e-mailovou adresu a odemkněte plný potenciál portálu:

@component('mail::button', ['url' => url("registrace/overeni/{$user->token}")])
Ověřit e-mail
@endcomponent


@component('mail::panel')
{{ config('app.name') }} je místo, kde se hledají a hodnotí recepty. Jen napište, co jste našel v ledničce, ve spíži, nebo třeba ve sklepě a zjistěte si recepty jídel, které z toho můžete vyrobit!
@endcomponent


Děkujeme,<br>
tým {{ config('app.name') }}

@endcomponent
