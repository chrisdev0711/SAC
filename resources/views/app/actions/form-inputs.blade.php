@php $editing = isset($action) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="actionable_id"
            label="Actionable Id"
            value="{{ old('actionable_id', ($editing ? $action->actionable_id : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="actionable_type"
            label="Actionable Type"
            value="{{ old('actionable_type', ($editing ? $action->actionable_type : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="appliance_id" label="Appliance" required>
            @php $selected = old('appliance_id', ($editing ? $action->appliance_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Appliance</option>
            @foreach($appliances as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="actioned_by" label="Actioned By" required>
            @php $selected = old('actioned_by', ($editing ? $action->actioned_by : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
