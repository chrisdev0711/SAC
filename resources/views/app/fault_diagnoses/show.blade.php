<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.fault_diagnosis.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('fault-diagnoses.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.fault_diagnosis.inputs.time_started')
                        </h5>
                        <span>{{ $faultDiagnosis->time_started ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.fault_diagnosis.inputs.time_finished')
                        </h5>
                        <span>{{ $faultDiagnosis->time_finished ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.fault_diagnosis.inputs.fault_found')
                        </h5>
                        <span>{{ $faultDiagnosis->fault_found ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.fault_diagnosis.inputs.parts_required')
                        </h5>
                        <span
                            >{{ $faultDiagnosis->parts_required ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.fault_diagnosis.inputs.repaired')
                        </h5>
                        <span>{{ $faultDiagnosis->repaired ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.fault_diagnosis.inputs.test_again')
                        </h5>
                        <span>{{ $faultDiagnosis->test_again ? 'Yes' : 'No' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('fault-diagnoses.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\FaultDiagnosis::class)
                    <a
                        href="{{ route('fault-diagnoses.create') }}"
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
