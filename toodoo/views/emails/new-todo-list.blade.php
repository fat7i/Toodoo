@component('mail::message')
# {{ $todoList->name }}

The "{{ $todoList->name }}" todo list has been created,
You can visit it from here

@component('mail::button', ['url' => env('APP_URL'). '/todo.html?list='.$todoList->uuid])
    Visit {{ $todoList->name }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
