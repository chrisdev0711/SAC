<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.appliances.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>                
                <x-form
                    method="PUT"
                    action="{{ route('appliances.update', $appliance) }}"
                    class="mt-4"
                >
                    @include('app.appliances.form-inputs')

                    <div class="mt-10">                        
                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                        @if($appliance->Status == "finalized")
                            @if(Auth::user()->hasRole('Admin'))
                            <a
                            href="{{ route('returned.create', ['appliance_id' => $appliance->id]) }}"
                            class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded-md float-right mr-5"
                            >Return
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </a>
                            @endif
                        @endif
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\Action::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Actions </x-slot>

                <livewire:appliance-actions-detail :appliance="$appliance" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
