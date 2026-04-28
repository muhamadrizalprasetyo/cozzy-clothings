<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Product;

class ProductComments extends Component
{
    public Product $product;
    public $guest_name;
    public $content;

    public function submitComment()
    {
        $rules = [
            'content' => 'required|min:5'
        ];

        if (!auth()->check()) {
            $rules['guest_name'] = 'required|min:3';
        }

        $this->validate($rules);

        Comment::create([
            'product_id' => $this->product->id,
            'user_id' => auth()->id(),
            'guest_name' => auth()->check() ? auth()->user()->name : $this->guest_name,
            'content' => $this->content,
            'is_approved' => false // Menunggu moderasi
        ]);

        $this->reset(['guest_name', 'content']);

        session()->flash('message', 'Komentar berhasil dikirim dan menunggu persetujuan admin.');
    }

    public function render()
    {
        $comments = Comment::with('user')
            ->where('product_id', $this->product->id)
            ->where('is_approved', true)
            ->latest()
            ->get();

        return view('livewire.product-comments', [
            'comments' => $comments
        ]);
    }
}
