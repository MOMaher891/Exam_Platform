
@component('mail::message')
#{{$title}}
<br>
{{$body}}
{{-- @component('mail::button', ['url' => 'https://laraveltuts.com'])
{{$code}}
@endcomponent --}}
Thanks,<br>
{{ config('app.name') }}
@endcomponent