<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserNameSection extends Component
{
    public $user;
    /**
     * Create a new component instance.
     */
    public function __construct($user = null)
    {
        $this->user = Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-name-section', ['user' => $this->user]);
    }
}
