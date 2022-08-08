<template>
  <div class="btn-group">
    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
      <i class="fas fa-download"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" role="menu">
      <a href="#" class="dropdown-item" @click.prevent="descargarPDF">
        <span class="float-right text-muted"><i class="fas fa-file-pdf"></i></span>
        Descargar PDF
      </a> 
      <a href="#" class="dropdown-item" @click.prevent="descargarXLSX">
        <span class="float-right text-muted"><i class="fas fa-file-excel"></i></span>
        Descargar XLSX
      </a>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        
      }
    },
    methods: {
      descargarPDF() {
        axios.get('/usuario/descargarPDF').then(res => {
          console.log(res.data);
        }).catch(err => {
          console.log(err.response.data);
        })
      },
      descargarXLSX() {
        axios.get('/usuario/descargarXLSX').then(res => {
          const Respuesta = Swal.mixin({
            toast: true,
            position: 'bottom',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Respuesta.fire({
            icon: 'success',
            title: res.data
          })
        }).catch(err => {
          console.log(err.response.data);
        })
      }
    }
  };
</script>

<style>
    
</style>