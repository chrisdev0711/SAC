<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.quality_control.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('quality-controls.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.condition')
                        </h5>
                        <span>{{ $qualityControl->condition ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_burners')
                        </h5>
                        <span>{{ $qualityControl->parts_burners ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_pan_supports')
                        </h5>
                        <span
                            >{{ $qualityControl->parts_pan_supports ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_grill_tray')
                        </h5>
                        <span
                            >{{ $qualityControl->parts_grill_tray ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_oven_shelves')
                        </h5>
                        <span
                            >{{ $qualityControl->parts_oven_shelves ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_oven_rails')
                        </h5>
                        <span
                            >{{ $qualityControl->parts_oven_rails ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_door_glass')
                        </h5>
                        <span
                            >{{ $qualityControl->parts_door_glass ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.parts_fridge_shelves')
                        </h5>
                        <span
                            >{{ $qualityControl->parts_fridge_shelves ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_marks')
                        </h5>
                        <span
                            >{{ $qualityControl->cosmetic_marks ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_1_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_1_img ? \Storage::url($qualityControl->cosmetic_mark_1_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_2_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_2_img ? \Storage::url($qualityControl->cosmetic_mark_2_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_3_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_3_img ? \Storage::url($qualityControl->cosmetic_mark_3_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_4_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_4_img ? \Storage::url($qualityControl->cosmetic_mark_4_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_5_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_5_img ? \Storage::url($qualityControl->cosmetic_mark_5_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_6_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_6_img ? \Storage::url($qualityControl->cosmetic_mark_6_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_7_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_7_img ? \Storage::url($qualityControl->cosmetic_mark_7_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_8_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_8_img ? \Storage::url($qualityControl->cosmetic_mark_8_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_9_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_9_img ? \Storage::url($qualityControl->cosmetic_mark_9_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_10_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_10_img ? \Storage::url($qualityControl->cosmetic_mark_10_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_11_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_11_img ? \Storage::url($qualityControl->cosmetic_mark_11_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_12_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_12_img ? \Storage::url($qualityControl->cosmetic_mark_12_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_13_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_13_img ? \Storage::url($qualityControl->cosmetic_mark_13_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.quality_control.inputs.cosmetic_mark_14_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $qualityControl->cosmetic_mark_14_img ? \Storage::url($qualityControl->cosmetic_mark_14_img) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('quality-controls.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\QualityControl::class)
                    <a
                        href="{{ route('quality-controls.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
