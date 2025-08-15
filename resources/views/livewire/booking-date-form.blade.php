<div>
  <form wire:submit="save" class="flex gap-4 items-center">
    <label for="booking_start_date">Start of the booking</label>
    <input type="date" id="booking_start_date" name="booking_start_date" min="{{ today() }}"
           class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
           wire:model.live="booking_start_date" />
    <button type="submit" class="button-primary">Update</button>
  </form>
  <div class="text-red-500 text-xs mt-2">{{ $update }}</div>
</div>
