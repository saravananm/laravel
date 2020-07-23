<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Services\PostService;

class postcoverimage extends Component
{
    protected $postservice;
    public $postcoverimage;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PostService $postservice)
    {
        $this->postservice = $postservice;
        $this->postcoverimage = $this->postservice->getPostCoverImage();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.postcoverimage');
    }
}
