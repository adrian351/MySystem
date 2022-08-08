<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($jobs) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('QUEUE') }}</th>
          <th>{{ __('PAYLOAD') }}</th>
          <th>{{ __('FECHA') }}</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($jobs as $job)
          <tr title="{{ $job->id }}">
            <td width="1rem">{{ $job->id }}</td>
            <td>{{ $job->queue }}</td>
            <td>{{ $job->payload }}</td>
            <td>{{ $job->created_at }}</td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>