<template>
  <div class="login-page">
    <router-view></router-view>

    <div class="login-box">
      <div style="display: flex; align-items: center; justify-content: center">
        <img :src="'/img/logo.gif'" style="width: 95%; height: 95%" />
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Ingresa tus credenciales para iniciar Sesión</p>

          <form action="../../index3.html" method="post">
            <div class="input-group mb-3">
              <input
                type="email"
                class="form-control"
                placeholder="Usuario"
                v-model="fillLogin.cUsuario"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="far fa-id-badge"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Contraseña"
                v-model="fillLogin.cContraseña"
                @keyup.enter="login"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </form>

          <div class="row">
            <div class="col-md-12">
              <span v-if="error">
                <div
                  v-for="(e, index) in mensajeError"
                  :key="index"
                  v-text="e"
                  class="callout callout-danger"
                ></div>
              </span>
            </div>
          </div>

          <!--  <div class="social-auth-links text-center mb-5">
              <div class="form-group row">
                          <label class="col-md-3 col-form-label">Seleccione el año</label>


            <el-select v-model="fillLogin.cSelectAnios" placeholder="Select">

              <el-option

                v-for="item in rangoAnios"
                :key="item.value"
                :label="item.label"
                :value="item.value"

              >
              </el-option>
            </el-select>
          </div>
          </div> -->

          <div class="social-auth-links text-center mb-3">
            <button class="btn btn-block btn-primary btn-flat" @click.prevent="login">
              ingresar
            </button>
          </div>
          <!-- /.social-auth-links -->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      fillLogin: {
        cUsuario: "",
        cContraseña: "",
        /*  cSelectAnios:"2022", */
      },
      /*      rangoAnios: [
      {label: '2021', value: '2021' },
      { label: '2022', value: '2022' },
    ], */

      lisRolPermisosByUsuario: [],
      lisRolPermisosByUsuarioFilter: [],
      error: 0,
      mensajeError: [],
    };
  },
  methods: {
    login() {
      if (this.validarLogin()) {
        return;
      }
      var url = "/authenticate/login";
      axios
        .post(url, {
          headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
          cUsuario: this.fillLogin.cUsuario,
          cContraseña: this.fillLogin.cContraseña,
        })
        .then((response) => {
          if (response.data.code == 401) {
            this.loginFailed();
          }
          if (response.data.code == 200) {
            // this.loginSucces();
            this.getListarRolPermisosByUsuario(response.data.AutUser);
            sessionStorage.setItem("iduser", response.data.AutUser.id);
            sessionStorage.setItem("anioDb", this.fillLogin.cSelectAnios);
          }
        });
    },

    getListarRolPermisosByUsuario(AutUser) {
      var url = "/administracion/usuario/getListarRolPermisosByUsuario";
      axios
        .get(url, {
          params: {
            nIdUsuario: AutUser.id,
          },
        })
        .then((response) => {
          this.lisRolPermisosByUsuario = response.data;
          this.filterListarPermisosByUsuario(AutUser);
        });
    },

    filterListarPermisosByUsuario(AutUser) {
      let me = this;
      me.lisRolPermisosByUsuarioFilter = [];
      me.lisRolPermisosByUsuario.map(function (x, y) {
        me.lisRolPermisosByUsuarioFilter.push(x.slug);
      });

      sessionStorage.setItem(
        "listRolPermisosByUsuario",
        JSON.stringify(me.lisRolPermisosByUsuarioFilter)
      );
      sessionStorage.setItem("AutUser", JSON.stringify(AutUser));
      this.loginSucces();
    },

    loginFailed() {
      this.error = 0;
      this.mensajeError = [];

      this.mensajeError.push("Ingreso incorrecto, intentelo otra vez");
      this.fillLogin.cContraseña = "";
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
    loginSucces() {
      this.$router.push({ name: "dashboard.index" });
      location.reload();
    },

    validarLogin() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillLogin.cUsuario) {
        this.mensajeError.push("El campo Usuario es obligatorio");
      }
      if (!this.fillLogin.cContraseña) {
        this.mensajeError.push("El campo Contraseña es obligatorio");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
  },
};
</script>
