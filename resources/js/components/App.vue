<template>
  <div>
    <!-- Navbar -->

    <Navbar></Navbar>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <Sidebar :ruta="ruta" :usuario="AuthUser" :listPermisos="listRolPermisoByUsuario"></Sidebar>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <router-view></router-view>
    </div>

    <!-- /.content-wrapper -->
   <!--  <Footert></Footert>
 -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
</template>

<script>
import Navbar from "./plantilla/Navbar";
import Sidebar from "./plantilla/Sidebar";
import Content from "./plantilla/Content";
import Footert from "./plantilla/Footer";
export default {
  props: ["ruta", "usuario"],
  components: { Navbar, Sidebar, Content, Footert },
  data(){
      return{
          AuthUser: this.usuario,
          listRolPermisoByUsuario:[],
      }
      },
      mounted(){
          //console.log(JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario')));
          this.listRolPermisoByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
            //console.log(sessionStorage.getItem('anioDb'))
          EventBus.$on('notifyRolPermisosByUsuario',data=>{
              this.listRolPermisoByUsuario = data;
          })



},

};
</script>

<style>
</style>
