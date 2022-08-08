<template>
<form @submit.prevent="create" enctype="multipart/form-data">
  <div class="modal fade" id="usu_create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header p-1 bg-dark">
          <h5 class="modal-title">ALTA DE USUARIO</h5>
          <button type="button" class="close p-0 m-0 text-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row" v-if="imagen">
            <div class="form-group col-sm btn-sm">
              <figure>
                <center><img :src="urlImagen" width="200" height="200" alt="Imagen"></center>
              </figure>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="nombre">Nombre(s) *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="nombre" id="nombre" v-model="nombre" class="form-control" placeholder="Nombre(s)" maxlength="30" required>
              </div>
              <span v-if="errors.nombre" class="text-danger" v-text="errors.nombre[0]"></span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="apellidos">Apellidos *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="apellidos" id="apellidos" v-model="apellidos" class="form-control" placeholder="Apellidos" maxlength="30" required>
              </div>
              <span v-if="errors.apellidos" class="text-danger" v-text="errors.apellidos[0]"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="correo">Correo *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" name="correo" id="correo" v-model="correo" class="form-control" placeholder="Correo" maxlength="60" required>
              </div>
              <span v-if="errors.correo" class="text-danger" v-text="errors.correo[0]"></span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="correo_secundario">Correo secundario</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" name="correo_secundario" id="correo_secundario" v-model="correo_secundario" class="form-control" placeholder="Correo secundario" maxlength="60" required>
              </div>
              <span v-if="errors.correo_secundario" class="text-danger" v-text="errors.correo_secundario[0]"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="rol[]">Rol *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-dice-six"></i></span>
                </div>
                 <select name="rol[]" id="rol[]" v-model="rol" class="form-control" multiple="multiple" placeholder="Seleccione . . ." required>
                    <option value="Prueba1">Prueba1</option>
                    <option value="Prueba2">Prueba2</option>
                  </select>
              </div>
              <span v-if="errors.rol" class="text-danger" v-text="errors.rol[0]"></span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="telefono_movil">Teléfono móvil *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <select class="form-control" name="lada" id="lada" v-model="lada" placeholder="Seleccione . . ." required>
                  <option v-for="lada in ladas" v-bind:value="lada.lada" v-text="lada.lada"></option>
                </select>
                <input type="text" name="telefono_movil" id="telefono_movil" v-model="telefono_movil" class="form-control btn-sm" placeholder="Teléfono móvil" maxlength="12" required>
              </div>
              <span v-if="errors.lada" class="text-danger" v-text="errors.lada[0]"></span>
              <span v-if="errors.telefono_movil" class="text-danger" v-text="errors.telefono_movil[0]"></span>
            </div>
          </div>
          <div class="row">
             <div class="form-group col-sm btn-sm">
              <label for="telefono_fijo">Teléfono fijo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-tty"></i></span>
                </div>
                <input type="text" name="telefono_fijo" id="telefono_fijo" v-model="telefono_fijo" class="form-control btn-sm" placeholder="Teléfono móvil" maxlength="12" required>
              </div>
              <span v-if="errors.telefono_fijo" class="text-danger" v-text="errors.telefono_fijo[0]"></span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="extension">Extensión</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" name="extension" id="extension" v-model="extension" class="form-control" placeholder="Extensión" maxlength="5" required>
              </div>
              <span v-if="errors.extension" class="text-danger" v-text="errors.extension[0]"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="password">Password *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
               <input type="password" name="password" id="password" v-model="password" class="form-control" placeholder="Password" autocomplete="off" maxlength="60" required>
                <span class="input-group-append">
                  <button id="show_password1" class="btn btn-info btn-flat btn-sm" type="button" onclick="mostrarPassword('password', 'show_password1', 'icon1')"><span class="fa fa-eye-slash icon1"></span></button>
                </span>
              </div>
              <span v-if="errors.password" class="text-danger" v-text="errors.password[0]"></span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="password_confirmation">Confirmación de password *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" v-model="password_confirmation" class="form-control" placeholder="Password" autocomplete="off" maxlength="60" required>
                <span class="input-group-append">
                  <button id="show_password2" class="btn btn-info btn-flat btn-sm" type="button" onclick="mostrarPassword('password_confirmation', 'show_password2', 'icon2')"><span class="fa fa-eye-slash icon2"></span></button>
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="imagen">Imagen</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
                </div>
                <div class="custom-file">
                  <input type="file" name="imagen" class="custom-file-input" id="input_file" accept="image/jpeg,image/png,image/jpg" @change="obtenerImagen" >
                  <label class="custom-file-label" for="input_file">Max. 1MB</label>
              </div>
              </div>
              <span v-if="errors.imagen" class="text-danger" v-text="errors.imagen[0]"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="observaciones">Observaciones</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-text-width "></i></span>
                </div>
                <textarea name="observaciones" id="observaciones" v-model="observaciones" class="form-control" placeholder="Observaciones" rows="2" cols="1"></textarea>
              </div>
              <span v-if="errors.observaciones" class="text-danger" v-text="errors.observaciones[0]"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <div class="custom-control custom-switch">
                <input type="checkbox" name="checkbox_correo" id="checkbox_correo" v-model="checkbox_correo" class="custom-control-input" checked>
                <label class="custom-control-label" for="checkbox_correo">Enviar correo de bienvenida</label>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group col-sm btn-sm" >
              <button type="button" class="btn btn-default w-50 p-2 border" data-dismiss="modal"><i class="fas fa-undo text-dark"></i>Cerrar</button>
            </div>
            <div class="form-group col-sm btn-sm">
              <button type="submit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i>Registrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</template>

