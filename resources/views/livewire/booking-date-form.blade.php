<div>
  <form wire:submit="save">
    <label for="booking_start_date">Start of the booking</label>
    <input type="date" id="booking_start_date" name="booking_start_date" wire:model="booking_start_date" />
    <button type="submit">Update</button>
  </form>
</div>
