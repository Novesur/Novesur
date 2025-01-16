<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    @page {
      margin: 1.3rem;
      margin-top: 1.9rem;
      padding: 1rem;
    }

    body {
      margin: 0px;
    }

    * {
      font-family: verdana, arial, sans-serif;
    }

    .cabecera {
      background-color: #FEFEFE;
      color: #000000;
      padding: 2rem;
      padding-top: .2rem;
      padding-bottom: 0px;
    }

    .cabecera .logo {
      margin: 5px;
    }

    .cabecera table {
      padding: 1px;
      margin-bottom: .2rem;
    }

    table {
      font-size: x-small
    }

    tfoot tr td {
      font-weight: bold;
      font-size: x-small;
    }

    .campo-tabla {
      font-size: 9px
    }
  </style>
</head>

<body>



  <table width="100%" border="0">
    <tr>
      <td> <img src="{{$logo}}" alt="" alt="" style=" width: 200px; height: 70px; padding-left: 25px" /></td>

    </tr>

  </table>

  <table width="100%" border="0">
    <tr>
      <td colspan="5" align="center" style="border: 1px; background-color: rgb(175, 243, 166)">
        <h3><strong>ORDEN DE COMPRA Nº {{$orderCompra->codigo }}</strong></h3>
      </td>


    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" style="font-size: 10px"><strong>REFERENCIA : </strong>{{$orderCompra->Referencia}} </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle">&nbsp;</td>
      <td align="left" valign="middle" style="margin-left: 10px" style="font-size: 10px"><strong>FECHA EMISION</strong></td>
      <td style="padding-right:100px; font-size: 10px"> {{date('d-m-Y', strtotime($orderCompra->Femision))}}</td>
    </tr>

    <tr>
      <td style="font-size: 11px"><strong>PROVEEDOR</strong></td>
      <td>&nbsp;</td>
      <td style="font-size: 11px"><strong>FACTURAR A </strong></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td align="left" style="font-size: 11px"><strong>SEÑOR(ES) :</strong></td>
      <td style="font-size: 10px">{{$orderCompra->proveedor->nombre}}</td>

      <td><strong style="font-size: 11px">SEÑOR(ES) :</strong></td>
      <td style="font-size: 11px"> INVERSIONES NOVESUR S.A.C.</td>
    </tr>
    <tr>
      <td align="left"><strong>RUC :</strong></td>
      <td style="font-size: 10px">{{$orderCompra->proveedor->ruc}}</td>
      <td style="font-size: 11px"><strong>R.U.C. :</strong></td>
      <td style="font-size: 10px">20492421406</td>
    </tr>


    <tr>
      <td align="left" style="font-size: 11px"><strong>DIRECCION :</strong></td>
      <td style="font-size: 10px">{{$orderCompra->proveedor->direccion}}</td>
      <td style="font-size: 11px"><strong>DIRECCIÓN:</strong></td>
      <td style="font-size: 10px">JR. MONTE ABETO NRO. 376 URB. MONTERRICO SUR LIMA - LIMA - SANTIAGO DE SURCO</td>
    </tr>

    <tr>
      <td align="left" style="font-size: 11px"><strong>TELEFONO:</strong></td>
      <td style="font-size: 10px">{{$orderCompra->proveedor->telefono}}</td>
      <td style="font-size: 11px"><strong>TELÉFONO :</strong></td>
      <td style="font-size: 10px">{{$orderCompra->user->celular}}</td>

    </tr>

    <tr>
      <td align="left" style="font-size: 11px"><strong>EMAIL : </strong></td>
      <td style="font-size: 10px">{{$orderCompra->proveedor->email}}</td>


      <td style="font-size: 11px"><strong>E - MAIL:</strong></td>
      <td style="font-size: 10px">{{$orderCompra->user->email}}</td>


    </tr>
    <tr>
      <td align="left" style="font-size: 11px"><strong>CONTACTO : </strong></td>
      <td style="font-size: 10px">{{$orderCompra->proveedor->contacto}}</td>
      <td style="font-size: 11px"><strong>CONTACTO :</strong></td>
      <td style="font-size: 10px"> {{$orderCompra->user->firstname}} {{$orderCompra->user->secondname}} {{$orderCompra->user->lastname }}</td>

    </tr>
    <tr>
        <td align="left" style="font-size: 10px"><strong>NRO CTA01 S/. :</strong></td>
        <td colspan="4" style="font-size: 8">{{$orderCompra->proveedor->nrocuenta1}}</td>

      </tr>

    <tr>
      @if($orderCompra->tipo_ordencompra_id == 1)
      <td align="left" style="font-size: 10px"><strong>NRO CTA02 S/. :</strong></td>
      <td colspan="2" style="font-size: 9px">{{$orderCompra->proveedor->nrocuenta2}}</td>
      @else
      <td align="left" style="font-size: 10px"><strong></strong></td>
      @endif


    </tr>
    <tr>
      @if($orderCompra->tipo_ordencompra_id == 1)
      <td align="left" style="font-size: 10px"><strong>NRO CTA03 S/. :</strong></td>
      <td colspan="2" style="font-size: 9px">{{$orderCompra->proveedor->nrocuenta3}}</td>
      @else
      <td align="left" style="font-size: 10px"><strong></strong></td>
      @endif

    </tr>



  </table>

  <h5>
    <center></center>
  </h5>

  <table width="100%" border="1">
    <tr>
      <td align="center" style="background-color:rgba(238, 229, 229, 0.719)"><strong>Nro</strong></td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>CANT</strong></td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>CODIGO</strong></td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>DESCRIPCION DE MEDIDOR</strong></td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"> <strong>P/UNIT</strong></td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>Total S/IGV</strong></td>
    </tr>

    @php
    $i=0;
    @endphp
    @if($DetalleOrderCompra) @foreach ($DetalleOrderCompra as $data)
    <tr>
      <td align="center" class="campo-tabla">@php
        echo $i = $i +1 ;
        @endphp</td>
      </td>
      <td align="center" class="campo-tabla">{{$data->cantidad}}</td>
      <td align="center" class="campo-tabla">{{$data->producto->codigo}}</td>
      <td align="center" class="campo-tabla"> {{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
      <td align="center" class="campo-tabla">{{$orderCompra->tipocambio->signo}} {{number_format($data->punit,4) }}</td>

      <td align="right" class="campo-tabla">{{$orderCompra->tipocambio->signo}} {{number_format($data->cantidad * $data->punit,2)}}</td>

    </tr>
    @endforeach @endif
    @php
    $subtotal = 0;
    foreach ($DetalleOrderCompra as $data){
    $valor = ($data->cantidad * $data->punit);
    $subtotal = $valor + $subtotal;
    }
    $IGV = $subtotal * 0.18;
    $total = $subtotal + $IGV;
    @endphp

@if($orderCompra->tipo_ordencompra_id == 1)
    <tr>
      <td colspan="4" rowspan="3" align="center">&nbsp;</td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719);" class="campo-tabla"><strong>SUBTOTAL</strong></td>
      <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}} {{number_format($subtotal,2)}}</td>
    </tr>

    <td align="center" style="background-color: rgba(238, 229, 229, 0.719);" class="campo-tabla"><strong>IGV 18%</strong></td>
    <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}}{{number_format($IGV,2)}}</td>
    </tr>
    <tr>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719);" class="campo-tabla"><strong>TOTAL GENERAL</strong></td>
      <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}}{{number_format($total,2)}}</td>
    </tr>
