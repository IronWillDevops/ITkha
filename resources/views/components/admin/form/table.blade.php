@props(['data'])

<table class="w-full table-auto border-collapse text-sm">
    <tbody>
    @foreach($data as $key => $value)
        <tr class="border-t">
            <td class="p-2 font-medium w-48 ">{{ ucwords(str_replace('_',' ', $key)) }}</td>
            <td class="p-2">
                <pre class="whitespace-pre-wrap">{{ is_array($value) ? json_encode($value, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) : $value }}</pre>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
