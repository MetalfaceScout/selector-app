<div>
    <x-input-label for="center_select">Center</x-input-label>
    <select name="center_select">
            <option value="0">All Centers</option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}">{{ __($center->name) }}</option>
            @endforeach
    </select>
</div>