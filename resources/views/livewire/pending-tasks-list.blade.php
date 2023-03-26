<div>
    <div class="mb-3 text-xl font-bold">
        Task list
    </div>
    <div>
        @if (empty($taskList))
            No pending tasks!
        @else
        <table class="table-fixed w-9/12 text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="p-5">Name</th>
                    <th class="p-5">Repetition</th>
                    <th class="p-5">Group</th>
                    <th class="p-5">To be completed</th>
                    <th class="p-5">Complete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taskList as $task)
                    <tr class="bg-white border-b">
                        <td class="p-5">
                            {{ $task['name'] }}
                        </td>
                        <td class="p-5">
                            {{ ucfirst($task['repetition']) }}
                        </td>
                        <td class="p-5">
                            {{ $task['task_group']['name'] }}
                        </td>
                        <td class="p-5">
                            {{ ucfirst($task['to_complete_by']) }}
                        </td>
                        <td class="p-5">
                            <button
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-6"
                                wire:click="complete({{ $task['id'] }})"
                            >
                                Complete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
