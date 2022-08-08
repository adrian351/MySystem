<template>
<div>
  <pre>
    $data | json
  </pre>
  <h1>VUEjs y Laravel</h1>
  <ul class="list-group">
    <li for="item in usuarios">                      
      <span v-text="item.met_de_entreg"></span>
    </li>
  </ul>
</div>
</template>

<script>
  export default {
    data() {
      return {
        usuarios: [],
      }
    },
    mounted() {
      axios.get('/costo-de-envio').then(res => {
        this.usuarios = res.data
        console.log(res);
      }).catch(err => {
        console.log(err);
        
      })
    }
  };
</script>