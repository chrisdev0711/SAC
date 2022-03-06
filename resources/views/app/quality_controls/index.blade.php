<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.quality_control.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\QualityControl::class)
                            <a
                                href="{{ route('quality-controls.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.check_in.inputs.sac_no')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.condition')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_burners')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_pan_supports')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_grill_tray')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_oven_shelves')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_oven_rails')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_door_glass')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.parts_fridge_shelves')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_marks')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_1_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_2_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_3_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_4_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_5_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_6_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_7_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_8_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_9_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_10_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_11_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_12_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_13_img')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.quality_control.inputs.cosmetic_mark_14_img')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($qualityControls as $qualityControl)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->sacNo() ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->condition ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_burners ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_pan_supports ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_grill_tray ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_oven_shelves ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_oven_rails ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_door_glass ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->parts_fridge_shelves ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $qualityControl->cosmetic_marks ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_1_img ? \Storage::url($qualityControl->cosmetic_mark_1_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_2_img ? \Storage::url($qualityControl->cosmetic_mark_2_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_3_img ? \Storage::url($qualityControl->cosmetic_mark_3_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_4_img ? \Storage::url($qualityControl->cosmetic_mark_4_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_5_img ? \Storage::url($qualityControl->cosmetic_mark_5_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_6_img ? \Storage::url($qualityControl->cosmetic_mark_6_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_7_img ? \Storage::url($qualityControl->cosmetic_mark_7_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_8_img ? \Storage::url($qualityControl->cosmetic_mark_8_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_9_img ? \Storage::url($qualityControl->cosmetic_mark_9_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_10_img ? \Storage::url($qualityControl->cosmetic_mark_10_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_11_img ? \Storage::url($qualityControl->cosmetic_mark_11_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_12_img ? \Storage::url($qualityControl->cosmetic_mark_12_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_13_img ? \Storage::url($qualityControl->cosmetic_mark_13_img) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $qualityControl->cosmetic_mark_14_img ? \Storage::url($qualityControl->cosmetic_mark_14_img) : '' }}"
                                    />
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $qualityControl)
                                        <a
                                            href="{{ route('quality-controls.edit', $qualityControl) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $qualityControl)
                                        <a
                                            href="{{ route('quality-controls.show', $qualityControl) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $qualityControl)
                                        <form
                                            action="{{ route('quality-controls.destroy', $qualityControl) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="24">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="24">
                                    <div class="mt-10 px-4">
                                        {!! $qualityControls->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
