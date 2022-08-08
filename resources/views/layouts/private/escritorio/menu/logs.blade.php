@can('logs.index')
  <li class="nav-item">
    <a href="{{ route('logs.index') }}" class="nav-link {{ Request::is('logs*') ? 'active' : '' }}" target="_blank">
      <i class="nav-icon fas fa-bug"></i>
      <p>{{ __('Logs') }}</p>
    </a>
  </li>
@endcan