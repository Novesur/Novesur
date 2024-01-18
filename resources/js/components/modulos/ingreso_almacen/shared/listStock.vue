<template>

<div class="row justify-content-center ">
    <div class="col-md-6">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Listado de stocks</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Almacén</th>
                      <th>Stock </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr 
                    v-for="(item, index) in stock"
                    :key="index"
                    >
                      <td v-text="item.almacen"></td>
                      <td v-text="item.stock" ></td> 
                 
                    </tr>
                  </tbody>
                </table>
      
              </div>
            </div>
    </div>
</div>

</template>

<script>
export default {
  props:['stock'],
}
</script>

<style>

</style>