<div class="m-6">
    <div class="mb-3 text-xl font-bold">
        Task manager
    </div>
    <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6"
        wire:click="$emit('openModal', 'add-task-modal')"
    >
        Add new task
    </button>
    <livewire:pending-tasks-list>
</div>
