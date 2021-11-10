@component('mail::message')
Beste werkgever!

Wij hebben een nieuwe sollicitatie ontvangen voor je vacatature van <strong>{{$vacature_naam}}</strong>
!

Zie hier de gegevens van de sollicitant!

Naam: {{$user->first_name}} {{$user->last_name}}<br>
Woonplaats: {{$user->city}}<br>
Telefoon-nummer: {{$user->phone_number}}

U kunt meer informatie vinden op het profiel van de sollicitant


@component('mail::button', ['url' => "http://127.0.0.1:8000/profile/{$user->id}"])
Naar het profiel van de sollicitant
@endcomponent

Veel succes voor het vinden van je geschikte kandidaat!<br>
{{ config('app.name') }}
@endcomponent
