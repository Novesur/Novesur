<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img
        src="/img/logo.png"
        alt="Inversiones Novesur"
        class="img-fluid elevation-5"
        style="opacity: 0.8"
      />
      <span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ usuario.fullname }}</a>
        </div>
      </div>

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block" @click.prevent="logout">
            <i class="fas fa-sign-out-alt"> </i> Cerrar Sesión
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <template v-if="listPermisos.includes('dashboard.index')">
              <router-link class="nav-link active" :to="'/'">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </router-link>
            </template>
          </li>

          <li class="nav-header">Almacen</li>

          <li class="nav-item has-treeview">
            <template v-if="listPermisos.includes('productos.index')">
              <router-link class="nav-link" :to="'/productos'">
                <i class="fas fa-box-open"></i>
                <p>
                  Almacen
                  <i class="fas fa-angle-left right"></i>
                </p>
              </router-link>
            </template>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <template v-if="listPermisos.includes('marca.index')">
                  <router-link class="nav-link" :to="'/marca'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marca</p>
                  </router-link>
                </template>
              </li>
              <li class="nav-item">
                <template v-if="listPermisos.includes('material.index')">
                  <router-link class="nav-link" :to="'/material'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Material</p>
                  </router-link>
                </template>
              </li>
              <li class="nav-item">
                <template v-if="listPermisos.includes('familia.index')">
                  <router-link class="nav-link" :to="'/familia'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Familia</p>
                  </router-link>
                </template>
              </li>
              <li class="nav-item">
                <template v-if="listPermisos.includes('subfamilia.index')">
                  <router-link class="nav-link" :to="'/subfamilia'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Diametro/Longitud</p>
                  </router-link>
                </template>
              </li>

              <li class="nav-item">
                <template v-if="listPermisos.includes('modelotipo.index')">
                  <router-link class="nav-link" :to="'/modelotipo'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Modelo/Tipo</p>
                  </router-link>
                </template>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-dolly-flatbed"></i>
              <p>
                Logistica
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <template v-if="listPermisos.includes('proveedor.index')">
                  <router-link class="nav-link" :to="'/proveedor'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proveedores</p>
                  </router-link>
                </template>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kardex</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-id-badge"></i>
              <p>
                Seguridad
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <template v-if="listPermisos.includes('usuario.index')">
                  <router-link class="nav-link" :to="'/usuario'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </router-link>
                </template>
              </li>
              <li class="nav-item">
                <template v-if="listPermisos.includes('roles.index')">
                  <router-link class="nav-link" :to="'/roles'">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles</p>
                  </router-link>
                </template>
              </li>
              <li class="nav-item">
                  <template v-if="listPermisos.includes('permiso.index')">
                <router-link class="nav-link" :to="'/permiso'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permiso</p>
                </router-link>
                  </template>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fas fa-cash-register"></i>
              <p>
                 Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                   <template v-if="listPermisos.includes('area.ventas')">
                <router-link  class="nav-link" :to= "'/ventas/reporteStock'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporte de Stock</p>
                </router-link>
                   </template>
              </li>
              <li class="nav-item">
         <router-link class="nav-link" :to="'/cliente/index'">                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes</p>
         </router-link>
              </li>
              <li class="nav-item">

                <router-link class="nav-link" :to="'/cotizacion/index'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Pedidos</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/login.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/register.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/forgot-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Forgot Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/recover-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recover Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  props: ["ruta", "usuario", "listPermisos"],

  methods: {
    logout() {
      var url = "/authenticate/logout";
      axios.post(url).then((response) => {
        if (response.data.code == 204) {
          this.$router.push({ name: "login" });
          location.reload();
          sessionStorage.clear();
          storage.clear();
        }
      });
    },
  },
};
</script>

<style>
</style>
