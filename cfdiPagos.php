<?php

$cfdiPago = [
    "Version" => "4.0",
    "Serie" => "P",
    "Folio" => "00003",
    "Fecha" => "2022-03-30T16:26:19",
    "SubTotal" => "0",
    "Moneda" => "XXX",
    "Total" => "0",
    "TipoDeComprobante" => "P",
    "LugarExpedicion" => "64530",
    "NoCertificado" => "",
    "Certificado" => "",
    "Exportacion" => "01",
    "Emisor" => [
        "Rfc" => "EKU9003173C9",
        "Nombre" => "ESCUELA KEMPER URGATE SA DE CV",
        "RegimenFiscal" => "601",
    ],
    "Receptor" => [
        "Rfc" => "JUFA7608212V6",
        "Nombre" => "ADRIANA JUAREZ FERNANDEZ",
        "DomicilioFiscalReceptor" => "29133",
        "RegimenFiscalReceptor" => "605",
        "UsoCFDI" => "CP01",
    ],
    "Conceptos" => [
        
            "ClaveProdServ" => "84111506",
            "Cantidad" => "1",
            "ClaveUnidad" => "ACT",
            "Descripcion" => "Pago",
            "ValorUnitario" => "0",
            "Importe" => "0",
            "ObjetoImp" => "01",
        
    ],
    "Complemento" => [
        "Any" => [
            
                "Pago20:Pagos" => [
                    "Version" => "2.0",
                    "Totales" => ["MontoTotalPagos" => "100.00",
                    "TotalTrasladosBaseIVA16" => "100.00",
                    "TotalTrasladosImpuestoIVA16" => "16.00",
                      ],
                    "Pago" => [
                        
                            "FechaPago" => "2022-02-19T00:00:00",
                            "FormaDePagoP" => "03",
                            "MonedaP" => "MXN",
                            "Monto" => "1.00",
                            "TipoCambioP" => "1",
                            "DoctoRelacionado" => [
                                
                                    "IdDocumento" =>
                                        "daca5d85-b8cd-463b-a056-b021fe33c2f9",
                                    "Serie" => "CG",
                                    "Folio" => "2200004",
                                    "MonedaDR" => "MXN",
                                    "MetodoDePagoDR" => "PUE",
                                    "NumParcialidad" => "1",
                                    "ImpSaldoAnt" => "500.00",
                                    "ImpPagado" => "1.00",
                                    "ImpSaldoInsoluto" => "499.00",
                                    "EquivalenciaDR" => "1",
                                    "ObjetoImpDR" => "01",
                                
                            ],
                        
                    ],
                ],
            
        ],
    ],
];
$x = dirname("../pruebacfdi/cfdi/cert/PEM/");
use CfdiUtils\Elements\Pagos20\Pagos;
require __DIR__ . '/cfdi/vendor/autoload.php';
$fileCer = '../pruebacfdi/cfdi/cert/PEM/eku9003173c9_cer.pem';
$certificado = new \CfdiUtils\Certificado\Certificado($fileCer);
/* var_dump($cfdiDatos); */
$serie = $cfdiPago['Serie'];
$folio = $cfdiPago['Folio'];
$fecha = $cfdiPago['Fecha'];
$moneda = $cfdiPago['Moneda'];
$tipoDeComprobante = $cfdiPago['TipoDeComprobante'];
$exportacion = $cfdiPago['Exportacion'];
$lugarExpedicion = $cfdiPago['LugarExpedicion'];

/* Datos emisor */

$rfc = $cfdiPago['Emisor']['Rfc'];
$nombreEmisor = $cfdiPago['Emisor']['Nombre'];
$regimenFiscalEmisor = $cfdiPago['Emisor']['RegimenFiscal'];


/* Datos Receptor */

$rfcReceptor = $cfdiPago['Receptor']['Rfc'];
$nombreRefector = $cfdiPago['Receptor']['Nombre'];
$domicilioFiscalReceptor = $cfdiPago['Receptor']['DomicilioFiscalReceptor'];
$regimenFiscalReceptor = $cfdiPago['Receptor']['RegimenFiscalReceptor'];
$usoCfdi = $cfdiPago['Receptor']['UsoCFDI'];

/* Concepto */
$claveProdServ = $cfdiPago['Conceptos']['ClaveProdServ'];
$cantidad = $cfdiPago['Conceptos']['Cantidad'];
$claveUnidad = $cfdiPago['Conceptos']['ClaveUnidad'];
$descripcion =  $cfdiPago['Conceptos']['Descripcion'];
$valorUnitario = $cfdiPago['Conceptos']['ValorUnitario'];
$importe = $cfdiPago['Conceptos']['Importe'];
$objetoImp = $cfdiPago['Conceptos']['ObjetoImp'];


