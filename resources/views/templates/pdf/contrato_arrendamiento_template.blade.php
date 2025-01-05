<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Arrendamiento</title>



</head>

<style>
    p {
        font-size: 10px;
        /* Tamaño de la fuente */
        line-height: 2;
        /* Separación de líneas */
    }


    .title {
        font-size: 14px;

    }

    .subtitle {
        font-size: 15px;
    }

    .ul-personalized {
        font-size: 12px;
    }

    .subtitle-2 {
        font-size: 13px;
    }
</style>

<body style="margin-left:40px; margin-right:40px; font-family: Arial, sans-serif;">

    <h1 class="title" style="text-align: center;">CONTRATO DE ARRENDAMIENTO NÚMERO ER001/2024</h1>

    <p>Contrato de arrendamiento de vehículo que celebran, por una parte, el <strong>{{ $PRIMER_PARRAFO_ARRENDADOR_NOMBRE }}</strong>, a quien en lo sucesivo se le denominará “EL ARRENDADOR”, y por la otra parte el/la <strong>{{ $PRIMER_PARRAFO_ARRENDATARIO_NOMBRE }}</strong>, a quien para los efectos del presente contrato se le conocerá como “EL ARRENDATARIO”.</p>

    <p class="subtitle" style="text-align: center;">D E C L A R A C I O N E S</p>

    <p style="font-weight: bold; font-size:11px">
        I. Declara “EL ARRENDADOR” lo siguiente:
    </p>

    <p>
        1. Que es de nacionalidad {{$DECLARACIONES_ARRENDADOR_NACIONALIDAD}}, mayor de edad, con {{$DECLARACIONES_ARRENDADOR_TIPO_DOCUMENTO}}; {{$DECLARACIONES_ARRENDADOR_NUMERO_DOCUMENTO}}, con domicilio en la {{$DECLARACIONES_ARRENDADOR_DOMICILIO_FISCAL_DIRECCION}}.
    </p>

    <p>
        2. Que para los efectos del presente contrato cuenta con domicilio en la {{$DECLARACIONES_ARRENDADOR_DOMICILIO_PARTICULAR_DIRECCION}}.
    </p>

    <p>
        3. Que es propietario del vehículo materia del presente contrato, con las siguientes características generales:
    </p>

    <ul class="ul-personalized">
        <li><strong>Marca:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_MARCA}}</li>
        <li><strong>Modelo:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_MODELO}}</li>
        <li><strong>Color:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_COLOR}}</li>
        <li><strong>Transmisión:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_TRANSMISION}}</li>
        <li><strong>Puertas:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_PUERTAS}}</li>
        <li><strong>Pasajeros:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_PASAJEROS}}</li>
        <li><strong>Placas de circulación:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_PLACAS_CIRCULACION}}</li>
        <li><strong>Estado:</strong> {{$DECLARACIONES_ARRENDADOR_VEHICULO_ESTADO_GEOGRAFICO}}</li>
    </ul>

    <p>
        4. Que el vehículo materia del presente contrato lo tiene en posesión legal y no existe a la fecha proceso jurisdiccional cuyo objeto sea la propiedad o posesión del citado mueble.
    </p>

    <p>
        5. Que puede disponer legalmente del vehículo materia del presente contrato.
    </p>

    <p>
        6. Que el vehículo materia de este contrato, cuenta con la totalidad de los permisos necesarios para circular.
    </p>



    <p style="font-weight: bold; font-size:11px">
        II. Declara <strong>“EL ARRENDATARIO</strong> lo siguiente:
    </p>


    <p>
        1. Que es de nacionalidad {{$DECLARACIONES_ARRENDATARIO_NACIONALIDAD}}, mayor de edad, con {{$DECLARACIONES_ARRENDATARIO_TIPO_DOCUMENTO}}; {{$DECLARACIONES_ARRENDATARIO_NUMERO_DOCUMENTO}}, con domicilio en la {{$DECLARACIONES_ARRENDATARIO_DOMICILIO}}, en la ciudad/municipio del {{$DECLARACIONES_ARRENDATARIO_CIUDAD}}, {{$DECLARACIONES_ARRENDATARIO_MUNICIPIO}}.
    </p>

    <p>
        2. Que es su deseo recibir y usar en ARRENDAMIENTO el Vehículo propiedad de EL ARRENDADOR, mismo que se ha descrito en líneas precedentes, y que conoce las condiciones mecánicas y de uso en que se encuentra.
    </p>

    <p>
        3. Que cuenta con licencia para conducir vigente otorgada en por el Estado de {{$DECLARACIONES_ARRENDATARIO_LICENCIA_EXPEDIDA_ESTADO}} con número de identificación {{$DECLARACIONES_ARRENDATARIO_LICENCIA_NUMERO_IDENTIFICACION}}.
    </p>

    <p style="font-weight: bold; font-size:11px">
        III. Señalan las partes que de manera totalmente voluntaria comparecen a celebrar el presente contrato al tenor de las siguientes
    </p>


    <p class="subtitle" style="text-align: center;">C L A U S U L A S</p>


    <p class="subtitle-2"><strong> PRIMERA.- OBJETO DEL CONTRATO</strong></p>
    <p>
        EL ARRENDADOR entrega en arrendamiento a EL ARRENDATARIO la unidad descrita en las declaraciones que preceden,
        aceptándolo este último en las condiciones normales, mecánicas y de carrocería consignadas en el inventario
        respectivo, mismo que se encuentra al final del presente documento y forma parte integrante del mismo, en lo
        sucesivo ANEXO I.
    </p>

    <p class="subtitle-2"><strong> SEGUNDA.- DURACIÓN DEL CONTRATO</strong> </p>
    <p>
        El arrendamiento será por {{$CLAUSULAS_SEGUNDA_ARRENDAMIENTO_DURACION_DIAS}} días contando a partir del
        {{$CLAUSULAS_SEGUNDA_ARRENDAMIENTO_FECHA_INICIO}} y concluyendo precisamente el día
        {{$CLAUSULAS_SEGUNDA_ARRENDAMIENTO_FECHA_FIN}}.


    </p>

    <p>
        En virtud de lo anterior, el plazo de vigencia del presente contrato será por {{$CLAUSULAS_SEGUNDA_ARRENDAMIENTO_VIGENCIA_DIAS}} días y no se considerará prorrogado
        por ninguna de las partes sin que aparezca constante la voluntad de las mismas, en un nuevo contrato de
        arrendamiento.
    </p>

    <p class="subtitle-2"> <strong> TERCERA.- PAGO DE RENTAS Y ACCESORIOS </strong></p>
    <p>
        EL ARRENDATARIO pagará por anticipado a EL ARRENDADOR por concepto de {{$CLAUSULAS_TERCERA_ARRENDAMIENTO_PAGO_CONCEPTO}}
        la cantidad de {{$CLAUSULAS_TERCERA_ARRENDAMIENTO_PAGO_MONTO}}, pago independiente de las prestaciones, sanciones
        e intereses que se pudiesen generar por el presente contrato.
    </p>

    <p>
        En el pago antes referido, se encuentra incluido el pago del SEGURO del vehículo, sin que se encuentre incluido,
        bajo ninguna circunstancia, el pago del deducible respectivo en el supuesto de ser necesario hacer uso del mismo.

    </p>


    <p class="subtitle-2"><strong> CUARTA.- GARANTÍA </strong></p>
    <p>
        EL ARRENDATARIO se obliga a entregar en devolución el vehículo arrendado en las condiciones recibidas de
        acuerdo a lo plasmado en la página 1 del ANEXO I, precisamente el día y hora señalado en la cláusula SEGUNDA
        del presente contrato en el domicilio especificado en el ANEXO I.
    </p>

    <p>
        En caso de incumplimiento e independientemente de la renovación automática que se pudiese generar, EL
        ARRENDATARIO pagará el importe de la renta correspondiente al tiempo que resulte en trasladar el vehículo al
        domicilio de la arrendadora, más los gastos justificados comprobables que se empleen en dicho traslado,
        aplicándose, en todo caso, la tarifa preestablecida en la página 2 del ANEXO I.
    </p>

    <p class="subtitle-2"><strong> QUINTA.- USO DE LA UNIDAD</strong></p>
    <p>

        El vehículo arrendado se destinará única y exclusivamente para {{$CLAUSULAS_QUINTA_ARRENDAMIENTO_VEHICULO_USO}} con destino {{$CLAUSULAS_QUINTA_ARRENDAMIENTO_DESTINO}}, dicho vehículo solo podrá ser manejado por el {{$CLAUSULAS_QUINTA_ARRENDAMIENTO_VEHICULO_CONDUCTOR}}, con número de licencia {{$CLAUSULAS_QUINTA_ARRENDAMIENTO_ARRENDATARIO_LICENCIA_NUMERO_IDENTIFICACION}}. Así también, EL ARRENDATARIO se obliga a no destinar el vehículo

        a usos distintos a los descritos, ni podrá otorgar a su vez dicho mueble en arrendamiento o comodato, ni conceder el uso ni la posesión del mismo, bajo ninguna circunstancia o figura a terceras personas.
    </p>

    <p class="subtitle-2"><strong> SEXTA.- OBLIGACIONES DEL ARRENDADOR </strong></p>
    <p>

        EL ARRENDATARIO firmará a EL ARRENDADOR un pagaré por valor factura del vehículo, en garantía del cumplimiento fiel y puntual de todos y cada una de las obligaciones. Una vez terminado el arrendamiento dicho pagaré quedará cancelado.

        En virtud de lo anterior EL ARRENDATARIO faculta de manera expresa a EL ARRENDADOR para que disponga del pagaré, para cobrarse previa comprobación de ello, las prestaciones estipuladas, la reposición de faltantes, la reparación de defectos provocados por el mal uso, etc.

    </p>

    <p class="subtitle-2"> <strong>SÉPTIMA.- OBLIGACIONES DEL ARRENDATARIO </strong></p>
    <p>
        Los gastos erogados por concepto de consumibles del vehículo que se otorga en arrendamiento, así como los gastos derivados del mantenimiento normal del MUEBLE durante el uso del mismo serán a cargo de EL ARRENDADOR.
    </p>

    <p class="subtitle-2"><strong>OCTAVA.- INCUMPLIMIENTO </strong></p>
    <p>
        EL ARRENDADOR no es responsable de objetos personales olvidados por EL ARRENDATARIO dentro del vehículo, ni el daño o demérito que pudiesen sufrir al ser transportados en el vehículo.
    </p>

    <p class="subtitle-2"><strong>NOVENA.- DEL PAGO DE DEDUCIBLE Y MULTAS</strong></p>
    <p>
        EL ARRENDATARIO responderá del pago de derechos o multas que se generen por infracciones al reglamento de tránsito; así como del pago del deducible de la póliza de seguro, en caso de que se genere un accidente responsabilidad del conductor.
    </p>

    <p class="subtitle-2"><strong>DÉCIMA.- DE LAS OBLIGACIONES DE EL ARRENDATARIO</strong></p>
    <p>
        EL ARRENDATARIO responderá del pago de derechos o multas que se generen por infracciones al reglamento de tránsito; así como del pago del deducible de la póliza de seguro, en caso de que se genere un accidente responsabilidad del conductor.
    </p>

    <p class="subtitle-2"><strong>DÉCIMA PRIMERA.- EN CASO DE SINIESTRO O ROBO </strong></p>
    <p>
        Si durante la vigencia del presente contrato, el vehículo objeto del mismo sufriera algún accidente vehicular, daño causado por caso fortuito o robo total, EL ARRENDATARIO deberá dar aviso el mismo día que tenga conocimiento del hecho, en un plazo no mayor a 1 hora, tanto a EL ARRENDADOR, como a las autoridades competentes que deban conocerlos. El retardo en el aviso se considera incumplimiento del presente contrato y genera a EL ARRENDATARIO la responsabilidad de indemnizar los daños que el arrendador haya sufrido por causa de dicho retardo.
    </p>


    <p class="subtitle-2"><strong>DÉCIMA SEGUNDA.- CAUSAS IMPUTABLES </strong></p>
    <p>
        La responsabilidad de EL ARRENDATARIO por causas imputables a la misma, independientemente de lo estipulado en la cláusula anterior, en caso de robo total queda fijada en la cantidad que se marque con respecto al vehículo arrendado, valor de venta, en la publicación denominada “guia EBC”, (cuyos datos son tomados como base por las compañías aseguradoras), a la fecha del siniestro, que será el equivalente al valor del vehículo; y en caso de vuelcos y colisiones, la cantidad que arroje el avalúo verificado por agencia autorizada de la marca respectiva.
    </p>

    <p class="subtitle-2"><strong>DÉCIMA TERCERA. – ACCIONES LEGALES </strong></p>
    <p> En caso de que EL ARRENDADOR tuviera que ejercer algún derecho, judicialmente, para obtener el pago de las prestaciones debidas por EL ARRENDATARIO, o bien, obtener la devolución del vehículo cuando legalmente si proceda, la propia ARRENDADORA podrá optar por seguir procedimiento señalado en los artículos 443, fracción IV, 449, 451 y 452 del código de procedimientos civiles para el distrito federal, y concordantes en los diferentes estados, a efecto de obtener dentro de la vía ejecutiva, el pago de las prestaciones a que se hace referencia anteriormente y/o la devolución del vehículo o por el procedimiento que corresponda en contra de EL ARRENDATARIO en la vía penal, en caso de retención o disposición indebida del vehículo arrendado. </p>

    <p>Leído que fue por las partes el contenido del presente contrato, lo firman por duplicado en {{$CLAUSULAS_DECIMA_TERCERA_UBICACION_FIRMA}} al {{$CLAUSULAS_DECIMA_TERCERA_FECHA_FIRMA}}</p>

    <div style="margin-top: 50px;">
        <table width="100%">
            <tr>
                <td style="text-align: center; font-size: 12px; width: 200px;">
                    <hr style="border: 0; border-top: 1px solid #000; width: 80%; margin: 0 auto;">
                    {{$FIRMAS_ZONA_ARRENDADOR_NOMBRE}}<br>
                    <strong>“ARRENDADOR”</strong>
                </td>
                <td style="text-align: center; font-size: 12px; width: 200px;">
                    <hr style="border: 0; border-top: 1px solid #000; width: 80%; margin: 0 auto;">

                    {{$FIRMAS_ZONA_ARRENDATARIO_NOMBRE}}<br>
                    <strong>“ARRENDATARIO”</strong>

                </td>
            </tr>
        </table>
    </div>


    <br>

    <p style="font-size: 11px;">
        Al presente contrato se anexan los siguientes documentos de “EL ARRENDATARIO”: INE, licencia vigente, pagaré en Garantía


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <img width="70%" height="70%" src="{{$IMAGEN_DOCUMENTO_IDENTIDAD_RUTA}}">
        <img width="70%" height="70%" src="{{$LICENCIA_CONDUCCION_RUTA}}">



</body>

</html>