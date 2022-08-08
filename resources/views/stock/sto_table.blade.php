<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
	<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
		@if(sizeof($stocks) == 0)
			@include('layouts.private.busquedaSinResultados')
		@else
			<thead>
				<tr>
					<th>{{ __('ID') }}</th>
					<th>{{ __('CANTIDAD') }}</th>
					<th>{{ __('ARMADO') }}</th>
					<th colspan="2">&nbsp</th>
				</tr>
			</thead>
			<tbody> 
				@foreach($stocks as $stock)
					<tr title={{ $stock->id }}>
						<td width="1rem">{{ $stock->id }}</td>
						<td>{{ $stock->cant }}</td>
						<td title="Detalles: {{ $stock->id }}">
							@can('stock.show')
								<a href="{{ route('stock.show', Crypt::encrypt($stock->id)) }}">{{ $stock->armados[0]->nom }}</a>
							@else
								{{ $stock->armados[0]->nom }}
							@endcan
						</td>
						@include('stock.sto_tableOpciones') 
					</tr>
					@endforeach
			</tbody>
		@endif
	</table>
</div>