<template>
  <a href="" class="nav-link" data-widget="pushmenu" @click.prevent="sidebar"><i class="fas fa-bars"></i></a>
</template>

<script>
  export default {
    methods: {
      async sidebar() {
        axios.get('/layouts').then(res => {
          //location.reload(); // Recarga la pagina para visualizar los cambios
        }).catch(err => {
          Swal.fire({
          icon: 'error',
          title: 'Algo salio mal',
          text: 'Error: ' + err.response.data,
        })
        })
      }
    }
  };
</script>