@php $editing = isset($costing) @endphp

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

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="complete"
            label="Completed"
            :checked="old('complete', ($editing ? $costing->complete : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="note"
            label="Note"
            maxlength="255"
            >{{ old('note', ($editing ? $costing->note : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
