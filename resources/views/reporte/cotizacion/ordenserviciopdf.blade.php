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
        <h3><strong>ORDEN DE SERVICIO Nº {{$orderServicio->codigo }} </strong></h3>
      </td>


    </tr>
    <tr>
      <td colspan="5" align="center" valign="middle"><strong>REFERENCIA : </strong>{{$orderServicio->Referencia}} </td>
    </tr>

    <tr>
      <td colspan="2" align="center" valign="middle">&nbsp;</td>
      <td align="left" valign="middle" style="margin-left: 50px"><strong>FECHA EMISION</strong></td>
      <td style="padding-right:100px;"> {{date('d-m-Y', strtotime($orderServicio->Femision))}}</td>
    </tr>

    <tr>
      <td><strong>PROVEEDOR</strong></td>
      <td>&nbsp;</td>
      <td><strong>FACTURAR A </strong></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td align="left"><strong>SEÑOR(ES) :</strong></td>
      <td>{{$orderServicio->proveedor->nombre}}</td>

      <td><strong>SEÑOR(ES) ::</strong></td>
      <td> INVERSIONES NOVESUR S.A.C.</td>
    </tr>
    <tr>
      <td align="left"><strong>RUC :</strong></td>
      <td>{{$orderServicio->proveedor->ruc}}</td>
      <td><strong>R.U.C. :</strong></td>
      <td>20492421406</td>
    </tr>


    <tr>
      <td align="left"><strong>DIRECCION :</strong></td>
      <td>{{$orderServicio->proveedor->direccion}}</td>
      <td><strong>DIRECCIÓN:</strong></td>
      <td>JR. MONTE ABETO NRO. 376 URB. MONTERRICO SUR LIMA - LIMA - SANTIAGO DE SURCO</td>
    </tr>

    <tr>
      <td align="left"><strong>TELEFONO:</strong></td>
      <td>{{$orderServicio->proveedor->telefono}}</td>
      <td><strong>TELÉFONO :</strong></td>
      <td>{{$orderServicio->user->celular}}</td>

    </tr>

    <tr>
      <td align="left"><strong>EMAIL : </strong></td>
      <td>{{$orderServicio->proveedor->email}}</td>


      <td><strong>E - MAIL:</strong></td>
      <td>{{$orderServicio->user->email}}</td>


    </tr>
    <tr>
      <td align="left"><strong>CONTACTO : </strong></td>
      <td>{{$orderServicio->proveedor->contacto}}</td>
      <td><strong>CONTACTO :</strong></td>
      <td> {{$orderServicio->user->firstname}} {{$orderServicio->user->secondname}} {{$orderServicio->user->lastname }}</td>
    </tr>
    <tr>
      <td align="left"><strong>NRO CTA01 S/. :</strong></td>
      <td>{{$orderServicio->proveedor->nrocuenta1}}</td>

    </tr>
    <tr>
      <td align="left"><strong>NRO CTA02 S/. :</strong></td>
      <td>{{$orderServicio->proveedor->nrocuenta2}}</td>
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
    @if($DetalleOrderServicio) @foreach ($DetalleOrderServicio as $data)
    <tr>
      <td align="center" style="font-size:1em">@php
        echo $i = $i +1 ;
        @endphp</td>
      </td>
      <td align="center" style="font-size:1em">{{$data->cantidad}}</td>
      <td align="center" style="font-size:1em">{{$data->producto->codigo }}</td>
      <td align="center" style="font-size:1em"> {{$data->producto->familia->nombre .', MODELO '. $data->producto->modelotipo->nombre }}</td>
      <td align="center" style="font-size:1em">{{$orderServicio->tipocambio->signo}} {{number_format($data->punit,4) }}</td>

      <td align="right" style="font-size:1em">{{$orderServicio->tipocambio->signo}} {{number_format($data->cantidad * $data->punit,2)}}</td>

    </tr>
    @endforeach @endif
    @php
    $subtotal = 0;
    foreach ($DetalleOrderServicio as $data){
    $valor = ($data->cantidad * $data->punit);
    $subtotal = $valor + $subtotal;
    }
    $IGV = $subtotal * 0.18;
    $total = $subtotal + $IGV;
    @endphp
    <tr>
      <td colspan="4" rowspan="3" align="center">&nbsp;</td>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>SUBTOTAL</strong></td>
      <td align="right" style="font-size:1em">{{$orderServicio->tipocambio->signo}} {{number_format($subtotal,2)}}</td>
    </tr>

    <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>IGV 18%</strong></td>
    <td align="right" style="font-size:1em">{{$orderServicio->tipocambio->signo}}{{number_format($IGV,2)}}</td>
    </tr>
    <tr>
      <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>TOTAL GENERAL</strong></td>
      <td align="right" style="background-color: rgba(238, 229, 229, 0.719,font-size:0.8em)">{{$orderServicio->tipocambio->signo}} {{number_format($total,2)}}</td>
    </tr>

  </table>
  <br>
  <table width="100%" border="0">

    <tr>
      <td width="20%"><strong>Observaciones : </strong></td>
      <td colspan="2">{{$orderServicio->observacion}}</td>
    </tr>
    <tr>
      <td><strong>CONDICIONES:</strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="30%"><strong>Fecha de Entrega :</strong></td>
      <td width="78%"> {{date('d-m-Y', strtotime($orderServicio->Fentrega))}}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><strong>Lugar de Entrega : </strong></td>
      <td> {{$orderServicio->LugarEntrega}} </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="30%" style="font-size: 11px"><strong>Forma de pago :</strong></td>
      <td width="78%" style="font-size: 10px"> {{$orderServicio->pago->nombre}}
      </td>
    </tr>
    <tr>
      <td style="font-size: 11px"><b>NOTA</b> :</td>
      <td colspan="2">En la GUIAS DE REMISIÓN y FACTURAS, deberán indicar el número de esta Orden de Compra.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">La presente Orden de Compra carece de valor si no esta refenciada con sello y firma autorizada.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">Cualquier enmienda o corrección invalida esta Orden de Compra.</td>
    </tr>

  </table>
  @if($orderServicio->user->almacen_id == 7)
  <img src="{{URL::asset('/img/firma_piura.png')}}" width="200" height="104">
  @endif
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="100%" border="0">


    <tr>

      @if($orderServicio->user->almacen_id == 7)
      <!-- <td align="center"><strong>Emilio Hito Zuñiga</strong></td> -->
      <td align="center"><strong>Alexander Díaz Vera</strong></td>
      @endif

      @if($orderServicio->user->almacen_id == 1)
      <td align="center"><strong>{{$orderServicio->user->firstname}} {{$orderServicio->user->secondname}} {{$orderServicio->user->lastname }}</strong></td>
      @endif


      <td align="center"><strong>Lusi Principe Bayona</strong></td>

    </tr>
    <tr>
      @if($orderServicio->user->almacen_id == 1)
      <td align="center"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
      @endif


      @if($orderServicio->user->almacen_id == 7)
      <td align="center"><strong>VºBº GERENCIA COMERCIAL</strong></td>
      @endif
      <td align="center"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
      @if($orderServicio->user->almacen_id == 1)
      <td align="center"><strong>VºBº GERENCIA GENERAL</strong></td>
      @endif


      @if($orderServicio->user->almacen_id == 7)
      <td align="center"><strong>JEFE ZONAL</strong></td>
      @endif
    </tr>
  </table>
  <p><br>

  </p>
</body>

</html>