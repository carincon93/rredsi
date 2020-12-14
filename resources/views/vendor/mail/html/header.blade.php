<tr>
<td class="header" style="background-color: #ececec">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === config('app.name'))
<img src="https://i.imgur.com/VCTiD6H.png" class="logo" alt="Ibis Logo">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
