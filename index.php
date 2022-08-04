<?php

$cfdiDatos = [ 
    "Serie" => "XXX", 
    "Folio" => "2080427802", 
    "Fecha" => "2022-04-10T18:31:50", 
    "Sello" => "", 
    "FormaPago" => "01", 
    "NoCertificado" => "", 
    "Certificado" => "", 
    "SubTotal" => 0, 
    "Descuento" => 0, 
    "Moneda" => "MXN", 
    "TipoCambio" => 1, 
    "Total" => 0, 
    "TipoDeComprobante" => "I", 
    "Exportacion" => "01", 
    "MetodoPago" => "PUE", 
    "LugarExpedicion" => "01000", 
    "InformacionGlobal" => [
          "Periodicidad" => "02", 
          "Meses" => "05", 
          "anio" => "2022" 
       ], 
    "Emisor" => [
             "Rfc" => "EKU9003173C9", 
             "Nombre" => "ESCUELA KEMPER URGATE SA DE CV", 
             "RegimenFiscal" => "601", 
          ], 
    "Receptor" => [
                "Rfc" => "MOFY900516NL1", 
                "Nombre" => "YADIRA MAGALY MONTAÑEZ FELIX", 
                "DomicilioFiscalReceptor" => "29960", 
                "ResidenciaFiscalSpecified" => false, 
                "RegimenFiscalReceptor" => "612", 
                "UsoCFDI" => "G01" 
             ], 
    "Conceptos" => [
                   
                      "Impuestos" => [
                         "Retenciones" => [
                            
                               "Base" => 200, 
                               "Impuesto" => "002", 
                               "TipoFactor" => "Tasa", 
                               "TasaOCuota" => 0.160000, 
                               "Importe" => 32.000000, 
                             
                         ] 
                      ], 
                      "ClaveProdServ" => "50211503", 
                      "NoIdentificacion" => "UT421511", 
                      "Cantidad" => 1, 
                      "ClaveUnidad" => "H87", 
                      "Unidad" => "Pieza", 
                      "Descripcion" => "Cigarros", 
                      "ValorUnitario" => 200, 
                      "Importe" => 200, 
                      "ObjetoImp" => "02" 
                    
                ]
  
                                ];
$x = dirname("../pruebacfdi/cfdi/cert/PEM/");

require __DIR__ . '/cfdi/vendor/autoload.php';
$fileCer = '../pruebacfdi/cfdi/cert/PEM/eku9003173c9_cer.pem';
$certificado = new \CfdiUtils\Certificado\Certificado($fileCer);
/* var_dump($cfdiDatos); */

