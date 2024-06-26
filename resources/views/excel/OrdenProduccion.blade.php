<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td align="center" style="font-size:10px"><p><strong>INVERSIONES NOVESUR SAC<br />
      RUC 20492421406
      </strong><br />
    </p></td> 
    <td width="58%" align="center">&nbsp;</td>
    <td width="9%" align="center"><strong>FECHA</strong></td>
    <td width="24%" align="center">{{$diaActual}}</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td colspan="2" align="center"><strong>INFORME DE PRODUCCION Nr° {{$InfoProduccion->codigo}}</strong></td>
  </tr>
  <tr>
    <td><strong>FECHA : </strong></td>
    <td colspan="2">{{date('d-m-Y', strtotime($InfoProduccion->fecha))}}</td>
    
    
  </tr>
  <tr>
    <td><strong>COD REQ : </strong></td>
    <td colspan="2">{{$InfoProduccion->requerimiento_materiales->codigo}}</td>
  </tr>
  <tr>
    <td><strong>COD PROD :</strong></td>
    <td colspan="2">{{$InfoProduccion->producto->codigo}}</td>
  </tr>
  <tr>
    <td><strong>PRODUCTO : </strong></td>
    <td colspan="2">{{$InfoProduccion->producto->familia->nombre .' '. $InfoProduccion->producto->subfamilia->nombre .', MODELO '. $InfoProduccion->producto->modelotipo->nombre .', MATERIAL '. $InfoProduccion->producto->material->nombre .', MARCA '. $InfoProduccion->producto->marca->nombre.', - '. $InfoProduccion->producto->homologacion->nombre}} </td>
  </tr>

  @if ($InfoProduccion->cliente->razonsocial == 'NINGUNO')
  <tr>
    <td><strong>CANTIDAD :</strong></td>
    <td colspan="4">{{$InfoProduccion->cantidad}}</td>
  </tr>
  @else
  <tr>
    <td><strong>ALMACEN:</strong></td>
    <td colspan="4">{{$InfoProduccion->almacen->nombre}}</td>
  </tr>
  <tr>
    <td><strong>CLIENTE-REF :</strong></td>
    <td colspan="4">{{$InfoProduccion->cliente->razonsocial}}</td>
  </tr>
  @endif


