@component('mail::message')
Beste Werkzoekende!

Er is een bedrijf geintresseert in jou!

Bedrijf: {{$user->company->company_name}}<br />
KvK: {{$user->company->kvk}}<br>
Telefoon: {{$user->phone_number}}<br>
Stad: {{$user->city}}

@component('mail::button', ['url' => "http://127.0.0.1:8000/profile/$user->id"])
Bedrijfs profiel bekijken
@endcomponent

Veel succes met het gesprek!,<br>
{{ config('app.name') }}
@endcomponent
