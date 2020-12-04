<tr>
<td class="header" style="background-color: #ececec">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === config('app.name'))
<img src="{{ url('/storage/images/notification-logo.png') }}" class="logo" alt="Ibis Logo">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
