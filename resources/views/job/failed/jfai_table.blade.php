<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($failed_jobs) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('CONNECTION') }}</th>
          <th>{{ __('QUEUE') }}</th>
          <th>{{ __('PAYLOAD') }}</th>
          <th>{{ __('EXCEPTION') }}</th>
          <th>{{ __('FECHA') }}</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($failed_jobs as $failed_job)
          <tr title="{{ $failed_job->id }}">
            <td width="1rem">{{ $failed_job->id }}</td>
            <td>{{ $failed_job->connection }}</td>
            <td>{{ $failed_job->queue }}</td>
            <td>{{ $failed_job->payload }}</td>
            <td>{{ $failed_job->exception }}</td>
            <td>{{ $failed_job->failed_at }}</td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>