<div class="form-group col-sm btn-sm"> 
    <label for="sku_armado">{{ __('SKU-ID') }} </label>
    <div class="input-group">      
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <input type="text" class="form-control" disabled value="AC-{{ $armado->id }}">
    </div>
    <span class="text-danger">{{ $errors->first('sku_armado') }}</span>
</div>