<script>
  export default {
    data() {
      return {
        nombre: '',
        apellidos: '',
        correo: '',
        correo_secundario: '',
        roles: [],
        rol: [],
        ladas: [],
        lada: '',
        telefono_movil: '',
        telefono_fijo: '',
        extension: '',
        password: '',
        password_confirmation: '',
        imagen: '',
        imagen_miniatura: '',
        observaciones: '',
        checkbox_correo: 'on',
        errors: [],
      }
    },
    mounted() {
      axios.get('/sistema/lada/select').then(res => {
        this.ladas = res.data
      }).catch(err => {
        console.log(err.response.data);
      })
    },
    methods: {
      create() {
        axios.post('usuario/almacenar', {
          nombre:                 this.nombre,
          apellidos:              this.apellidos,
          correo:                 this.correo,
          correo_secundario:      this.correo_secundario,
          rol:                    this.rol,
          lada:                   this.lada,
          telefono_movil:         this.telefono_movil,
          telefono_fijo:          this.telefono_fijo,
          extension:              this.extension,
          password:               this.password,
          password_confirmation:  this.password_confirmation,
          imagen:                 this.imagen,
          observaciones:          this.observaciones,
          checkbox_correo:        this.checkbox_correo
        }).then(res => {
          this.nombre = '',
          this.apellidos = '',
          this.correo = '',
          this.correo_secundario = '',
          this.rol = [],
          this.lada = [],
          this.telefono_movil = '',
          this.telefono_fijo = '',
          this.extension = '',
          this.password = '',
          this.password_confirmation = '',
          this.imagen = '',
          this.observaciones = '',
          this.checkbox_correo = 'on'
          this.errors = [],
          EventBus.$emit('usuario-creado', res.data);








const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})






        }).catch(error => {
          if(error.response.status == 422) {
            this.errors = error.response.data.errors
          }
        //  console.log(error.response.data)
        })
      },
      obtenerImagen(e) {
        let file = e.target.files[0];

        this.imagen = file;
        if(this.imagen != undefined) {
          this.cargarImagen(file);
        }
      },
      cargarImagen(file) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.imagen_miniatura = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    },
    computed: {
      urlImagen() {
        return this.imagen_miniatura;
      }
    }
  };
</script>

<style>
    
</style>