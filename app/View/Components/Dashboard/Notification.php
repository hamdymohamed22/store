<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notification extends Component
{
    /**
     * Create a new component instance.
     */

    public $notifications; 
    public $new_messages_count; 

    public function __construct()
    {
        $user = Auth::user();
        $this->notifications = $user->notifications;
        // $this->new_messages_count = $user->unreadNotifications->count();
        $this->new_messages_count = 4;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notification');
        // ,compact('notifications', 'new_messages_count')
    }
}
