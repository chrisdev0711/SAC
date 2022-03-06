@php $editing = isset($faultDiagnosis) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="sac_no"
            label="SAC Num"
            value="{{$sac_num}}"
            maxlength="255"
            disabled
        ></x-inputs.text>
    </x-inputs.group>
    
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="time_started"
            label="Time Started"
            value="{{ $started_at->format('Y-m-d\TH:i:s') }}"
            max="255"
            class="disabled-link"                      
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="time_finished"
            label="Time Finished"
            value="{{ old('time_finished', ($editing ? optional($faultDiagnosis->time_finished)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="fault_found"
            label="Fault Found"
            maxlength="255"
            >{{ old('fault_found', ($editing ? $faultDiagnosis->fault_found :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="parts_required"
            label="Parts Required"
            maxlength="255"
            >{{ old('parts_required', ($editing ?
            $faultDiagnosis->parts_required : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="repaired"
            label="Repaired"
            :checked="old('repaired', ($editing ? $faultDiagnosis->repaired : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="test_again"
            label="Test Again"
            :checked="old('test_again', ($editing ? $faultDiagnosis->test_again : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
