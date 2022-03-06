@php $editing = isset($plugCheck) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="sac_no"
            label="SAC Num"
            value="{{$sac_num}}"
            maxlength="255"
            disabled
        ></x-inputs.text>
        <x-inputs.text class="mt-2"
            name="insulation"
            label="Insulation resistance"
            maxlength="255"
            value="{{old('insulation', ($editing ? $plugCheck->insulation : ''))}}"
        ></x-inputs.text>
        <x-inputs.text class="mb-2"
            name="earth"
            label="Earth continuity"
            maxlength="255"
            value="{{old('earth', ($editing ? $plugCheck->earth : ''))}}"
        ></x-inputs.text>
    </x-inputs.group>
    
    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="gas"
            label="Gas Tightness Test Pass"
            :checked="old('gas', ($editing ? $plugCheck->gas : 0))"
        ></x-inputs.checkbox>
        <x-inputs.checkbox
            name="pass_test"
            label="Pass Test"
            :checked="old('pass_test', ($editing ? $plugCheck->pass_test : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="repair_type" label="Repair Type">
            @php $selected = old('repair_type', ($editing ? $plugCheck->repair_type : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="earth" {{ $selected == 'earth' ? 'selected' : '' }} >Earth</option>
            <option value="flash" {{ $selected == 'flash' ? 'selected' : '' }} >Flash</option>
            <option value="ir" {{ $selected == 'ir' ? 'selected' : '' }} >Ir</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
