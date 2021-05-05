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
          <td>  <img src="{{$productos01}}" alt="" style=" width: 430px; height: 60px; padding-left: 25px"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><strong>VENTA DE MEDIDORES, ACCESORIOS Y INSUMOS PARA AGUA POTABLE SERVICIO DE INSTALACION, CONTRASTACION Y REPARACION DE MEDIDORES DE AGUA</strong></td>
          </tr>
    </table>

      <table width="100%" border="0">
        <tr>
          <td colspan="4" align="center" style="border: 1px; background-color: lightgreen" ><h3><strong>COTIZACION Nº {{str_pad($coti->id,3,'0',STR_PAD_LEFT) }} - {{substr($coti->fecha,0,4)}}</strong></h3></td>
        </tr>

        <tr >
          <td ><strong>SEÑORES:</strong></td>
          <td> {{$coti->cliente->razonsocial}} </td>
          <td ><strong>FECHA:</strong></td>
          <td>  @php

              echo date('d-m-Y', strtotime($coti->fecha));
              @endphp </td>
        </tr>

        <tr>
            <td align="left"><strong>DIRECCION:</strong></td>
            <td> {{$coti->cliente->direccion}}</td>

            <td><strong>VENDEDOR:</strong></td>
            <td>{{$coti->user->firstname .' '. $coti->user->secondname}}</td>
          </tr>
        <tr>
            <td align="left"><strong>RUC:</strong></td>
            <td>{{$coti->cliente->ruc}}</td>
            <td><strong>CELULAR:</strong></td>
            <td>{{$coti->user->celular}}</td>
          </tr>


          <tr>
            <td align="left"><strong>ATENCION:</strong></td>
            <td>{{$coti->cliente->atencion}}</td>
            <td><strong>CENTRAL:</strong></td>
            <td>01-282-2376</td>
          </tr>

          <tr>
            <td align="left"><strong>TELEFONO:</strong></td>
            <td>{{$coti->cliente->telefono}}</td>
            <td><strong>EMAIL:</strong></td>
            <td>{{$coti->user->email}}</td>

          </tr>

          <tr>
            <td align="left"><strong>CELULAR:</strong></td>
            <td>{{$coti->cliente->celular}}</td>


            <td><strong>MONEDA:</strong></td>
            <td>SOLES</td>


          </tr>
          <tr>
            <td align="left"><strong>DESTINO:</strong></td>
            <td></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><strong>CORREO:</strong></td>
            <td>{{$coti->cliente->correo}}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

      </table>

    <h5><center>De nuestra consideración: Hacemos llegar con la presente nuestra propuesta económica, según se muestra a continuación</center></h5>

    <table width="100%" border="1">
        <tr>
          <td align="center" style="background-color:rgba(238, 229, 229, 0.719)"><strong>Nro</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>CANT</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>MEDIDA</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>DESCRIPCION DE MEDIDOR</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"> <strong>P/UNIT</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>Total S/IGV</strong></td>
        </tr>

@php
    $i=0;
@endphp
        @if($detcoti) @foreach ($detcoti as $data)
        <tr>
          <td align="center">@php
              echo $i = $i +1 ;
          @endphp</td>
        </td>
          <td align="center">{{$data->cantidad}}</td>
          <td align="center">{{$data->unidmedida->nombre}}</td>
          <td align="center">{{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre}}</td>
          <td align="center">S/. {{number_format($data->punit,2)  }}</td>

          <td align="right">S/. {{number_format($data->cantidad * $data->punit,2)}}</td>

        </tr>
        @endforeach @endif
        @php
            $subtotal = 0;
                foreach ($detcoti as $data){
                    $valor = ($data->cantidad * $data->punit);
                    $subtotal = $valor + $subtotal;
                }
                    $IGV = $subtotal * 0.18;
                    $total =  $subtotal + $IGV;
        @endphp
        <tr>
          <td colspan="4" rowspan="3" align="center">&nbsp;</td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>SUBTOTAL</strong></td>
          <td align="right">S/. {{number_format($subtotal,2)}}</td>
        </tr>
        <tr>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>IGV 18%</strong></td>
          <td align="right">S/.{{number_format($IGV,2)}}</td>
        </tr>
        <tr>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>TOTAL GENERAL</strong></td>
          <td align="right" style="background-color: rgba(238, 229, 229, 0.719)">S/. {{number_format($total,2)}}</td>
        </tr>

      </table>

      <table width="100%" border="1" align="center" style="margin-top: 5px" >

        <tr>
          <td colspan="3" align="center"><strong>CUENTAS CORRIENTES INVERSIONES NOVESUR</strong></td>
        </tr>
        <tr>
          <td align="center" style="background-color: lightgreen"><strong>BANCO</strong></td>
          <td align="center" style="background-color: lightgreen"><strong>CTE. SOLES</strong></td>
          <td align="center" style="background-color: lightgreen"><strong>CTA. INTERBANCARIO CCI</strong></td>
        </tr>
        <tr>
          <td align="center"  ><strong style="color: red">BCP</strong></td>
          <td align="center">193-1760590-0-36</td>
          <td align="center">CCI 002-193-001760590036-18</td>
        </tr>
        <tr>
          <td align="center"><strong style="color: blue">BBVA</strong></td>
          <td align="center">0011-0933-0100025143-97</td>
          <td align="center">CCI 011-933-000100025143-97</td>
        </tr>
      </table>
      <br>
      <table width="60%" border="0">
        <tr>
          <td colspan="2"><strong>Condiciones Comerciales :</strong></td>
        </tr>
        <tr>
          <td><strong>Validez de Oferta  :</strong></td>
          <td>{{$coti->validezoferta}}</td>
        </tr>
        <tr>
          <td><strong>Entrega :</strong></td>
          <td>{{$coti->Entrega}}</td>
        </tr>
        <tr>
          <td><strong>Forma de pago :</strong></td>
          <td> {{$coti->tipopago->nombre}}</td>
        </tr>
        <tr>
            <td><strong>Pago :</strong></td>
            <td> {{$coti->pago->nombre}}</td>
          </tr>
        <tr>
          <td><strong>Flete  :</strong></td>
          <td>{{$coti->flete}}</td>
        </tr>
        <tr>
          <td><strong>Documentacion :</strong></td>
          <td>{{$coti->documentacion}}</td>
        </tr>
        <tr>
          <td><strong>Garantia : </strong></td>
          <td>{{$coti->garantia->nombre}} por defectos de fabricaciòn (no cubre los originados por mala manipulaciòn, vandalismo, golpes, mala instalaciòn POR TERCEROS, mala operaciòn, exceso de presiòn y temperaturas)</td>
        </tr>
      </table>

   <h6 style="font-weight:normal; margin-bottom: 0px">Atentamente</h6>

   <h6 style="margin-top: 0px;font-weight:normal; margin-left: 40px" >
    Lic. {{$coti->user->firstname .' '.$coti->user->secondname }}<br />
    Coordinador Comercial
   </h6>
   <footer style=" position: absolute;bottom: 0;">
       <h6 style="text-align: center; margin-bottom: 0px;font-weight:normal">Jr. Monte Abeto 376 Urb. Monterrico Sur - santiago de Surco</h6>
       <h6 style="text-align: center; margin-top: 0px;font-weight:normal">Ventas@novesur.com / www.novesur.com</h6>
</footer>
</body>
</html>
