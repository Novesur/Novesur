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
            margin-top: 1rem;
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

        footer {
            position: fixed;

            bottom: 0;

            width: 100%;

            height: 32px;

            padding-bottom: 16px;

            border-top: 2px solid #111;

            z-index: 2000;
        }

        .page-break {
            page-break-before: always;
        }
        table{
            border:none
        }
        th,
/* td {
  padding: 2px;
  text-align: left;
  border: 0px solid #ddd;
}

        .table-listado {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}
th,
.td-listado {
  padding: 4px;
  text-align: left;
  border: 1px solid #ddd;
} */
    </style>
</head>



<body class="page-break">



    <table width="100%" border="0" >
        <tr>
            <td> <img src="{{ $logo }}"
                    style=" width: 200px; height: 70px; padding-left: 25px" /></td>
            <td> <img src="{{ $productos01 }}" alt=""
                    style=" width: 400px; height: 40px; padding-left: 25px" /></td>
        </tr>
        <tr>
            <td colspan="2" align="left" style="font-size: 9px; padding-left:60px;">
                <h2> RUC : 20492421406 </h2>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="font-size: 11px"><strong>VENTA DE MEDIDORES, ACCESORIOS Y INSUMOS
                    PARA AGUA POTABLE SERVICIO DE INSTALACION, CONTRASTACION Y REPARACION DE MEDIDORES DE AGUA</strong>
            </td>
        </tr>
    </table>

    <table width="100%" border="0">
        <tr>
            {{--           <td colspan="4" align="center" style="border: 1px; background-color: rgb(109, 172, 243);width: -10px;padding-top: 0rem" ><h3><strong>COTIZACION Nº {{str_pad($coti->id,3,'0',STR_PAD_LEFT) }} - {{substr($coti->fecha,0,4)}}</strong></h3></td>
 --}}

            <td colspan="4" align="center"
                style="border: 1px; background-color: rgb(109, 172, 243);width: -10px;padding-top: 0rem">
                <h3><center><strong>COTIZACION Nº {{ $coti->codigo }}</strong></center></h3>
            </td>

        </tr>

        <tr>
            <td style="font-size: 11px"><strong>SEÑORES:</strong></td>
            <td style="font-size: 10px"> {{ $coti->cliente->razonsocial }} </td>
            <td style="font-size: 11px"><strong>FECHA:</strong></td>
            <td style="font-size: 10px">
                @if ($coti->fechacotiupdate == null)
                    @php
                        echo date('d-m-Y', strtotime($coti->fecha));
                    @endphp
            </td>
        @else
            @php
                echo date('d-m-Y', strtotime($coti->fechacotiupdate));
            @endphp </td>
            @endif


        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>DIRECCION:</strong></td>
            <td style="font-size: 10px"> {{ $coti->cliente->direccion }}</td>

            <td style="font-size: 11px"><strong>VENDEDOR:</strong></td>
            <td style="font-size: 10px">
                {{ $coti->user->gradousers->cod . ' ' . $coti->user->firstname . ' ' . $coti->user->secondname }}</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px"><strong>RUC:</strong></td>
            <td style="font-size: 10px">{{ $coti->cliente->ruc }}</td>
            <td style="font-size: 11px"><strong>CELULAR:</strong></td>
            <td style="font-size: 10px">{{ $coti->user->celular }}</td>
        </tr>


        <tr>
            <td align="left" style="font-size: 11px"><strong>ATENCION:</strong></td>
            <td style="font-size: 10px">{{ $coti->cliente->atencion }}</td>
            <td><strong>CENTRAL:</strong></td>
            <td>01-282-2376</td>
        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>TELEFONO:</strong></td>
            <td style="font-size: 10px">{{ $coti->cliente->telefono }}</td>
            <td style="font-size: 11px"><strong>EMAIL:</strong></td>
            <td style="font-size: 10px">{{ $coti->user->email }}</td>

        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>CELULAR:</strong></td>
            <td style="font-size: 10px">{{ $coti->cliente->celular }}</td>


            <td style="font-size: 11px"><strong>MONEDA:</strong></td>
            <td style="font-size: 10px">SOLES</td>


        </tr>
        <tr>
            <td align="left" style="font-size: 11px"><strong>DESTINO:</strong></td>
            <td style="font-size: 10px">{{ $coti->punto_llegada }}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px"><strong>TRANSPORTE:</strong></td>
            <td style="font-size: 10px">{{ $coti->transporte }}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>CONSIGNADO:</strong></td>
            <td style="font-size: 10px">{{ $coti->consignado }}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>CORREO:</strong></td>
            <td style="font-size: 10px">{{ $coti->cliente->email }}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

    </table>

    <h6 style="margin: 0.5em">
        <center>De nuestra consideración: Hacemos llegar con la presente nuestra propuesta económica, según se muestra a
            continuación</center>
    </h6>

    <table width="100%" border="1" >
        <tr>
            <td align="center" style="background-color:rgba(238, 229, 229, 0.719); font-size: 12px" ><strong>Nro</strong>
            </td>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px" >
                <strong>CANT</strong>
            </td>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px" >
                <strong>CODIGO</strong>
            </td>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px" ><strong>DESCRIPCION
                    DEL PRODUCTO</strong></td>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px" >
                <strong>P/UNIT</strong>
            </td>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 12px" ><strong>Total
                    S/IGV</strong></td>
        </tr>

        @php
            $i = 0;
        @endphp
        @if ($detcoti)
            @foreach ($detcoti as $data)
                <tr>
                    <td align="center" style="font-size:1em" >@php
                        echo $i = $i + 1;
                    @endphp</td>
                    </td>
                    <td align="center" style="font-size: 10px" >{{ $data->cantidad }}</td>
                    <td align="center" style="font-size: 10px" >{{ $data->producto->codigo }}</td>
                    <td align="center" style="font-size: 10px" >
                        {{ $data->producto->familia->nombre . ' ' . $data->producto->subfamilia->nombre . ', MODELO ' . $data->producto->modelotipo->nombre . ', MATERIAL ' . $data->producto->material->nombre . ', MARCA ' . $data->producto->marca->nombre . ', - ' . $data->producto->homologacion->nombre }}
                    </td>
                    <td align="center" style="font-size: 10px" >S/. {{ number_format($data->punit, 2) }}</td>

                    <td align="right" style="font-size: 9px" >S/.
                        {{ number_format($data->cantidad * $data->punit, 2) }}
                    </td>

                </tr>
            @endforeach
        @endif
        @php
            $subtotal = 0;
            foreach ($detcoti as $data) {
                $valor = $data->cantidad * $data->punit;
                $subtotal = $valor + $subtotal;
            }
            $IGV = $subtotal * 0.18;
            $total = $subtotal + $IGV;
        @endphp
        <tr>
            <td colspan="4" rowspan="3" align="center" >&nbsp;</td>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 10px">
                <strong>SUBTOTAL</strong>
            </td>
            <td align="right" style="font-size: 9px" >S/. {{ number_format($subtotal, 2) }}</td>
        </tr>

        <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 10px" ><strong>IGV
                18%</strong></td>
        <td align="right" style="font-size: 10px">S/.{{ number_format($IGV, 2) }}</td>
        </tr>
        <tr>
            <td align="center" style="background-color: rgba(238, 229, 229, 0.719);font-size: 10px" ><strong>TOTAL
                    GENERAL</strong></td>
            <td align="right" style="background-color: rgba(238, 229, 229, 0.719,font-size:0.8em);font-size: 9px" >S/.
                {{ number_format($total, 2) }}</td>
        </tr>

    </table>

    <table width="100%" border="1" align="center" style="margin-top: 5px" >

        <tr>
            <td colspan="3" align="center" style="font-size: 12px" ><strong>CUENTAS CORRIENTES INVERSIONES
                    NOVESUR</strong></td>
        </tr>
        <tr>
            <td align="center" style="background-color: lightgreen ;font-size: 11px" ><strong>BANCO</strong></td>
            <td align="center" style="background-color: lightgreen;font-size: 11px" ><strong>CTE. SOLES</strong></td>
            <td align="center" style="background-color: lightgreen;font-size: 11px" ><strong>CTA. INTERBANCARIO
                    CCI</strong></td>
        </tr>
        <tr>
            <td align="center"  ><strong style="color: red">BCP</strong></td>
            <td align="center" >193-1760590-0-36</td>
            <td align="center" >CCI 002-193-001760590036-18</td>
        </tr>
        <tr>
            <td align="center" ><strong style="color: blue">BBVA</strong></td>
            <td align="center" >0011-0933-0100025143</td>
            <td align="center" >CCI 011-933-000100025143-97</td>
        </tr>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td colspan="2"><strong>Condiciones Comerciales :</strong></td>
        </tr>
        <tr>
            <td width="23%" style="font-size: 11px"><strong>Validez de Oferta :</strong></td>
            <td width="90%" style="font-size: 10px">{{ $coti->validezoferta }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Entrega :</strong></td>
            <td style="font-size: 10px">{{ $coti->Entrega }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Forma de pago :</strong></td>
            <td style="font-size: 10px"> {{ $coti->tipopago->nombre }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Condicion de pago :</strong></td>
            <td style="font-size: 10px">- TODA COMISON GENERADA POR DEPOSITOS EN AGENTES DE BANCO
                <strong>(PROVINCIA)</strong>, SERÁ ASUMIDA POR EL CLIENTE
            </td>

        </tr>
        <tr>
            <td style="font-size: 11px">&nbsp;</td>
            <td style="font-size: 10px">

                    <div>- El incumplimiento del pago generara interés a la tasa vigente del sistema Bancario
                    </div>

            </td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Pago :</strong></td>
            <td style="font-size: 10px"> {{ $coti->pago->nombre }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Flete :</strong></td>
            <td style="font-size: 10px">{{ $coti->flete }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Documentacion :</strong></td>
            <td style="font-size: 10px">{{ $coti->documentacion }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px"><strong>Garantia : </strong></td>
            <td style="font-size: 10px">{{ $coti->garantia->nombre }} por defectos de fabricaciòn (no cubre los
                originados por mala manipulaciòn, vandalismo, golpes, mala instalaciòn POR TERCEROS, mala operaciòn,
                exceso de presiòn y temperaturas)</td>
        </tr>
        <tr>
            <td style="font-size: 12px"><strong>Observación : </strong></td>
            <td style="font-size: 14px"><strong>{{ $coti->observacion }}</strong> </td>
        </tr>

    </table>

    <div style=" margin-bottom: 0px;font-weight:normal">

        <h6 style="font-weight:normal; margin-top: 0px;">Atentamente</h6>

        <h6 style=" position: center; margin-top: 0px;font-weight:normal; margin-left: 40px">
            {{ $coti->user->gradousers->cod . ' ' . $coti->user->firstname . ' ' . $coti->user->secondname }}<br />
            Coordinador Comercial
        </h6>
        <footer style="padding-bottom: 0px" >
            <h6 class="text-align: center; ">Jr. Monte Abeto 376 Urb. Monterrico Sur -
                santiago de Surco<br>
                Ventas@novesur.com / www.novesur.com<span style="text-align: center"></span><span
                    style="text-align: right"></span><span style="text-align: justify"></span><span
                    style="text-align: center"></span></h6>
        </footer>

    </div>

</body>


</html>
