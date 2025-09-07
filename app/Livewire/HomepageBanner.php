<?php

namespace App\Livewire;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HomepageBanner extends Component
{
    public bool $visibility = false;

    public string $text;

    public $updated;

  public function mount()
  {
    if(Cache::get('homepage_banner')){
      $homepage_banner = json_decode(Cache::get('homepage_banner'));
      $this->visibility = $homepage_banner->visibility;
      $this->text = $homepage_banner->text;
    }
    }

    public function render()
    {
        return view('livewire.homepage-banner');
    }

    public function update() {
      $this->updated = 'Banner updated';

      $banner = Setting::updateOrCreate(
        ['setting_name' => 'homepage_banner'],
        ['setting_value' => json_encode(array('text' => $this->text, 'visibility' => $this->visibility))]
      );

      Cache::put('homepage_banner', json_encode(array('text' => $this->text, 'visibility' => $this->visibility)), now()->addDays(30));

    }
}
