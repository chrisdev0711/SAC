<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.appliances.view_image')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>                
                <div
                    x-data="imageViewer('{{\Storage::url($path)}}')"
                >                    
                    <!-- Show the image -->
                    <template x-if="imageUrl">
                        <img
                            :src="imageUrl"
                            class="object-cover rounded border border-gray-200"
                            style="width: 660px; height: 660px;"
                        />
                    </template>                                            
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>