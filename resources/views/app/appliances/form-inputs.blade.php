@php $editing = isset($appliance) @endphp
@php $isAdmin = Auth::user()->isAdmin() @endphp
<div class="flex flex-wrap">
    @if (Session::has('message'))
    <x-inputs.group class="w-full">
        <div class="block mt-3 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-4">Warning!</strong> {{ Session::get('message') }}
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
            </button>
        </div>   
    </x-inputs.group>
    @endif
    <x-inputs.group class="w-full">
        <x-inputs.text
            type="text"
            name="SACNo"
            label="Sac No"
            class="block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded"
            value="{{ old('SACNo', ($editing ? $appliance->SACNo : '')) }}"
            maxlength="255"
            required
            :readonly="!$isAdmin ?? false"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select 
            type="input"
            class="block appearance-none w-1/2 py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded"
            name="Status" 
            label="Status"
            :disabled="!$isAdmin ?? false"
        >
            @php $selected = old('Status', ($editing ? $appliance->Status : 'pending')) @endphp
            <option value="pending" {{ $selected == 'pending' ? 'selected' : '' }} >Pending</option>
            <option value="checked in" {{ $selected == 'checked in' ? 'selected' : '' }} >Checked in</option>
            <option value="test & repair" {{ $selected == 'test & repair' ? 'selected' : '' }} >Test repair</option>
            <option value="cleaning" {{ $selected == 'cleaning' ? 'selected' : '' }} >Cleaning</option>
            <option value="quality control" {{ $selected == 'quality control' ? 'selected' : '' }} >Quality control</option>
            <option value="listing" {{ $selected == 'listing' ? 'selected' : '' }} >Listing</option>
            <option value="costing" {{ $selected == 'costing' ? 'selected' : '' }} >Costing</option>
            <option value="ebay" {{ $selected == 'ebay' ? 'selected' : '' }} >Ebay</option>
            <option value="finalizing" {{ $selected == 'finalizing' ? 'selected' : '' }} >Finalizing</option>
            <option value="finalized" {{ $selected == 'finalized' ? 'selected' : '' }} >Finalized</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ModelNumber"
            label="Model Number"
            value="{{ old('ModelNumber', ($editing ? $appliance->ModelNumber : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Description"
            maxlength="255"
            >{{ old('Description', ($editing ? $appliance->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    @if($isAdmin)
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="Supplier" label="Supplier" maxlength="255"
            >{{ old('Supplier', ($editing ? $appliance->Supplier : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="purchase_date"
            label="Purchase Date"
            value="{{ old('purchase_date', ($editing ? optional($appliance->purchase_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="CostExVat"
            label="Cost Ex Vat"
            value="{{ old('CostExVat', ($editing ? $appliance->CostExVat : '')) }}"
            max="255"
            step="0.01"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="VAT"
            label="Vat"
            value="{{ old('VAT', ($editing ? $appliance->VAT : '')) }}"
            max="255"
            step="0.01"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="CostIncVAT"
            label="Cost Inc Vat"
            value="{{ old('CostIncVAT', ($editing ? $appliance->CostIncVAT : '')) }}"
            max="255"
            step="0.01"
        ></x-inputs.number>
    </x-inputs.group>
    @endif
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="PONumber"
            label="Po Number"
            value="{{ old('PONumber', ($editing ? $appliance->PONumber : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="OtherRef"
            label="Other Ref"
            value="{{ old('OtherRef', ($editing ? $appliance->OtherRef : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Location"
            label="Location"
            value="{{ old('Location', ($editing ? $appliance->Location : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="SerialNum"
            label="Serial Num"
            value="{{ old('SerialNum', ($editing ? $appliance->SerialNum : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>      
</div>