</table>
<br />
<table width="100%" border="1">
  <tr>
    <td colspan="6" align="center" bgcolor="#33CCFF"><strong>REQUERIMIENTO MATERIALES</strong></td>

  </tr>
  <tr>
    <td width="15%" align="center"><strong>ITEM</strong></td>
    <td width="57%" align="center"><strong>DESCRIPCION</strong></td>
    <td width="7%" align="center"><strong>U.M</strong></td>
    <td width="9%" align="center"><strong>CANTIDAD</strong></td>
    <td width="7%" align="center"><strong>P.Unit</strong></td>
    <td width="5%" align="center"><strong>TOTAL</strong></td>
  </tr>

  @if($InfoProduccionMaterial) @foreach ($InfoProduccionMaterial as $data)
  <tr>
    <td align="center">{{$data->producto->codigo}} </td>
    <td align="center">{{$data->producto->familia->nombre .', MARCA '. $data->producto->marca->nombre .' '. $data->producto->subfamilia->nombre .', MODELO/TIPO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre.' '. $data->producto->homologacion->nombre }} </td>
    <td align="center">{{$data->unidmedida->nombre }}</td>
    <td align="center">{{$data->cantidad}}</td>
    <td align="center">{{$data->costunit}}</td>
    <td align="center">{{$data->total}}</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    @endforeach @endif

    
    <td align="center"><strong>SUBTOTAL</strong></td>
    <td align="center">
    @php $sumaProdMat = 0;  @endphp 
        @if($InfoProduccionMaterial) @foreach ($InfoProduccionMaterial as $data)
        @php
        
          $sumaProdMat = $data->total + $sumaProdMat;
        @endphp   
        @endforeach @endif
      {{$sumaProdMat}}
    </td>
  </tr>
  
</table>
<br />
<table width="100%" border="1">
  <tr>
    <td width="33%" align="center" bgcolor="#33CCFF"><strong>REQUERIMIENTO MANO DE OBRA (DIAS, HORAS, HOMBRE)</strong></td>
    <td width="9%" align="center" bgcolor="#33CCFF"><strong>HORAS </strong></td>
    <td width="11%" align="center" bgcolor="#33CCFF"><strong> DIAS</strong></td>
    <td width="13%" align="center" bgcolor="#33CCFF"><strong>COSTO DIAS</strong></td>
    <td width="15%" align="center" bgcolor="#33CCFF"><strong>COSTO HORAS</strong></td>
    <td width="19%" align="center" bgcolor="#33CCFF"><strong>TOTAL</strong></td>
  </tr>
  @if($InfoProduccionManoObra) @foreach ($InfoProduccionManoObra as $dataManObra)
  <tr>
    <td align="center">{{$dataManObra->personal}}</td>
    <td align="center">{{$dataManObra->horas}}</td>
    <td align="center">{{$dataManObra->dias}}</td>
    <td align="center">{{$dataManObra->costdias}}</td>
    <td align="center">{{$dataManObra->costhoras}}</td>
    <td align="center">{{$dataManObra->total}}</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    @endforeach @endif
    <td align="center"><strong>SUBTOTAL</strong></td>
    <td align="center">
    @php $sumaManObra = 0;  @endphp 
        @if($InfoProduccionManoObra) @foreach ($InfoProduccionManoObra as $data)
        @php
        
          $sumaManObra = $data->total + $sumaManObra;
        @endphp   
        @endforeach @endif
      {{$sumaManObra}}
    </td>
  </tr>
</table>
<br />
<table width="100%" border="1">
  <tr>
    <td align="center" bgcolor="#33CCFF"><strong>OTROS REQUERIMIENTOS</strong></td>
    <td align="center" bgcolor="#33CCFF"><strong>DESCRIPCION</strong></td>
    <td align="center" bgcolor="#33CCFF"><strong>PRECIO</strong></td>
    <td align="center" bgcolor="#33CCFF">TOTAL</td>
  </tr>
  @if($InfoProduccionManoObra) @foreach ($InfoProduccionOtrosRequerimientos as $dataOtrosReq)
  <tr>
    <td align="center">{{$dataOtrosReq->descripcion}}</td>
    <td align="center">{{$dataOtrosReq->cantidad}}</td>
    <td align="center">{{$dataOtrosReq->precio}}</td>
    <td align="center">{{$dataOtrosReq->total}}</td>
  </tr>
  @endforeach @endif
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><strong>SUBTOTAL</strong></td>
    <td align="center">
    @php $sumaOtrosReq = 0;  @endphp 
        @if($InfoProduccionOtrosRequerimientos) @foreach ($InfoProduccionOtrosRequerimientos as $data)
        @php
        
          $sumaOtrosReq = $data->total + $sumaOtrosReq;
        @endphp   
        @endforeach @endif
      {{$sumaOtrosReq}}
    </td>
  </tr>
</table>
<br />
<table width="100%" border="0">
  <tr>
    <td width="21%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td width="20%"><span style="font-size:10px"><strong>COSTO DE PRODUCCION TOTAL  S/ </strong></span></td>
    <td width="39%">{{$sumaProdMat + $sumaOtrosReq + $sumaManObra}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span style="font-size:10px"><strong>COSTO UNITARIO DE PRODUCCION  S/</strong></span></td>
    <td> {{round(($sumaProdMat + $sumaOtrosReq + $sumaManObra) / $InfoProduccion->cantidad,4)}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    
    <td align="center" style="font-size:10px">&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-size:10px">&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-size:10px"><strong>CONTABILIDAD</strong></td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p><br />
</p>
<p><br />
  <br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
