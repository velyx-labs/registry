<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class LandingPage extends Component
{
    public function render(): View
    {
        return view('livewire.landing-page')
            ->layout('layouts.app', ['title' => 'Velyx - The Foundation for your Design System']);
    }
}
