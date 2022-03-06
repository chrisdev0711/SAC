<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.plug_check.create_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>               
                <x-form
                    method="POST"
                    action="{{ route('plug-checks.store') }}"
                    class="mt-4"
                >
                    @include('app.plug_checks.form-inputs')

                    <div class="mt-10">
                                              
                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            Complete Plug Check
                        </button>
                        <a href="{{ route('plug-checks.setStausScrapped', ['appliance_id'=>$appliance_id]) }}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded-md float-right mr-5">
                            <!-- <i class="mr-1 icon ion-close-circle"></i> -->
                            BER
                        </a>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
