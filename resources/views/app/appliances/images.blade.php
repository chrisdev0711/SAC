@php $actions = $appliance->photos() @endphp
@if($actions['checkIn'] || $actions['cleaning'] || $actions['qc'])
<x-partials.card class="mt-5">
    <x-slot name="title"> Photos </x-slot>

    @if($actions['checkIn'])
    @php $checkIn = $actions['checkIn'] @endphp
    <div class="flex flex-wrap mb-6">
        <h2 class="w-full font-bold"> Check In Images </h2>
        @if($checkIn->appliance_in_img)
        <x-inputs.group class="w-1/8">
            <a
                href="{{ route('viewImage', ['path' => $checkIn->appliance_in_img]) }}"
                x-data="imageViewer('{{ \Storage::url($checkIn->appliance_in_img) }}')"
            >
                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template>   
                <x-inputs.partials.label
                    name="appliance_in_img"
                    label="Appliance In Img"
                ></x-inputs.partials.label
                >                       
            </a>
        </x-inputs.group>
        @endif
        @if($checkIn->data_badge_img)
        <x-inputs.group class="w-1/8">
            <a
                x-data="imageViewer('{{ \Storage::url($checkIn->data_badge_img) }}')"
            >
                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template>  
                <x-inputs.partials.label
                    name="data_badge_img"
                    label="Data Badge Img"
                ></x-inputs.partials.label
                >                                        
            </a>
        </x-inputs.group>
        @endif
    </div>
    @endif
    @if($actions['cleaning'])
    @php $cleaning = $actions['cleaning'] @endphp
    <div class="flex flex-wrap mb-6">
        <h2 class="w-full font-bold"> Cleaning Images </h2>
        @if($cleaning->inside_before_img)
        <x-inputs.group class="w-1/8">
            <a
                href="{{ route('viewImage', ['path' => $cleaning->inside_before_img]) }}"
                x-data="imageViewer('{{\Storage::url($cleaning->inside_before_img)}}')"
            >
                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template> 
                <x-inputs.partials.label
                    name="inside_before_img"
                    label="In Img Before"
                ></x-inputs.partials.label
                >                                         
            </a>
        </x-inputs.group>
        @endif
        @if($cleaning->outside_before_img)
        <x-inputs.group class="w-1/8">
            <a
                href="{{ route('viewImage', ['path' => $cleaning->outside_before_img]) }}"
                x-data="imageViewer('{{\Storage::url($cleaning->outside_before_img)}}')"
            >
                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template>  
                <x-inputs.partials.label
                    name="outside_before_img"
                    label="Out Img Before"
                ></x-inputs.partials.label
                >                                        
            </a>
        </x-inputs.group>
        @endif
        @if($cleaning->inside_after_img)
        <x-inputs.group class="w-1/8">
            <a
                href="{{ route('viewImage', ['path' => $cleaning->inside_after_img]) }}"
                x-data="imageViewer('{{\Storage::url($cleaning->inside_after_img)}}')"
            >
                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template>   
                <x-inputs.partials.label
                    name="inside_after_img"
                    label="In Img After"
                ></x-inputs.partials.label
                >                                       
            </a>
        </x-inputs.group>
        @endif
        @if($cleaning->outside_after_img)
        <x-inputs.group class="w-1/8">
            <a
                href="{{ route('viewImage', ['path' => $cleaning->outside_after_img]) }}"
                x-data="imageViewer('{{\Storage::url($cleaning->outside_after_img)}}')"
            >
                <!-- Show the image -->
                <template x-if="imageUrl">
                    <img
                        :src="imageUrl"
                        class="object-cover rounded border border-gray-200"
                        style="width: 100px; height: 100px;"
                    />
                </template>    
                <x-inputs.partials.label
                    name="outside_after_img"
                    label="Out Img After"
                ></x-inputs.partials.label
                >                                      
            </a>
        </x-inputs.group>
        @endif
    </div>
    @endif
    @if($actions['qc'])
    @php $qc = $actions['qc'] @endphp
    <div class="flex flex-wrap mb-6">
        <h2 class="w-full font-bold"> Quality Control Images </h2>
        @for($i=1; $i<=14; $i++)
            @if($qc->{'cosmetic_mark_' . $i .'_img'})
            <x-inputs.group class="w-1/8">
                <a
                    href="{{ route('viewImage', ['path' => $qc->{'cosmetic_mark_' . $i .'_img'}]) }}"
                    x-data="imageViewer('{{ \Storage::url($qc->{'cosmetic_mark_' . $i .'_img'}) }}')"
                >
                    <!-- Show the image -->
                    <template x-if="imageUrl">
                        <img
                            :src="imageUrl"
                            class="object-cover rounded border border-gray-200"
                            style="width: 100px; height: 100px;"
                        />
                    </template> 
                    <x-inputs.partials.label
                        name="{'cosmetic_mark_' . $i .'_img'}"
                        label="{{{'Cosmetic Img' . $i}}}"
                    ></x-inputs.partials.label
                    >                         
                </a>
            </x-inputs.group>
            @endif 
        @endfor       
    </div>
    @endif
</x-partials.card>
@endif