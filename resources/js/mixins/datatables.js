module.exports = {
  methods: {
    tabla() {
      $(function() {
        $('#usuario-tabla').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "language": {
            "sLoadingRecords":  "Cargando...",
            "sSearch":          "Buscar:",
            "lengthMenu":       "Mostrar _MENU_ registros por página.",
            "zeroRecords":      "Sin registros encontrados",
            "info":             "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros.",
            "sInfoEmpty":       "Mostrando registros del 0 al 0 de un total de 0 registros.",
            "infoEmpty":        "No hay registros disponibles.",
            "infoFiltered":     "(Filtrado de _MAX_ registros totales)",
            "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },                
          }
        });
      }) 
    },
  }
}