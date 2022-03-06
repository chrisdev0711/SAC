<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.quality_control.create_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>                
                <x-form
                    method="POST"
                    action="{{ route('quality-controls.store') }}"
                    has-files
                    class="mt-4"
                >
                    @include('app.quality_controls.form-inputs')

                    <div class="mt-10">
                        <button
                            type="submit"
                            name="action"
                            value="backToFault"
                            class="bg-red-400 hover:bg-red-600 text-white py-1 px-4 rounded-md border-none mr-4"
                        >
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            Complete to Fault
                        </button>

                        <button
                            type="submit"
                            name="action"
                            value="backToClean"
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
                            Complete to Clean
                        </button>

                        <button
                            type="submit"
                            name="action"
                            value="default"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            Complete QC
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
