<div>
    <div class="p-10">
        <form wire:submit.prevent="save">
            <div class="flex flex-col mb-3">
                <label for="name">Name *</label>
                <input type="text" wire:model.defer="task.name">
                @error('task.name')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mb-3">
                <label for="name">Duration (in minutes) *</label>
                <input type="text" wire:model.defer="task.duration">
                @error('task.duration')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mb-3">
                <label for="repetition">Repetition *</label>
                <select wire:model.defer="task.repetition">
                    <option value="">Select a frequency</option>
                    @foreach ($repetitions as $repeats)
                        <option value="{{ $repeats }}">{{ ucfirst($repeats) }}</option>
                    @endforeach
                </select>
                @error('task.repetition')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mb-3">
                <label for="group">Group *</label>
                <select wire:model.defer="task.task_group_id">
                    <option value="">Select a task group</option>
                    @foreach ($taskGroups as $taskGroup)
                        <option value="{{ $taskGroup->id }}">{{ $taskGroup->name }}</option>
                    @endforeach
                </select>
                @error('task.repetition')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-end"
                type="submit"
            >
                Add
            </button>
        </form>
    </div>
</div>