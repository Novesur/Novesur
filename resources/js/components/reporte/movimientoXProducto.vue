<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Movimiento por Producto</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
             <button class="btn btn-info btn-sm" @click="$router.go(-1)" >
              <i class="fas fa-undo-alt"> Regresar</i>
            </button>

             <button
                class="btn btn-info btn-sm" @click.prevent="getexportarExcel">
                <i class="fas fa-file-excel"  ></i> Exportar
              </button>

          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Listado de Reporte</h3>
              </div>
              <div class="card-body table-responsive">
                <table border="1"
                  class="table table-hover table-head-fixed text-nowrap projects " id="tabla" >
                  <thead>
                    <tr >
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td v-bind:colspan='3' class="text-center" style="background-color:#BDE3FB;">ENTRADA</td>
                      <td v-bind:colspan="3" class="text-center" style="background-color:#F5F6CE;">SALIDA</td>
                      <td v-bind:colspan="3" class="text-center" style="background-color:#CEF6CE;">SALDOS</td>

                    </tr>
                    <tr>
                      <td>Fecha</td>
                      <td>Fac. Nº</td>
                      <td>Guia Nº</td>
                      <td>Proveedor / Referencia</td>
                      <td>Cliente</td>
                      <td>Unid / Medida</td>
                      <td style="background-color:#BDE3FB;">Cant</td>
                      <td style="background-color:#BDE3FB;">CU</td>
                      <td style="background-color:#BDE3FB;">Total</td>
                      <td style="background-color:#F5F6CE;">Cant</td>
                      <td style="background-color:#F5F6CE;">C.U</td>
                      <td style="background-color:#F5F6CE;">Total</td>
                      <td style="background-color:#CEF6CE;">CANT</td>
                      <td style="background-color:#CEF6CE;">CU</td>
                      <td style="background-color:#CEF6CE;">Total</td>


                    </tr>
                  </thead>
                  <tbody>
                     <tr
                      v-for="(item, index) in listMovProd"
                      :key="index"

                    >
                      <td>{{ item.fecha | moment("DD - MM - Y") }}</td>
                      <td v-text="item.FactNo"></td>
                      <td v-text="item.GuiaNo"></td>
                      <td v-text="item.provee + ' / '+ item.moti "></td>
                      <td v-text="item.client"></td>
                      <td v-text="item.unidmed" ></td>
                      <td v-text="item.cantidading" style="background-color:#BDE3FB;"></td>
                      <td v-text="item.costuniting" style="background-color:#BDE3FB;"></td>
                      <td  v-text="item.costo_total_ingreso" style="background-color:#BDE3FB;"></td>
                      <td v-text="item.cantidadsali" style="background-color:#F5F6CE;"></td>
                      <td v-text="item.costunitsali" style="background-color:#F5F6CE;"></td>
                      <td v-text="item.costo_total_salida" style="background-color:#F5F6CE;"></td>
                      <td v-text="item.saldo_cantidad" style="background-color:#CEF6CE;"></td>
                      <td  v-text="item.arrayCuTotal"  style="background-color:#CEF6CE;"></td>
                      <td v-text="item.saldo_total" style="background-color:#CEF6CE;"></td>

                    </tr>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillBsqReporteProduct: {
        nIdKardex: this.$attrs.id,
      },
      listMovProd: [],


    };
  },
   mounted(){
      this.getListarUsuarios();
  },

  methods: {

          getListarUsuarios() {
      var url = "/administracion/reportes/movimientoxProducto";
      axios
        .post(url, {

            'nIdKardex': this.fillBsqReporteProduct.nIdKardex,

        })
        .then((response) => {
            this.listMovProd= response.data;

        });
    },

    getexportarExcel(){
     this.exportTableToExcel('tabla');

    },
     exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename?filename+'.xls':'MovimientoxProducto.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}


    },


};
</script>

<style>
</style>
