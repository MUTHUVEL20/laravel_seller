@foreach ($items as $item)
<tr class="bg-white"  data-itemno ="{{ $item->itemno }}">
    <td class="p-3 text-sm text-gray-700">{{ $item->itemname }}</td>
    <td class="p-3 text-sm text-gray-700">{{ $item->itemgroup1 }}</td>
    <td class="p-3 text-sm text-gray-700">{{ $item->itemgroup2 }}</td>
    <td class="p-3 text-sm text-gray-700">{{ $item->unitname }}</td>
    <td>
        <form action="{{ route('edititems') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="itemno" value="{{ $item->itemno }}">
            <button type="submit" title="Edit" class="edit-item-btn">
                <img src="{{ asset('images/Edit Icon-1.png') }}" alt="Edit" width="18" height="18">
            </button>
        </form>
    </td>
</tr>
@endforeach
