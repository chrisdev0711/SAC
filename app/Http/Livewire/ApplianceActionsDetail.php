<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Action;
use Livewire\Component;
use App\Models\Appliance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplianceActionsDetail extends Component
{
    use AuthorizesRequests;

    public Appliance $appliance;
    public Action $action;
    public $users = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Action';

    protected $rules = [
        'action.actionable_id' => ['required', 'max:255'],
        'action.actionable_type' => ['required', 'max:255', 'string'],
        'action.actioned_by' => ['required', 'exists:users,id'],
    ];

    public function mount(Appliance $appliance)
    {
        $this->appliance = $appliance;
        $this->users = User::pluck('name', 'id');
        $this->resetActionData();
    }

    public function resetActionData()
    {
        $this->action = new Action();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAction()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.appliance_actions.new_title');
        $this->resetActionData();

        $this->showModal();
    }

    public function editAction(Action $action)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.appliance_actions.edit_title');
        $this->action = $action;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->action->appliance_id) {
            $this->authorize('create', Action::class);

            $this->action->appliance_id = $this->appliance->id;
        } else {
            $this->authorize('update', $this->action);
        }

        $this->action->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Action::class);

        Action::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetActionData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->appliance->actions as $action) {
            array_push($this->selected, $action->id);
        }
    }

    public function render()
    {
        return view('livewire.appliance-actions-detail', [
            'actions' => $this->appliance->actions()->orderByDesc('updated_at')->paginate(20),
        ]);
    }
}
