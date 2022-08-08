@can('logs.index')
  <li class="nav-item has-treeview {{ Request::is('job*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('job*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-database"></i>
      <p>
        {{ __('Jobs') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('job.index') }}" class="nav-link {{ Request::is('job') ? 'active' : '' }}">
          <i class="nav-icon fas fa-list"></i>
          <p>{{ __('Lista de jobs') }}</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('failedJob.index') }}" class="nav-link {{ Request::is('job/failed') ? 'active' : '' }}">
          <i class="nav-icon fas fa-list"></i>
          <p>{{ __('Lista de failed jobs') }}</p>
        </a>
      </li>
    </ul>
  </li>
  @endcan