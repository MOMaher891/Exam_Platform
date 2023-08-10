@component('mail::message')
Your Verification Code is.
@component('mail::button', ['url' => 'https://laraveltuts.com'])
{{$code}}
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent