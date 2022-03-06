<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mt-4 px-4">
                    <div class="mb-4 text-3xl" style="font-size: 42px; margin-bottom:10px;">
                        <span>{{ $appliance->SACNo ?? '-' }}</span>
                    </div>
                    <div class="mb-8">
                        {!! QrCode::size(400)->backgroundColor(255,255,255)->generate(env('APP_URL') . '/sac/' . $appliance->SACNo) !!}
                    </div>
                    <div class="mt-8">
                        <span style="font-size: 24px;"><br />Removing label will invalidate warranty.</span>
                    </div>
                </div>
            </x-partials.card>
        </div>
    </div>
