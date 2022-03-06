<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.cleaning.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('cleanings.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cleaning.inputs.time_started')
                        </h5>
                        <span>{{ $cleaning->time_started ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cleaning.inputs.time_finished')
                        </h5>
                        <span>{{ $cleaning->time_finished ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cleaning.inputs.inside_before_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $cleaning->inside_before_img ? \Storage::url($cleaning->inside_before_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cleaning.inputs.outside_before_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $cleaning->outside_before_img ? \Storage::url($cleaning->outside_before_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cleaning.inputs.inside_after_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $cleaning->inside_after_img ? \Storage::url($cleaning->inside_after_img) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cleaning.inputs.outside_after_img')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $cleaning->outside_after_img ? \Storage::url($cleaning->outside_after_img) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('cleanings.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Cleaning::class)
                    <a href="{{ route('cleanings.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
