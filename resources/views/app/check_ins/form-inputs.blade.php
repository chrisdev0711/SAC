@php $editing = isset($checkIn) @endphp

<div class="flex flex-wrap">
    <input 
        type="hidden"
        name="sac_num"
        value="{{$sac_num}}"
    />
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
        <x-inputs.text
            name="serial_num"
            label="Serial Num"
            value="{{ old('serial_num', ($editing ? $checkIn->serial_num : $serial_number ?? '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="condition" label="Condition">
            @php $selected = old('condition', ($editing ? $checkIn->condition : '')) @endphp
            <option value="lightly used" {{ $selected == 'lightly used' ? 'selected' : '' }} >Lightly used</option>
            <option value="heavily used" {{ $selected == 'heavily used' ? 'selected' : '' }} >Heavily used</option>
            <option value="unused" {{ $selected == 'unused' ? 'selected' : '' }} >Unused</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-1/2">
        <div
            x-data="imageViewer('{{ $editing && $checkIn->appliance_in_img ? \Storage::url($checkIn->appliance_in_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="appliance_in_img"
                label="Appliance In Img"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="appliance_in_img"
                    id="appliance_in_img"
                    @change="fileChosen"
                />
            </div>

            @error('appliance_in_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-1/2">
        <div
            x-data="imageViewer('{{ $editing && $checkIn->data_badge_img ? \Storage::url($checkIn->data_badge_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="data_badge_img"
                label="Data Badge Img"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="data_badge_img"
                    id="data_badge_img"
                    @change="fileChosen"
                />
            </div>

            @error('data_badge_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="Location"
            label="Location"
            value="{{ old('Location', ($editing ? $checkIn->location() : $location )) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>
</div>
