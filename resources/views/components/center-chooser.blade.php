<div>
    <x-input-label for="center_select">Center</x-input-label>
    <select name="center_select">
            <option value="0">All Centers</option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}" {{ $center_select == $center->id ? "selected" : ""}}>{{ __($center->name) }}</option>
            @endforeach
    </select>
</div>