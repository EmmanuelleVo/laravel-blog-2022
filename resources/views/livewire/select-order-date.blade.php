<div>
    <label for="sort-order">Sort by</label>
    <select id="sort-order" wire:model="sortOrder">
        @foreach($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
