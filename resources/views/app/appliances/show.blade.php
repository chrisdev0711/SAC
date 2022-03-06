<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.appliances.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mt-4 px-4 grid grid-cols-2">
                    <div class="mb-4 w-1/2">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.SACNo')
                        </h5>
                        <span>{{ $appliance->SACNo ?? '-' }}</span>
                    </div>
                    <div class="mb-4 w-1/2">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.Status')
                        </h5>
                        <span>{{ $appliance->Status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.ModelNumber')
                        </h5>
                        <span>{{ $appliance->ModelNumber ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.Description')
                        </h5>
                        <span>{{ $appliance->Description ?? '-' }}</span>
                    </div>
                    @if(Auth::user()->hasRole('Admin'))
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.Supplier')
                        </h5>
                        <span>{{ $appliance->Supplier ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.purchase_date')
                        </h5>
                        <span>{{ $appliance->purchase_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.CostExVat')
                        </h5>
                        <span>{{ $appliance->CostExVat ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.VAT')
                        </h5>
                        <span>{{ $appliance->VAT ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.CostIncVAT')
                        </h5>
                        <span>{{ $appliance->CostIncVAT ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.PONumber')
                        </h5>
                        <span>{{ $appliance->PONumber ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.OtherRef')
                        </h5>
                        <span>{{ $appliance->OtherRef ?? '-' }}</span>
                    </div>
                    @endif
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.Location')
                        </h5>
                        <span>{{ $appliance->Location ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appliances.inputs.SerialNum')
                        </h5>
                        <span>{{ $appliance->SerialNum ?? '00000000' }}</span>
                    </div>
                    <div class="mb-4">
                        {!! QrCode::size(100)->backgroundColor(255,255,255)->generate(env('APP_URL') . '/sac/' . $appliance->SACNo) !!}
                        <a href="{{ route('applications.viewQr', ['uuid' =>$appliance->SACNo]) }}" class="m1-4"
                            >click here <i
                                    class="icon ion-md-return-right mr-4"
                                ></i>
                        </a>
                    </div>
                </div>

                <div class="mt-10">
                    @if($appliance->Status == "pending")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Warehouse'))
                        <a
                        href="{{ route('check-ins.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Check In
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "checked in")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Engineering'))
                        <a
                        href="{{ route('plug-checks.create',['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Start Plug Check
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "test & repair")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Engineering'))
                        <a
                        href="{{ route('fault-diagnoses.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Start Fault Diagnosis
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "cleaning")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Cleaning'))
                        <a
                        href="{{ route('cleanings.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Start Cleaning
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "quality control")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('QualityControl'))
                        <a
                        href="{{ route('quality-controls.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Start Quality Control
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "listing")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Listing'))
                        <a
                        href="{{ route('listings.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Listing
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "costing")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Costing'))
                        <a
                        href="{{ route('costings.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Costing
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "ebay")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Ebay'))
                        <a
                        href="{{ route('ebays.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Ebay
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "finalizing")
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Finalized'))
                        <a
                        href="{{ route('finalizeds.create', ['appliance_id' => $appliance->id]) }}"
                        class="mr-1"
                        >
                            <button
                                type="button"
                                class="button button-primary float-right"
                            >
                                Finalizing
                                <i
                                    class="icon ion-md-return-right ml-3"
                                ></i>
                            </button>
                        </a>
                        @endif
                    @elseif($appliance->Status == "finalized")
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
            </x-partials.card>

            @include('app.appliances.images')

            @can('view-any', App\Models\Action::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Actions </x-slot>

                <livewire:appliance-actions-detail :appliance="$appliance" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
