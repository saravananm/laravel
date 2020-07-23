<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Services\AdvertisementService;

class sidepanelbottomadvertisement extends Component
{
    protected $advertisementservice;
    public $advertisementdetails;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(AdvertisementService $advertisementservice)
    {
        $this->advertisementservice = $advertisementservice;
        $this->advertisementdetails = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidepanelbottomadvertisement');
    }
}
