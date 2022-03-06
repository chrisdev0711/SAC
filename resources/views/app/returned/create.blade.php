<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.appliance.return')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>               
                <x-form
                    method="POST"
                    action="{{ route('returned.store') }}"
                    class="mt-4"
                >
                <div class="flex flex-wrap">
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="sac_no"
                            label="SAC Num"
                            value="{{$appliance->SACNo}}"
                            maxlength="255"
                            disabled
                        ></x-inputs.text>
                        <input
                            name="returned_on"
                            type="hidden"
                            value={{date('Y-m-d h:i:s')}}
                        ></input>
                        <input 
                            name="appliance_id" 
                            type="hidden"
                            value="{{$appliance->id}}"></input>
                            <label for="policy_notes" class="block text-sm font-medium text-gray-700">Policy Notes</label>
                        <textarea
                            id="returned_reason"
                            name="returned_reason"
                            rows="5"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Returned reason here"></textarea>
                   
                    </x-inputs.group>                    
                </div>

                    <div class="mt-10">       
                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            Return product
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
