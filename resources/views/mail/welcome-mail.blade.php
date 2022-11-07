@component('mail::message')
# Welcome {{$name}}!!!

@component('mail::button',['url' => 'https://www.google.com'])
Visit Site
@endcomponent

@component('mail::panel')
This is a panel
@endcomponent

##Table Component
@component('mail::table')
|Sl. No.   |Items   |Quantity | 
|----------|--------|---------|
|     1    |  Bag   |  2      |
|     2    |  Pen   |  5      |
|     3    |  Paper |  10     |
@endcomponent

Thanks,<br>
{{config('app.name')}}
@endcomponent