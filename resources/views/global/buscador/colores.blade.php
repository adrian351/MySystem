<div class="row" >
    <div class="form-group col-sm-1">
      <p class="color" id="urgente" data-toggle="tooltip" data-placement="bottom" title="El pedido es Urgente">
        {{ __('Urgente') }}
      </p>
    </div>
    <div class="form-group col-sm-1">
      <p class="color" id="stock" data-toggle="tooltip" data-placement="bottom" title="El pedido es de Stock" >
        {{ __('Stock') }}
      </p>
    </div>
</div>

@section('css')
<style>
  .color{
    margin-top:40px; 
    margin-bottom:10px; 
    padding: 5px; 
    font-weight:bold;
    text-align: center;
    border-radius:10px;
    cursor: pointer;
  }
  #urgente{
    background:#ffffff; 
    border:3px solid #FFF323; 
    
  }
  #stock{
    background:#ff000060;  
    border:3px solid #ff000060; 
  }

</style> 
@endsection

@section('js5')
<script>
  $('#stock').tooltip('enable');
  $('#urgente').tooltip('enable');
</script>
@endsection