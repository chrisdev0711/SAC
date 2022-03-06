@php $editing = isset($cleaning) @endphp

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
            value="{{ old('time_finished', ($editing ? optional($cleaning->time_finished)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $cleaning->inside_before_img ? \Storage::url($cleaning->inside_before_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="inside_before_img"
                label="Inside Before Img"
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
                    name="inside_before_img"
                    id="inside_before_img"
                    @change="fileChosen"
                />
            </div>

            @error('inside_before_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $cleaning->outside_before_img ? \Storage::url($cleaning->outside_before_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="outside_before_img"
                label="Outside Before Img"
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
                    name="outside_before_img"
                    id="outside_before_img"
                    @change="fileChosen"
                />
            </div>

            @error('outside_before_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $cleaning->inside_after_img ? \Storage::url($cleaning->inside_after_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="inside_after_img"
                label="Inside After Img"
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
                    name="inside_after_img"
                    id="inside_after_img"
                    @change="fileChosen"
                />
            </div>

            @error('inside_after_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $cleaning->outside_after_img ? \Storage::url($cleaning->outside_after_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="outside_after_img"
                label="Outside After Img"
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
                    name="outside_after_img"
                    id="outside_after_img"
                    @change="fileChosen"
                />
            </div>

            @error('outside_after_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>
</div>
