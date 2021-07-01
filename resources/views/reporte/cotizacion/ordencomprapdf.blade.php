<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        @page{
            margin: 1.3rem;
            margin-top:1.9rem;
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
        .cabecera .logo{
            margin: 5px;
        }
        .cabecera table {
            padding: 1px;
            margin-bottom: .2rem;
        }
        table {
            font-size: x-small
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
    </style>
</head>
<body>



<table width="100%" border="0">
        <tr>
          <td>  <img src="{{$logo}}" alt="" /></td>

        </tr>

</table>

      <table width="100%" border="0">
        <tr>
          <td colspan="4" align="center" style="border: 1px; background-color: rgb(175, 243, 166)" ><h3><strong>ORDEN DE COMPRA  Nº {{str_pad($orderCompra->id,3,'0',STR_PAD_LEFT) }} - {{substr($orderCompra->Femision,0,4)}}</strong></h3></td>
        </tr>
            <tr >
          <td colspan="4" align="center" valign="middle" ><strong>REFERENCIA : </strong>{{$orderCompra->Referencia}} </td>
        </tr>

        <tr >
          <td ><strong>PROVEEDOR</strong></td>
          <td>&nbsp;</td>
          <td  ><strong>FACTURAR A  </strong></td>
          <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="left"><strong>SEÑOR(ES) :</strong></td>
            <td>{{$orderCompra->proveedor->nombre}}</td>

            <td><strong>SEÑOR(ES) ::</strong></td>
            <td>    INVERSIONES NOVESUR S.A.C.</td>
        </tr>
        <tr>
            <td align="left"><strong>RUC :</strong></td>
            <td>{{$orderCompra->proveedor->ruc}}</td>
            <td><strong>R.U.C. :</strong></td>
            <td>20492421406</td>
        </tr>


          <tr>
            <td align="left"><strong>DIRECCION :</strong></td>
            <td>{{$orderCompra->proveedor->direccion}}</td>
            <td><strong>DIRECCIÓN:</strong></td>
            <td>JR. MONTE ABETO NRO. 376 URB. MONTERRICO SUR LIMA - LIMA - SANTIAGO DE SURCO</td>
          </tr>

          <tr>
            <td align="left"><strong>TELEFONO:</strong></td>
            <td>{{$orderCompra->proveedor->telefono}}</td>
            <td><strong>TELÉFONO :</strong></td>
            <td>967708348</td>

          </tr>

          <tr>
            <td align="left"><strong>EMAIL : </strong></td>
            <td>{{$orderCompra->proveedor->email}}</td>


            <td><strong>E - MAIL:</strong></td>
            <td>asistente.comercial@novesur.com</td>


          </tr>
          <tr>
            <td align="left"><strong>CONTACTO : </strong></td>
            <td>{{$orderCompra->proveedor->contacto}}</td>
            <td><strong>CONTACTO :</strong></td>
            <td> JOSELYN VERA CIEZA</td>
          </tr>
          <tr>
            <td align="left"><strong>NRO CTA01  S/. :</strong></td>
            <td>{{$orderCompra->proveedor->nrocuenta1}}</td>

          </tr>
          <tr>
            <td align="left"><strong>NRO CTA02  S/. :</strong></td>
            <td>{{$orderCompra->proveedor->nrocuenta2}}</td>
          </tr>

      </table>

<h5><center></center></h5>

 <table width="100%" border="1" >
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
          <td align="center" style="font-size:1em">@php
              echo $i = $i +1 ;
          @endphp</td>
        </td>
          <td align="center" style="font-size:1em">{{$data->cantidad}}</td>
          <td align="center" style="font-size:1em">{{$data->producto->codigo}}</td>
          <td align="center" style="font-size:1em">  {{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
          <td align="center" style="font-size:1em">S/. {{number_format($data->punit,2)  }}</td>

          <td align="right" style="font-size:1em">S/. {{number_format($data->cantidad * $data->punit,2)}}</td>

        </tr>
        @endforeach @endif
        @php
            $subtotal = 0;
                foreach ($DetalleOrderCompra as $data){
                    $valor = ($data->cantidad * $data->punit);
                    $subtotal = $valor + $subtotal;
                }
                    $IGV = $subtotal * 0.18;
                    $total =  $subtotal + $IGV;
        @endphp
        <tr>
          <td colspan="4" rowspan="3" align="center">&nbsp;</td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>SUBTOTAL</strong></td>
          <td align="right" style="font-size:1em">S/. {{number_format($subtotal,2)}}</td>
        </tr>

          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>IGV 18%</strong></td>
          <td align="right" style="font-size:1em">S/.{{number_format($IGV,2)}}</td>
        </tr>
        <tr>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>TOTAL GENERAL</strong></td>
          <td align="right" style="background-color: rgba(238, 229, 229, 0.719,font-size:0.8em)">S/. {{number_format($total,2)}}</td>
        </tr>

</table>
<br>
      <table width="100%" border="0">

        <tr>
          <td width="20%"><strong>Observaciones : </strong></td>
          <td colspan="2">&nbsp;</td>
        </tr>
          <tr>
          <td><strong>CONDICIONES:</strong></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="30%"><strong>Fecha de Entrega :</strong></td>
          <td width="78%"> {{$orderCompra->Fentrega}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><strong>Lugar de Entrega  : </strong></td>
            <td> {{$orderCompra->LugarEntrega}} </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
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

<br>

   <table width="100%" border="1" align="center">
  <tr >
    <td colspan="2" style="text-align: center"><strong>PREFERENCIA DE PAGO :</strong></td>
    <td style="border-bottom:hidden; border-right-color:#FFF">&nbsp;</td>
    <td style="border-bottom-color:#FFF; border-right-color:#FFF; border-left-color:#FFF">&nbsp;</td>
    <td style="border-bottom-color:#FFF; border-left-color:#FFF">&nbsp;</td>
    </tr>

    @if ($orderCompra->pago_id == 5)
    <tr >
        <td width="14%">&nbsp;</td>
        <td style="text-align:center;"> X </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>Cheque Dif. a 15 dias</td>
        <td style="width: 30px"></td>
        <td width="30%" align="center"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
      <tr>
        <td>Factura a 30 Días</td>
        <td>&nbsp;</td>
        <td align="center"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td>Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td style="text-align: center">INVERSIONES NOVESUR S.A.C.</td>
        </tr>
    @endif

    @if ($orderCompra->pago_id == 1)
    <tr>
        <td height="30">Contado</td>
        <td style="border-top-color:rgb(8, 8, 8)">&nbsp;  </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>Cheque Dif. a 15 dias</td>
        <td style="width: 30px ; text-align:center;"> X </td>
        <td width="30%" align="center"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
      <tr>
        <td>Factura a 30 Días</td>
        <td>&nbsp;</td>
        <td align="center"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td>Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td style="text-align: center">INVERSIONES NOVESUR S.A.C.</td>
        </tr>
    @endif

    @if ($orderCompra->pago_id == 2)
    <tr>
        <td style="width: 1px">Contado</td>
        <td>&nbsp;  </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td height="30">Cheque Dif. a 15 dias</td>
        <td style="width: 30px ">&nbsp;  </td>
        <td width="30%" align="center"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
      <tr>
        <td>Factura a 30 Días</td>
        <td style="text-align:center;"> X </td>
        <td align="center"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td>Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td style="text-align: center">INVERSIONES NOVESUR S.A.C.</td>
        </tr>
    @endif

    @if ($orderCompra->pago_id == 7)
    <tr>
        <td height="30" style="height: 25px">Contado</td>
        <td >&nbsp;  </td>
        <td colspan="3" style="border-top-color:#FFF">&nbsp;</td>
        </tr>
      <tr>
        <td style="height: 25px">Cheque Dif. a 15 dias</td>
        <td style="width: 30px ">&nbsp;  </td>
        <td width="30%" align="center"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
      <tr>
        <td style="height: 25px">Factura a 30 Días</td>
        <td>&nbsp;  </td>
        <td align="center"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td>Trans. Bancaria</td>
        <td  style="text-align:center;" > X </td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td align="center">INVERSIONES NOVESUR S.A.C.</td>
        <td style="text-align: center">INVERSIONES NOVESUR S.A.C.</td>
        </tr>
    @endif

</table>

</body>
</html>
