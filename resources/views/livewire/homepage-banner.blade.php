<div>
  <form wire:submit="update">
    <div class="mb-4">
      <label for="name" class="block text-sm font-medium text-gray-700 sm:pt-2 mb-2">
        Banner text
      </label>
      <div class="mt-1 sm:mt-0">
        <textarea rows="4" cols="80" name="text" id="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" wire:model="text"></textarea>
      </div>
      <div class="mt-2 flex gap-2 items-center">
        <input type="checkbox" name="visible" id="visible" wire:model="visibility" class="focus:ring-olive-400-500 h-4 w-4 text-olive-600 border-gray-300 rounded">
        <label for="visible">Show homepage banner</label>
      </div>
      @if($updated)
        <div class="text-xs text-red-600 my-2">{{ $updated }}</div>
      @endif
      <button type="submit" class="button-primary mt-2">Update</button>
    </div>
  </form>
</div>
