<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PendingTasksList extends Component
{
    public array $taskList;

    protected $listeners = ['taskListUpdated' => 'mount', 'refreshComponent' => 'mount'];

    public function render()
    {
        return view('livewire.pending-tasks-list');
    }

    public function mount()
    {   
        $this->taskList = Task::where('user_id', auth()->id())
            ->select()
            ->addSelect(DB::raw('CASE repetition
                    WHEN \'daily\' then DATE_ADD(DATE(last_completed), INTERVAL 1 DAY)
                    WHEN \'weekly\' then DATE_ADD(DATE(last_completed), INTERVAL 1 WEEK)
                    WHEN \'monthly\' then DATE_ADD(DATE(last_completed), INTERVAL 1 MONTH)
                    WHEN \'yearly\' then DATE_ADD(DATE(last_completed), INTERVAL 1 YEAR)
                end as next_completion_date'))
            ->with('taskGroup')
            ->get()
            ->map(function($item, $key) {
                if ($item->next_completion_date <= now()->endOfDay()) {
                    $item->to_complete_by = 'today';
                } else if ($item->next_completion_date <= now()->addDays(1)->endOfDay()) {
                    $item->to_complete_by = 'tomorrow';
                } else if ($item->next_completion_date <= now()->addDays(7)->endOfDay()) {
                    $item->to_complete_by = 'next week';
                } else if ($item->next_completion_date <= now()->addDays(30)->endOfDay()) {
                    $item->to_complete_by = 'near future';
                } else {
                    $item->to_complete_by = 'future';
                }

                return $item;
            })
            ->toArray();
    }

    public function complete($id)
    {
        $task = Task::find($id);
        $task->last_completed = now();
        $task->save();

        $this->emit('refreshComponent');
    }
}
