<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.check_in.create_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>                
                <x-form
                    method="POST"
                    action="{{ route('check-ins.store') }}"
                    has-files
                    class="mt-4"
                    enctype="multipart/form-data"
                >
                    @include('app.check_ins.form-inputs')

                    <div class="mt-10">                        
                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            Complete Check-In
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
