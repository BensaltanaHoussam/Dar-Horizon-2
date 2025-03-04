<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationsDropdown extends Component
{
    public $notifications;

    public function __construct()
    {
        $this->notifications = auth()->check() ? auth()->user()->notifications()->latest()->take(5)->get() : collect([]);
    }

    public function render()
    {
        return view('components.notifications-dropdown', [
            'notifications' => $this->notifications
        ]);
    }
}