<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                            @can('create', App\Models\Appliance::class)
                            <a
                                href="{{ route('appliances.create') }}"
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
                                    @lang('crud.appliances.inputs.SACNo')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.appliances.inputs.Status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.appliances.inputs.ModelNumber')
                                </th>                                                                                              
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.appliances.inputs.Description')
                                </th>                                                                                               
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.appliances.inputs.SerialNum')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.appliances.inputs.Grade')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($appliances as $appliance)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $appliance->SACNo ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $appliance->Status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $appliance->ModelNumber ?? '-' }}
                                </td>                                                                                                
                                <td class="px-4 py-3 text-left">
                                    {{ $appliance->Description ?? '-' }}
                                </td>                                                                                               
                                <td class="px-4 py-3 text-left">
                                    {{ $appliance->SerialNum ?? '00000000' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $appliance->Grade ?? '-' }}
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
                                        @if(Auth::user()->isAdmin())
                                        <a
                                            href="{{ route('appliances.edit', $appliance) }}"
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
                                        @endif
                                        <a
                                            href="{{ route('appliances.show', $appliance) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @if(Auth::user()->isAdmin())
                                        <form
                                            action="{{ route('appliances.destroy', $appliance) }}"
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
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">
                                    <div class="mt-10 px-4">
                                        {!! $appliances->render() !!}
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
