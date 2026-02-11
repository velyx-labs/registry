<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.velyx', ['title' => 'Velyx - Build Laravel interfaces at velocity'])]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page');
    }
}