@else
<tr>
    <td colspan="4"  align="center">&nbsp;</td>
    <td align="center" style="background-color: rgba(238, 229, 229, 0.719);" class="campo-tabla"><strong>TOTAL</strong></td>
    <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}} {{number_format($subtotal,2)}}</td>
  </tr>
@endif

  </table>
  <br>
  <table width="100%" border="0">

    <tr>
      <td width="20%" style="font-size: 11px"><strong>Observaciones : </strong></td>
      <td colspan="2" class="campo-tabla">{{$orderCompra->observacion}}</td>
    </tr>

    <tr>
        <td width="20%" style="font-size: 11px"><strong>Doc. a enviar :</strong></td>
        <td colspan="2" class="campo-tabla">{{$orderCompra->documento_enviar}}</td>
      </tr>
    <tr>
      <td style="font-size: 11px"><strong>CONDICIONES:</strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>


    <tr>
      <td>&nbsp;</td>
      <td width="30%" style="font-size: 11px"><strong>Fecha de Entrega :</strong></td>
      <td width="78%" style="font-size: 10px"> {{date('d-m-Y', strtotime($orderCompra->Fentrega))}}
      </td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td style="font-size: 11px"><strong>Lugar de Entrega : </strong></td>
      <td style="font-size: 10px"> {{$orderCompra->LugarEntrega}} </td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td width="30%" style="font-size: 11px"><strong>Forma de pago :</strong></td>
      <td width="78%" style="font-size: 10px"> {{$orderCompra->pago->nombre}}
      </td>
    </tr>
    <tr>
      <td style="font-size: 11px"><b>NOTA</b> :</td>
      <td colspan="2">En   @if($orderCompra->tipo_ordencompra_id == 1) GUIAS DE REMISIÓN y FACTURAS @else las FACTURAS @endif,  deberán indicar el número de esta Orden de Compra.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">La presente Orden de Compra carece de valor si no esta refenciada con sello y firma autorizada.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">Cualquier enmienda o corrección invalida esta Orden de Compra.</td>
    </tr>
