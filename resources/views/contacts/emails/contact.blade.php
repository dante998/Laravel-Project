@component('mail::message')
# Contact from {{ $name }}

{{ $content }}

@component('mail::button', ['url' => 'http://localhost/'])
Visit Us
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
