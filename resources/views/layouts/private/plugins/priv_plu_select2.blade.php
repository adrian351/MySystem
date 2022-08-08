@section('js1')
<script>
  $('.select2').select2({
    theme: 'bootstrap4',
    placeholder: "Seleccione . . .",
    closeOnSelect: false,
    width: 'resolve',
    language: {
      noResults: function() {
        return "No hay resultados";        
      },
      searching: function() {
        return "Buscando . . .";
      }
    }
  });
</script>
@endsection