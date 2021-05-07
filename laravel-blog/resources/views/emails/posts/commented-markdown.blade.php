@component('mail::message')
# Introduction

Example email from Laravel Blog App

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
