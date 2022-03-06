<div>
    <div>
        @can('create', App\Models\Action::class)
        <button class="button" wire:click="newAction">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Action::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="action.actionable_id"
                            label="Actionable Id"
                            wire:model="action.actionable_id"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="action.actionable_type"
                            label="Actionable Type"
                            wire:model="action.actionable_type"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="action.actioned_by"
                            label="Actioned By"
                            wire:model="action.actioned_by"
                        >
                            <option value="null" disabled>Please select the User</option>
                            @foreach($users as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.appliance_actions.inputs.action')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.appliance_actions.inputs.start_time')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.appliance_actions.inputs.end_time')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.appliance_actions.inputs.actionee')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($actions as $action)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $action->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ str_replace("App\\Models\\" ,"", $action->actionable_type) ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($action->actionable)->time_started ? optional($action->actionable)->time_started : $action->created_at }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($action->actionable)->time_finished ? optional($action->actionable)->time_finished : $action->updated_at }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($action->actionee())->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @if(Auth::user()->isAdmin())
                                <a
                                    href="{{ route('actions.viewAction', ['action_id' => $action->id]) }}"
                                    class="mr-1"
                                >
                                    <button
                                        type="button"
                                        class="button"
                                    >
                                        <i class="icon ion-md-eye"></i>
                                    </button>
                                </a>
                            @endif                            
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="mt-10 px-4">{{ $actions->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
