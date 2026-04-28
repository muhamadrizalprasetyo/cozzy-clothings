<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartBadge extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        if (Auth::check()) {
            $this->count = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $this->count = 0;
        }
    }

    public function render()
    {
        return view('livewire.cart-badge');
    }
}