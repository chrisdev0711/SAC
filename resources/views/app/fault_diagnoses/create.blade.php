<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.fault_diagnosis.create_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>                
                <x-form
                    method="POST"
                    action="{{ route('fault-diagnoses.store') }}"
                    class="mt-4"
                >
                    @include('app.fault_diagnoses.form-inputs')

                    <div class="mt-10"> 
                        <button
                            type="submit"
                            name="action"
                            value="waitingParts"
                            class="bg-yellow-400 hover:bg-yellow-600 text-white py-1 px-4 rounded-md border-none mr-4"
                        >
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            Waiting for Parts
                        </button>                       
                        <button
                            type="submit"
                            name="action"
                            vale="default"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            Complete Diagnosis
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