<footer>
  </table>
  @if($orderCompra->user->almacen_id == 7)
  <img src="{{URL::asset('/img/firma_piura.png')}}" width="200" height="104">
  @endif
  @if($orderCompra->estadoordencompra_id == 2)


  <p>&nbsp;</p>
  @endif
  <table width="100%" border="0">
    <tr>
      @if($orderCompra->user->almacen_id == 1 && $orderCompra->tipo_ordencompra_id === 2)
      <td width="33%" align="center">
        <img src="{{URL::asset('/img/Firma_Yossi.png')}}" alt="firma" style="width: 200px; height: 100px">
      </td>
      <td width="25%" align="center">&nbsp;</td>
      <td width="40%" align="center">
        <img src="{{URL::asset('/img/firma-sello.gif')}}" alt="firma" style="width: 320px; height: 150px">
      </td>

      @endif
      @if($orderCompra->tipo_ordencompra_id === 1 && $orderCompra->user->almacen_id != 1)
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <td width="33%" align="center">&nbsp;</td>
      <td width="25%" align="center">&nbsp;</td>
      <td width="40%" align="center">&nbsp;</td>

      @endif
    </tr>
    <tr>

      <!-- <td align="center"><strong>Joselyn Vera Cieza</strong></td> -->
      <!-- <td align="center"><strong>{{$orderCompra->user->firstname}} {{$orderCompra->user->secondname}} {{$orderCompra->user->lastname  }}</strong></td> -->
      @if($orderCompra->user->almacen_id == 1)
      <td align="center"><strong>{{$orderCompra->user->firstname}} {{$orderCompra->user->secondname}} {{$orderCompra->user->lastname }}</strong></td>
      @endif

      @if($orderCompra->user->almacen_id == 7)
      <td align="center"><strong>Emilio Hito Zuñiga</strong></td>
      @endif

      <!--    <td align="center"><strong>{{$orderCompra->user->firstname}} {{$orderCompra->user->secondname}} {{$orderCompra->user->lastname  }}</strong></td> -->
      <!-- <td align="center" ><strong>Lusi Principe Bayona</strong></td> -->
      @if($orderCompra->user->almacen_id == 1)
      <!--    <td align="center"><strong>Alexander Díaz Vera</strong></td> -->
      <td align="center"><strong>Lusi Principe Bayona</strong></td>
      @endif
      @if($orderCompra->user->almacen_id == 7)
      <td align="center"><strong>Lusi Principe Bayona</strong></td>
      @endif

    </tr>

    <tr>
      @if($orderCompra->user->almacen_id == 1)
      <td align="center"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
      @endif

      <!--    @if($orderCompra->user->almacen_id == 7)
      <td align="center"><strong>EMISION ORDEN DE COMPRA</strong></td>
      @endif -->

      @if($orderCompra->user->almacen_id == 7)
      <td align="center"><strong>VºBº GERENCIA COMERCIAL</strong></td>
      @endif

      <td align="center"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
      @if($orderCompra->user->almacen_id == 1)
      <td align="center"><strong>VºBº GERENCIA GENERAL</strong></td>
      @endif

      @if($orderCompra->user->almacen_id == 7)
      <td align="center"><strong>JEFE ZONAL</strong></td>
      @endif
    </tr>
  </table>
  </footer>
</body>

</html>
