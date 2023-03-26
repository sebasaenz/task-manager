<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\TaskGroup;
use App\Models\Task;

class AddTaskModal extends ModalComponent
{
    public Task $task;

    public function render()
    {
        return view('livewire.add-task-modal', [
            'repetitions' => ['daily', 'weekly', 'monthly', 'yearly'],
            'taskGroups' => TaskGroup::all()
        ]);
    }

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function save()
    {
        $this->validate();

        $this->task->last_completed = now();
        $this->task->user_id = auth()->id();
        $this->task->save();

        $this->closeModalWithEvents([
            PendingTasksList::getName() => 'taskListUpdated'
        ]);
    }

    protected function rules(): array
    {
        return [
            'task.name' => 'required|max:250',
            'task.duration' => 'required|between:0,1440',
            'task.repetition' => 'required',
            'task.task_group_id' => 'required'
        ];
    }
}
