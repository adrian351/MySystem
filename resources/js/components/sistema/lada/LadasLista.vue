<template>





  <table id="lada-tabla" class="table table-hover table-striped table-sm table-bordered">
    <thead class=" border-0" style="background:#343A40;color:#FFF">
      <tr>
        <th>ID</th>
        <th>Lada</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="lada in ladas">
       	<td v-text="lada.id"></td>
       	<td v-text="lada.lada"></td>
       	<td width="1rem" :title="`Editar lada: ${lada.nom} ${lada.apell}`"><a href="#" class="btn btn-light btn-sm p-1"><i class="fas fa-edit"></i></a></td>
        <td width="1rem" :title="`Eliminar lada: ${lada.nom} ${lada.apell}`"><a href="#" class="btn btn-light btn-sm p-1"><i class="far fa-trash-alt"></i></a></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>Lada</th>
        <th colspan="2"></th>
      </tr>
    </tfoot>
  </table>























</template>

<script>
  


  export default {
    data() {
      return {
      	ladas: [],
      }
    },
  
    mounted() {
	   axios.get('lada/listado').then(res => {
        this.ladas = res.data.data;
       	
      }).catch(err => {
        console.log(err.response.data);
      })
                              
	},
    methods: {

    }
  };
</script>

<style>
    
</style>