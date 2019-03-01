@component('mail::message')
# {{ $todoList->name }} Deleted.

The list "{{ $todoList->name }}" has been deleted.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
