<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">
            @if ($new_messages_count)
                {{ $new_messages_count }}
            @endif
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header"> {{ $new_messages_count }} Notifications</span>
        <div class="dropdown-divider"></div>
        @forelse ($notifications as $notification)
            <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}" class="dropdown-item">
                <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification->data['url'] }}
                <span class="float-right text-muted text-sm">{{ $notification->created_at }}</span>
            </a>
        @empty
            <p>no notifications</p>
        @endforelse

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