$serie = $cfdiDatos['Serie'];
$folio = $cfdiDatos['Folio'];
$fecha = $cfdiDatos['Fecha'];
$formaPago = $cfdiDatos['FormaPago'];
$subTotal = $cfdiDatos['SubTotal'];
$descuento = $cfdiDatos['Descuento'];
$moneda = $cfdiDatos['Moneda'];
$tipoCambio = $cfdiDatos['TipoCambio'];
$total = $cfdiDatos['Total'];
$tipoComprobante = $cfdiDatos['TipoDeComprobante'];
$exportacion = $cfdiDatos['Exportacion'];
$metodoPago = $cfdiDatos['MetodoPago'];
$lugarExpedicion = $cfdiDatos['LugarExpedicion'];
$rfcEmisor = $cfdiDatos['Emisor']['Rfc'];
$nombreEmisor = $cfdiDatos['Emisor']['Nombre'];
$regimenFiscalEmisor = $cfdiDatos['Emisor']['RegimenFiscal'];
$rfcReceptotr = $cfdiDatos['Receptor']['Rfc'];
$nombreReceptor = $cfdiDatos['Receptor']['Nombre'];
$domicilioFiscalReceptor = $cfdiDatos['Receptor']['DomicilioFiscalReceptor'];
$regimenFiscalReceptor = $cfdiDatos['Receptor']['RegimenFiscalReceptor'];
$usoCFDI = $cfdiDatos['Receptor']['UsoCFDI'];
$claveProdServ = $cfdiDatos['Conceptos']['ClaveProdServ'];
$noIdentificacion = $cfdiDatos['Conceptos']['NoIdentificacion'];
$cantidad = $cfdiDatos['Conceptos']['Cantidad'];
$claveUnidad = $cfdiDatos['Conceptos']['ClaveUnidad'];
$unidad = $cfdiDatos['Conceptos']['Unidad'];
$descripcion = $cfdiDatos['Conceptos']['Descripcion'];
$valorUnitario = $cfdiDatos['Conceptos']['ValorUnitario'];
$importe = $cfdiDatos['Conceptos']['Importe'];
$objetoImp = $cfdiDatos['Conceptos']['ObjetoImp'];
$base = $cfdiDatos['Conceptos']['Impuestos']['Retenciones']['Base'];
$impuesto = $cfdiDatos['Conceptos']['Impuestos']['Retenciones']['Impuesto'];
$tipoFactor = $cfdiDatos['Conceptos']['Impuestos']['Retenciones']['TipoFactor'];
$tasaOCuota = $cfdiDatos['Conceptos']['Impuestos']['Retenciones']['TasaOCuota'];
$importeTraslado = $cfdiDatos['Conceptos']['Impuestos']['Retenciones']['Importe'];
$comprobanteAtributos = [
    'Serie' => $serie,
    'Folio' => $folio,
    'Fecha' => $fecha, /* formato AAAA-MMDDThh:mm:ss */
    'Sello' => '',
    'FormaPago' => $formaPago, /* 01->efectivo, 02->cheque nominativo, 03->transfrencia de fondos */
    'NoCertificado' => '',
    'Certificado' => '',
    'SubTotal' => $subTotal,
    'Descuento' => $descuento,
    'Moneda' => $moneda,
    'TipoCambio' => $tipoCambio,
    'Total' => $total,
    'TipoDeComprobante' => $tipoComprobante,
    'Exportacion' => $exportacion,
    'MetodoPago' => $metodoPago,
    'LugarExpedicion' => $lugarExpedicion,

];
$creator = new \CfdiUtils\CfdiCreator40($comprobanteAtributos, $certificado);

$comprobante = $creator->comprobante();

// No agrego (aunque puedo) el Rfc y Nombre porque uso los que están establecidos en el certificado
$comprobante->addEmisor([
     /* Atributos del emisor */

    'RegimenFiscal' => $regimenFiscalEmisor, // General de Ley Personas Morales
]);

$comprobante->addReceptor([
    /* Atributos del receptor */

    'Rfc' => $rfcReceptotr,
    'Nombre' => $nombreReceptor,
    'DomicilioFiscalReceptor' => $domicilioFiscalReceptor,
    'RegimenFiscalReceptor' => $regimenFiscalReceptor,
    'UsoCFDI' => $usoCFDI,



]);

$comprobante->addConcepto([
    /* Atributos Concepto */
    'ClaveProdServ' => $claveProdServ,
    'NoIdentificacion' => $noIdentificacion,
    'Cantidad' => $cantidad,
    'ClaveUnidad' => $claveUnidad,
    'Unidad' => $unidad,
    'Descripcion' => $descripcion,
    'ValorUnitario' => $valorUnitario,
    'Importe' => $importe,
    'ObjetoImp' => $objetoImp,
])->addTraslado([
    /* Atributos del impuesto trasladado */
    'Base' => $base,
    'Impuesto' => $impuesto,
    'TipoFactor' => $tipoFactor,
    'TasaOCuota' => $tasaOCuota,
    'Importe' => $importeTraslado,
]);




// método de ayuda para establecer las sumas del comprobante e impuestos
// con base en la suma de los conceptos y la agrupación de sus impuestos
$creator->addSumasConceptos(null, 2);

// método de ayuda para generar el sello (obtener la cadena de origen y firmar con la llave privada)
$creator->addSello('file://' . $x . '\EKU9003173C9_enc.key.pem', '12345678a');

// método de ayuda para mover las declaraciones de espacios de nombre al nodo raíz
$creator->moveSatDefinitionsToComprobante();

// método de ayuda para validar usando las validaciones estándar de creación de la librería
$asserts = $creator->validate();
$asserts->hasErrors(); // contiene si hay o no errores

// método de ayuda para generar el xml y guardar los contenidos en un archivo
$creator->saveXml('cfdi/cfdi.xml');

// método de ayuda para generar el xml y retornarlo como un string
$creator->asXml();

?>