$comprobanteAtributos = [
    'Serie' => $serie,
    'Folio' => $folio,
    'Fecha' => $fecha, /* formato AAAA-MMDDThh:mm:ss */
    'Sello' => '',
    'NoCertificado' => '',
    'Certificado' => '',
    'Moneda' => $moneda,
    'TipoDeComprobante' => $tipoDeComprobante,
    'Exportacion' => $exportacion,
    'LugarExpedicion' => $lugarExpedicion,

];
$creator = new \CfdiUtils\CfdiCreator40($comprobanteAtributos, $certificado);

$comprobante = $creator->comprobante();

// No agrego (aunque puedo) el Rfc y Nombre porque uso los que están establecidos en el certificado
$comprobante->addEmisor([
     /* Atributos del emisor */
    'Rfc' => $rfc,
    'Nombre' => $nombreEmisor,
    'RegimenFiscal' => $regimenFiscalEmisor,
]);

$comprobante->addReceptor([
    /* Atributos del receptor */
    'Rfc' => $rfcReceptor,
    'Nombre' => $nombreRefector,
    'DomicilioFiscalReceptor' => $domicilioFiscalReceptor,
    'RegimenFiscalReceptor' => $regimenFiscalReceptor,
    'UsoCFDI' => $usoCfdi,

   



]);

$comprobante->addConcepto([
    /* Atributos Concepto */
    "ClaveProdServ" => $claveProdServ,
    "Cantidad" => $cantidad,
    "ClaveUnidad" => $claveUnidad,
    "Descripcion" => $descripcion,
    "ValorUnitario" => $valorUnitario,
    "Importe" => $importe,
    "ObjetoImp" => $objetoImp,
]);

$complementoPagos = new Pagos();

$pago = $complementoPagos->addPago([
    //* Atributos */
    'FechaPago' => "2021-12-15T00:00:00",
    'FormaDePagoP' => '03', // transferencia
    'TipoCambioP' => '1',
    'MonedaP' => 'MXN',
    'Monto' => '100.00',
    'NumOperacion' => '963852',
    'RfcEmisorCtaOrd' => 'BMI9704113PA', // Monex
    'CtaOrdenante' => '0001970000',
    'RfcEmisorCtaBen' => 'BBA830831LJ2', // BBVA
    'CtaBeneficiario' => '0198005000',
]);

$docrelacionado = $pago->addDoctoRelacionado([
    //* Atributos */

        'IdDocumento' => '00000000-1111-2222-3333-00000000000A',
                'MonedaDR' => 'MXN',
                'NumParcialidad' => 1,
                'ImpSaldoAnt' => '200.00',
                'ImpPagado' => '100.00',
                'ImpSaldoInsoluto' => '100.00',
                "ObjetoImpDR"=> "02",
                "EquivalenciaDR" => "1",
]);
$impuestoDR = $docrelacionado->addImpuestosDR();
$trasladosDR = $impuestoDR->addTrasladosDR();
$trasladoDR = $trasladosDR->addTrasladoDR([
    "BaseDR" => "100.00",
    "ImpuestoDR" => "002",
    "TipoFactorDR" => "Tasa",
    "TasaOCuotaDR" => "0.160000",
    "ImporteDR" => "16.00"
]);
$impuestoP = $pago->addImpuestosP();
$trasladosP = $impuestoP->addTrasladosP();
$trasladoP = $trasladosP->addTrasladoP([

    "BaseP" => "100.00",
    "ImpuestoP" => "002",
    "TipoFactorP" => "Tasa",
    "TasaOCuotaP" => "0.160000",
    "ImporteP" => "16.00"
]);
$totales = $complementoPagos->addTotales([
    //* Atributos */
    "MontoTotalPagos" => "100.00",
                        "TotalTrasladosBaseIVA16" => "100.00",
                        "TotalTrasladosImpuestoIVA16" => "16.00",
]);
$comprobante->addComplemento($complementoPagos);
// método de ayuda para establecer las sumas del comprobante e impuestos
// con base en la suma de los conceptos y la agrupación de sus impuestos
$creator->addSumasConceptos(null, 0);

// método de ayuda para generar el sello (obtener la cadena de origen y firmar con la llave privada)
$creator->addSello('file://' . $x . '\EKU9003173C9_enc.key.pem', '12345678a');

// método de ayuda para mover las declaraciones de espacios de nombre al nodo raíz
$creator->moveSatDefinitionsToComprobante();

// método de ayuda para validar usando las validaciones estándar de creación de la librería
$asserts = $creator->validate();
$asserts->hasErrors(); // contiene si hay o no errores

// método de ayuda para generar el xml y guardar los contenidos en un archivo
$creator->saveXml('cfdi/cfdiPago.xml');

// método de ayuda para generar el xml y retornarlo como un string
$creator->asXml();

?>