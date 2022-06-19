<?php

namespace App\Http\Livewire;

use App\Models\Venue;
use Auth;
use Livewire\Component;

class VenueEntry extends Component
{
    public $venue, $venue_name, $venue_address1, $venue_street, $venue_town, $venue_eircode, $venue_county, $venue_website;

    public Venue $newVenue;

    public $venues;

    public $edit_venue;

    public $selected;

    public $showVenue = false;

    protected $listeners = ['venueAdded'=> 'getVenues'];

    protected $rules = [
        'venue_name' => 'required|string',
        'venue_address1' => 'nullable|string|max:50',
        'venue_town' => 'required|string|max:50',
        'venue_street' => 'nullable|string|max:50',
        'venue_eircode' => 'required|string|max:7',
        'venue_website' => 'nullable|url|string|max:50',
        ];

    public function mount($edit_venue = NULL)
    {
       $this->venues = Venue::select('id', 'name', 'town')->orderBy('name', 'asc')->get();
       $this->selected = 0;
       $this->edit_venue = $edit_venue;
    }

    public function save()
    {
        $this->validate();

        $newVenue = Venue::create([
            'name' => $this->venue_name,
            'address1' => $this->venue_address1,
            'street' => $this->venue_street,
            'town' => $this->venue_town,
            'county' => 'Kerry',
            'eircode' => $this->venue_eircode,
            'website' => $this->venue_website,
            'user_id' => Auth::id(),
        ]);

        $this->selected = $newVenue->id;

        $this->resetInputFields();
        $this->emit('venueAdded');

        $this->showVenue = false;
    }

    public function getVenues()
    {
        $this->venues = Venue::select('id', 'name', 'town')->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.venue-entry');
    }

    private function resetInputFields()
    {
        $this->venue_name = '';
        $this->venue_address1 = '';
        $this->venue_street = '';
        $this->venue_town = '';
        $this->venue_county = '';
        $this->venue_eircode = '';
        $this->venue_website = '';
    }
}
