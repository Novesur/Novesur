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
          <td>  <img src="{{$logo}}" alt="" alt="" style=" width: 200px; height: 70px; padding-left: 25px"/></td>
          <td>  <img src="{{$productos01}}" alt="" style=" width: 400px; height: 40px; padding-left: 25px"/></td>
        </tr>
        <tr>
            <td colspan="2" align="left" style="font-size: 9px; padding-left:60px"><h2 >  RUC : 20492421406 </h2></td>
  </tr>
        <tr>
          <td colspan="2" align="center" style="font-size: 11px"><strong>VENTA DE MEDIDORES, ACCESORIOS Y INSUMOS PARA AGUA POTABLE SERVICIO DE INSTALACION, CONTRASTACION Y REPARACION DE MEDIDORES DE AGUA</strong></td>
        </tr>
</table>

      <table width="100%" border="0">
        <tr>


     <td colspan="4" align="center" style="border: 1px; background-color: #C39BD3;width: -10px;padding-top: 0rem" ><h3><strong>NOTA DE PEDIDO Nº {{$Notapedido->codigo }}</strong></h3></td>

</tr>

        <tr >
          <td style="font-size: 11px"><strong>SEÑORES:</strong></td>
          <td style="font-size: 10px"> {{$Notapedido->cliente->razonsocial}} </td>
          <td style="font-size: 11px"><strong>FECHA:</strong></td>
          <td style="font-size: 10px">{{$Notapedido->fecha}} </td>
      


        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>DIRECCION:</strong></td>
            <td style="font-size: 10px"> {{$Notapedido->cliente->direccion}}</td>

            <td style="font-size: 11px"><strong>VENDEDOR:</strong></td>
            <td style="font-size: 10px">    {{   $Notapedido->vendedor[0]->firstname .' '. $Notapedido->vendedor[0]->secondname}}</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px"><strong>RUC:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->cliente->ruc}}</td>
            <td style="font-size: 11px"><strong>CELULAR:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->vendedor[0]->celular}}</td>
        </tr>


          <tr>
            <td align="left" style="font-size: 11px"><strong>ATENCION:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->cliente->atencion}}</td>
            <td><strong>CENTRAL:</strong></td>
            <td>01-282-2376</td>
          </tr>

          <tr>
            <td align="left" style="font-size: 11px"><strong>TELEFONO:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->cliente->telefono}}</td>
            <td style="font-size: 11px"><strong>EMAIL:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->vendedor[0]->email}}</td>

          </tr>

          <tr>
            <td align="left" style="font-size: 11px"><strong>CELULAR:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->cliente->celular}}</td>


            <td style="font-size: 11px"><strong>MONEDA:</strong></td>
            <td style="font-size: 10px">SOLES</td>

          </tr>
         
          <tr>
            <td align="left" style="font-size: 11px"><strong>DESTINO:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->punto_llegada}}</td>
            <td style="font-size: 11px"><strong>COTIZACION:</strong></td>
            <td style="font-size: 12px"><strong>{{$Notapedido->cotizacion->codigo}}</strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left" style="font-size: 11px"><strong>TRANSPORTE:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->transporte}}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

          <tr>
            <td align="left" style="font-size: 11px"><strong>CONSIGNADO:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->consignado}}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

          <tr>
            <td align="left" style="font-size: 11px"><strong>CORREO:</strong></td>
            <td style="font-size: 10px">{{$Notapedido->cliente->email}}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

</table>

    <h6 style="margin: 0.5em"><center>De nuestra consideración: Hacemos llegar con la presente nuestra propuesta económica, según se muestra a continuación</center></h6>

    <table width="100%" border="1" >
        <tr>
          <td align="center" style="background-color:rgba(238, 229, 229, 0.719); font-size: 12px"><strong>Nro</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px"><strong>CANT</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px"><strong>CODIGO</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px"><strong>DESCRIPCION DEL PRODUCTO</strong></td>
     
        </tr>

@php
    $i=0;
