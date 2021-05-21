<template>
  <div>
    <div class="content container-fluid">
      <div class="card-body">
        <form role="form">
          <div class="form-group row float-right" style="display: inline-block;display: inline-block;">
            <button
              @click.prevent="getPdfCotizacion"
              class="btn btn-danger btn-lg"
            >
              <span><i class="far fa-file-pdf"></i></span> PDF
            </button>

             <button
              @click.prevent="getAtras"
              class="btn btn-primary btn-lg"
            >
              <span><i class="fas fa-angle-double-left"></i></span> Atras
            </button>
          </div>


          <div class="form-group row justify-content-around">
            <div class="col-md-6" style="margin-left: 0 !important">
              <img src="/img/logo02.png" alt="" />
            </div>
            <div class="col-md-6">
              <img src="/img/productos01.png" alt="" style="width: 400px; height: 100px"/>
            </div>
          </div>
        </form>

        <div class="card-body">
          <form role="form">
            <div class="content container-fuid">
              <div class="form-group row justify-content-between">
                <div class="col-md-12">
                  <div class="col-md-3"></div>
                  <div class="col-md-4">
                    <h6 class="text-center">
                      <strong
                        >DE MEDIDORES, ACCESORIOS Y INSUMOS PARA AGUA POTABLE
                        SERVICIO DE INSTALACION, CONTRASTACION Y REPARACION DE
                        MEDIDORES DE AGUA</strong
                      >
                    </h6>
                  </div>

                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <h5 class="border border-dark text-center">
                      <strong>COTIZACION Nº {{this.fillBsPpdfCoti.nroCoti}}</strong>
                    </h5>
                  </div>

                  <div class="col-md-8 border border-dark">
                    <div class="row">
                      <div class="col-md-3"><b>SEÑORES :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.razonsocial }}
                      </div>
                      <div class="col-md-3"><b>DIRECCION :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.direccion }}
                      </div>
                      <div class="col-md-3"><b>RUC :</b></div>
                      <div class="col-md-8">{{ this.fillBsPpdfCoti.ruc }}</div>
                      <div class="col-md-3"><b>ATENCION :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.atencion }}
                      </div>
                      <div class="col-md-3"><b>TELEFONO :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.telefono }}
                      </div>
                      <div class="col-md-3"><b>CELULAR :</b></div>
                      <div class="col-md-8"></div>

                      <div class="col-md-3"><b>DESTINO :</b></div>
                       <div class="col-md-8">
                       {{this.fillBsPpdfCoti.puntollegada}}
                       </div>

                      <div class="col-md-3"><b>TRANSPORTE :</b></div>
                      <div class="col-md-8">
                        {{this.fillBsPpdfCoti.transporte}}
                        </div>
                      <div class="col-md-3"><b>CORREO :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.email }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 border border-dark">
                    <div class="row">
                        <div class="col-md-3"><b>FECHA :</b></div>
                      <div class="col-md-8"> {{ this.fillBsPpdfCoti.fecha | moment("DD - MM - Y") }}</div>
                      <div class="col-md-3"><b>MONEDA :</b></div>
                      <div class="col-md-8">SOLES</div>
                      <div class="col-md-3"><b>VENDEDOR :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.nombreVendedor }}
                      </div>

                      <div class="col-md-3"><b>CELULAR :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.celularVendedor }}
                      </div>
                      <div class="col-md-3"><b>CENTRAL :</b></div>
                      <div class="col-md-8">01-282-2376</div>
                      <div class="col-md-3"><b>EMAIL :</b></div>
                      <div class="col-md-8">{{ this.fillBsPpdfCoti.emailvendedor }}</div>
                    </div>
                  </div>

                  <div>
                    <h6>
                      De nuestra consideración: Hacemos llegar con la presente
                      nuestra propuesta económica, según se muestra a
                      continuación
                    </h6>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="colorcabecera">Nro</th>
                        <th scope="col" class="colorcabecera">CANT</th>
                        <th scope="col" class="colorcabecera">MEDIDA</th>
                        <th scope="col" class="colorcabecera">
                          DESCRIPCION DEL MEDIDOR
                        </th>
                        <th scope="col" class="colorcabecera">P/UNIT</th>
                        <th scope="col" class="colorcabecera">TOTAL S/IGV</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listdetalleCoti" :key="index">
                        <th scope="row">{{index+1}}</th>
                        <td v-text="item.cantidad"></td>
                        <td v-text="item.unidmedida.nombre"></td>
                        <td
                          v-text="
                            item.producto.familia.nombre +
                            ',' +
                            item.producto.subfamilia.nombre +
                            ', MODELO :' +
                            item.producto.modelotipo.nombre +
                            ', MATERIAL :' +
                            item.producto.material.nombre +
                            ', MARCA :' +
                            item.producto.marca.nombre + '- '+ item.producto.homologacion.nombre
                          "
                        ></td>
                        <td>{{item.punit | currency }}</td>
                        <td

                          class="text-right"
                        >{{ item.total  | currency}}</td>
                      </tr>

                      <tr>
                        <td colspan="3" rowspan="4">
                          <img src="/img/producto02.png" alt="" />
                        </td>
                        <td></td>
                        <td class="colorcabecera">Sub Total</td>
                        <template>
                          <td class="text-right">{{ this.convertMoney(SubTotal) }}</td>
                        </template>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="colorcabecera">IGV 18%</td>
                        <td class="text-right">{{ varIgv | currency }}</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="colorcabecera">TOTAL GENERAL</td>
                        <td class="colorcabecera text-right">{{ this.convertMoney(varTotalGeneral) }}</td>
                      </tr>
                    </tbody>
                  </table>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="3" class="text-center">
                          CUENTAS CORRIENTES INVERSIONES NOVESUR
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr style="background-color: lightgreen">
                        <th class="text-center">BANCO</th>
                        <td class="text-center"><b>CTE. SOLES</b></td>
                        <td class="text-center">
                          <b>CTA. INTERBANCARIO CCI</b>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center text-danger">BCP</th>
                        <td class="text-center">193-1760590-0-36</td>
                        <td class="text-center">CCI 002-193-001760590036-18</td>
                      </tr>
                      <tr>
                        <th class="text-center text-success">BBVA</th>
                        <td class="text-center">0011-0933-0100025143-97</td>
                        <td class="text-center">CCI 011-933-000100025143-97</td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="col-md-12">
                    <div class="row">
                      <strong>Condiciones Comerciales:</strong>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><b>Validez de Oferta: :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.validezoferta }}
                      </div>

                      <div class="col-md-3"><b>Entrega: :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.entrega }}
                      </div>
                      <div class="col-md-3"><b>Forma de pago: :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.formaDPago }}
                      </div>
                      <div class="col-md-3"><b>Pago: :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.pago }}
                      </div>
                      <div class="col-md-3"><b>Flete :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.flete }}
                      </div>

                      <div class="col-md-3"><b>Documentaciòn: :</b></div>
                      <div class="col-md-8">
                        {{ this.fillBsPpdfCoti.documentacion }}
                      </div>
                      <div class="col-md-3"><b>Garantia: </b></div>
                      <div class="col-md-12">
                        {{ this.fillBsPpdfCoti.garantia }}  por defectos de fabricaciòn (no cubre los originados por mala manipulaciòn, vandalismo, golpes, mala instalaciòn POR TERCEROS, mala operaciòn, exceso de presiòn y temperaturas)
                      </div>

                      <div class="col-md-8 mt-3">Atentamente</div>
                      <div></div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6"></div>
                        <div class="col-md-5 ml-5">
                           {{ this.fillBsPpdfCoti.nombreVendedor }}
                        </div>

                        <div class="col-md-5 ml-5">coordinador Comercial</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 offset-3">
                        <div class="col-md-12">
                          Jr. Monte Abeto 376 Urb. Monterrico Sur - santiago de
                          Surco
                        </div>

                        <div class="col-md-12 ml-5">
                          Ventas@novesur.com / www.novesur.com
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillBsPpdfCoti: {
        nidCoti: this.$attrs.id,
        razonsocial: "",
        direccion: "",
        ruc: "",
        atencion: "",
        telefono: "",
        email: "",
        nombreVendedor: "",
        celularVendedor: "",
        validezoferta: "",
        entrega: "",
        formaDPago: "",
        pago:"",
        flete: "",
        documentacion: "",
        garantia: "",
        fecha: "",
        nroCoti:"",
        anioCoti:"",
        IdString:"",
        emailvendedor:"",
        puntollegada:"",
        transporte:"",
      },
      listdetalleCoti: [],
      SubTotal: 0,
      varIgv: 0,
      varTotalGeneral: 0,
      varTotal:0,

    };
  },
  mounted() {
    this.getGeneraCotizacion();
  },
  methods: {
      getAtras(){
            history.back()
      },
    getGeneraCotizacion() {
      var url = "/administracion/cotizacion/CotizacionCabecera";
      axios
        .get(url, {
          params: {
            nidCoti: this.fillBsPpdfCoti.nidCoti,
          },
        })
        .then((response) => {
          this.fillBsPpdfCoti.razonsocial =
            response.data[0].cliente.razonsocial;
          this.fillBsPpdfCoti.direccion = response.data[0].cliente.direccion;
          this.fillBsPpdfCoti.ruc = response.data[0].cliente.ruc;
          this.fillBsPpdfCoti.atencion = response.data[0].cliente.atencion;
          this.fillBsPpdfCoti.telefono = response.data[0].cliente.telefono;
          this.fillBsPpdfCoti.email = response.data[0].cliente.email;
          this.fillBsPpdfCoti.nombreVendedor = response.data[0].user.fullname;
          this.fillBsPpdfCoti.celularVendedor = response.data[0].user.celular;
          this.fillBsPpdfCoti.validezoferta = response.data[0].validezoferta;
          this.fillBsPpdfCoti.entrega = response.data[0].Entrega;
          this.fillBsPpdfCoti.formaDPago = response.data[0].tipopago.nombre;
          this.fillBsPpdfCoti.pago = response.data[0].pago.nombre;

          this.fillBsPpdfCoti.flete = response.data[0].flete;
          this.fillBsPpdfCoti.documentacion = response.data[0].documentacion;
          this.fillBsPpdfCoti.garantia = response.data[0].garantia.nombre;
          this.fillBsPpdfCoti.fecha = response.data[0].fecha;
          this.fillBsPpdfCoti.anioCoti = response.data[0].fecha;
          this.fillBsPpdfCoti.IdString= response.data[0].id;
          this.fillBsPpdfCoti.emailvendedor = response.data[0].user.email;
          this.fillBsPpdfCoti.puntollegada = response.data[0].punto_llegada;
          this.fillBsPpdfCoti.transporte = response.data[0].transporte;



          this.fillBsPpdfCoti.nroCoti = this.fillBsPpdfCoti.IdString.toString().padStart(3,'0') +'-'+ this.fillBsPpdfCoti.fecha.substring(0,4)

          this.getlistDetalleCotizacion();
        });
    },
    getlistDetalleCotizacion() {
      var url = "/administracion/detallecotizancion/listDetCotizacionBy";
      axios
        .get(url, {
          params: {
            item: this.fillBsPpdfCoti.nidCoti,
          },
        })
        .then((response) => {

          let data = response.data.map(function (item) {
            const total = item.cantidad * Number(item.punit);
            return { ...item, total: total };
          });

          this.SubTotal = data.reduce(function (acum, item) {
            return acum + item.total;
          }, 0);

          (this.varIgv = this.SubTotal * 0.18),
            (this.varTotalGeneral = this.SubTotal + this.varIgv);


          this.listdetalleCoti = data;


          (this.varTotal = response.data.cantidad * response.data.punit)



        });
    },

    getPdfCotizacion() {
      var config = { responseType: "blob" };
      var url = "/administracion/cotizacion/CotizacionPdf";
      axios
        .post(
          url,
          {
            params: {
              item: this.fillBsPpdfCoti.nidCoti,
            },
          },
          config
        )
        .then((response) => {

          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
        });
    },
     convertMoney(value) {
      const formatterPeso = new Intl.NumberFormat("es-PE", {
        style: "currency",
        currency: "PEN",
        minimumFractionDigits: 2,
      });
      let valueFinal = formatterPeso.format(value);

      return valueFinal;
    },
  },
};
</script>

<style>
body {
  font-size: 13px;
}
.colorcabecera {
  background-color: #f1edec;
}
</style>
