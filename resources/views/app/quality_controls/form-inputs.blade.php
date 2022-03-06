@php $editing = isset($qualityControl) @endphp

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
        <x-inputs.select name="condition" label="Condition">
            @php $selected = old('condition', ($editing ? $qualityControl->condition : '')) @endphp
            <option value="grade a" {{ $selected == 'grade a' ? 'selected' : '' }} >Grade a</option>
            <option value="grade. b" {{ $selected == 'grade. b' ? 'selected' : '' }} >Grade b</option>
            <option value="grade c" {{ $selected == 'grade c' ? 'selected' : '' }} >Grade c</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parts_burners" label="Parts Burners">
            @php $selected = old('parts_burners', ($editing ? $qualityControl->parts_burners : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parts_pan_supports" label="Parts Pan Supports">
            @php $selected = old('parts_pan_supports', ($editing ? $qualityControl->parts_pan_supports : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parts_grill_tray" label="Parts Grill Tray">
            @php $selected = old('parts_grill_tray', ($editing ? $qualityControl->parts_grill_tray : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parts_oven_shelves" label="Parts Oven Shelves">
            @php $selected = old('parts_oven_shelves', ($editing ? $qualityControl->parts_oven_shelves : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parts_oven_rails" label="Parts Oven Rails">
            @php $selected = old('parts_oven_rails', ($editing ? $qualityControl->parts_oven_rails : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parts_door_glass" label="Parts Door Glass">
            @php $selected = old('parts_door_glass', ($editing ? $qualityControl->parts_door_glass : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="parts_fridge_shelves"
            label="Parts Fridge Shelves"
        >
            @php $selected = old('parts_fridge_shelves', ($editing ? $qualityControl->parts_fridge_shelves : 'not required')) @endphp
            <option value="not required" {{ $selected == 'not required' ? 'selected' : '' }} >Not required</option>
            <option value="yes" {{ $selected == 'yes' ? 'selected' : '' }} >Yes</option>
            <option value="no" {{ $selected == 'no' ? 'selected' : '' }} >No</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="cosmetic_marks"
            label="Cosmetic Marks"
            maxlength="255"
            >{{ old('cosmetic_marks', ($editing ?
            $qualityControl->cosmetic_marks : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_1_img ? \Storage::url($qualityControl->cosmetic_mark_1_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_1_img"
                label="Cosmetic Mark 1 Img"
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
                    name="cosmetic_mark_1_img"
                    id="cosmetic_mark_1_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_1_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_2_img ? \Storage::url($qualityControl->cosmetic_mark_2_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_2_img"
                label="Cosmetic Mark 2 Img"
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
                    name="cosmetic_mark_2_img"
                    id="cosmetic_mark_2_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_2_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_3_img ? \Storage::url($qualityControl->cosmetic_mark_3_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_3_img"
                label="Cosmetic Mark 3 Img"
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
                    name="cosmetic_mark_3_img"
                    id="cosmetic_mark_3_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_3_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_4_img ? \Storage::url($qualityControl->cosmetic_mark_4_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_4_img"
                label="Cosmetic Mark 4 Img"
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
                    name="cosmetic_mark_4_img"
                    id="cosmetic_mark_4_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_4_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_5_img ? \Storage::url($qualityControl->cosmetic_mark_5_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_5_img"
                label="Cosmetic Mark 5 Img"
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
                    name="cosmetic_mark_5_img"
                    id="cosmetic_mark_5_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_5_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_6_img ? \Storage::url($qualityControl->cosmetic_mark_6_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_6_img"
                label="Cosmetic Mark 6 Img"
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
                    name="cosmetic_mark_6_img"
                    id="cosmetic_mark_6_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_6_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_7_img ? \Storage::url($qualityControl->cosmetic_mark_7_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_7_img"
                label="Cosmetic Mark 7 Img"
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
                    name="cosmetic_mark_7_img"
                    id="cosmetic_mark_7_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_7_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_8_img ? \Storage::url($qualityControl->cosmetic_mark_8_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_8_img"
                label="Cosmetic Mark 8 Img"
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
                    name="cosmetic_mark_8_img"
                    id="cosmetic_mark_8_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_8_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_9_img ? \Storage::url($qualityControl->cosmetic_mark_9_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_9_img"
                label="Cosmetic Mark 9 Img"
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
                    name="cosmetic_mark_9_img"
                    id="cosmetic_mark_9_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_9_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_10_img ? \Storage::url($qualityControl->cosmetic_mark_10_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_10_img"
                label="Cosmetic Mark 10 Img"
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
                    name="cosmetic_mark_10_img"
                    id="cosmetic_mark_10_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_10_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_11_img ? \Storage::url($qualityControl->cosmetic_mark_11_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_11_img"
                label="Cosmetic Mark 11 Img"
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
                    name="cosmetic_mark_11_img"
                    id="cosmetic_mark_11_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_11_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_12_img ? \Storage::url($qualityControl->cosmetic_mark_12_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_12_img"
                label="Cosmetic Mark 12 Img"
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
                    name="cosmetic_mark_12_img"
                    id="cosmetic_mark_12_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_12_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_13_img ? \Storage::url($qualityControl->cosmetic_mark_13_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_13_img"
                label="Cosmetic Mark 13 Img"
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
                    name="cosmetic_mark_13_img"
                    id="cosmetic_mark_13_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_13_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $qualityControl->cosmetic_mark_14_img ? \Storage::url($qualityControl->cosmetic_mark_14_img) : '' }}')"
        >
            <x-inputs.partials.label
                name="cosmetic_mark_14_img"
                label="Cosmetic Mark 14 Img"
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
                    name="cosmetic_mark_14_img"
                    id="cosmetic_mark_14_img"
                    @change="fileChosen"
                />
            </div>

            @error('cosmetic_mark_14_img')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>
</div>
