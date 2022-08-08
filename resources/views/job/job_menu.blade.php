@can('logs.index')
  <li class="nav-item">
    <a href="{{ route('job.index') }}" class="nav-link {{ Request::is('job') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de jobs') }}
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('failedJob.index') }}" class="nav-link {{ Request::is('job/failed') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de failed jobs') }}
    </a>
  </li>
@endcan