@endphp
        @if($detalleNotapedido) @foreach ($detalleNotapedido as $data)
        <tr>
          <td align="center" style="font-size:1em">@php
              echo $i = $i +1 ;
          @endphp</td>
        </td>
          <td align="center" style="font-size: 10px">{{$data->cantidad}}</td>
          <td align="center" style="font-size: 10px">{{$data->producto->codigo}}</td>
          <td align="center" style="font-size: 10px">  {{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
       

        </tr>
        @endforeach @endif
 
   

</table>

<table width="100%" border="1" align="center" style="margin-top: 5px" >

        <tr>
          <td colspan="3" align="center" style="font-size: 12px"><strong>CUENTAS CORRIENTES INVERSIONES NOVESUR</strong></td>
        </tr>
        <tr>
          <td align="center" style="background-color: lightgreen ;font-size: 11px"><strong>BANCO</strong></td>
          <td align="center" style="background-color: lightgreen;font-size: 11px"><strong>CTE. SOLES</strong></td>
          <td align="center" style="background-color: lightgreen;font-size: 11px"><strong>CTA. INTERBANCARIO CCI</strong></td>
        </tr>
        <tr>
          <td align="center"  ><strong style="color: red">BCP</strong></td>
          <td align="center">193-1760590-0-36</td>
          <td align="center">CCI 002-193-001760590036-18</td>
        </tr>
        <tr>
          <td align="center"><strong style="color: blue">BBVA</strong></td>
          <td align="center">0011-0933-0100025143</td>
          <td align="center">CCI 011-933-000100025143-97</td>
        </tr>
      </table>
      <br>
<table width="100%" border="0">
        <tr>
          <td colspan="2"><strong>Condiciones Comerciales :</strong></td>
        </tr>
        <tr>
          <td width="23%" style="font-size: 11px"><strong>Validez de Oferta  :</strong></td>
          <td width="90%" style="font-size: 10px">{{$Notapedido->validezoferta}}</td>
        </tr>
        <tr>
          <td style="font-size: 11px"><strong>Entrega :</strong></td>
          <td style="font-size: 10px">{{$Notapedido->Entrega}}</td>
        </tr>
        <tr>
          <td style="font-size: 11px"><strong>Forma de pago :</strong></td>
          <td style="font-size: 10px"> {{$Notapedido->tipopago->nombre}}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Pago :</strong></td>
            <td style="font-size: 10px"> {{$Notapedido->pago->nombre}}</td>
        </tr>
        <tr>
          <td style="font-size: 11px"><strong>Flete  :</strong></td>
          <td style="font-size: 10px">{{$Notapedido->flete}}</td>
        </tr>
        <tr>
          <td style="font-size: 11px"><strong>Documentacion :</strong></td>
          <td style="font-size: 10px">{{$Notapedido->documentacion}}</td>
        </tr>
        <tr>
          <td style="font-size: 11px"><strong>Garantia : </strong></td>
          <td style="font-size: 10px">{{$Notapedido->garantia->nombre}} por defectos de fabricaciòn (no cubre los originados por mala manipulaciòn, vandalismo, golpes, mala instalaciòn POR TERCEROS, mala operaciòn, exceso de presiòn y temperaturas)</td>
        </tr>
        <tr>
            <td style="font-size: 12px"><strong>Observación : </strong></td>
            <td style="font-size: 14px"><strong>{{$Notapedido->observacion}}</strong> </td>
        </tr>

</table>

   <h6 style="font-weight:normal; margin-bottom: 0px">Atentamente</h6>

<h6 style=" position: center; margin-top: 0px;font-weight:normal; margin-left: 40px" >
     {{ $Notapedido->vendedor[0]->firstname .' '.$Notapedido->vendedor[0]->secondname }}<br />
    Coordinador Comercial
</h6>
<footer style="position: center; margin-top:50px ">
  <h6 style="text-align: center; margin-bottom: 0px;font-weight:normal">Jr. Monte Abeto 376 Urb. Monterrico Sur - santiago de Surco<br>
    Ventas@novesur.com / www.novesur.com<span style="text-align: center"></span><span style="text-align: right"></span><span style="text-align: justify"></span><span style="text-align: center"></span></h6>
</footer>
</body>
</html>
