<div class="row  col-md-8 col-sm-10 offset-md-2 col-sm-1">
    <select class="custom-select">
        <option selected>Open this select menu</option>
        <option {{ $isSelected($value) ? 'selected="selected"' : '' }} value="{{ $value }}">
            {{ $label }}
        </option>
    </select>
</div>