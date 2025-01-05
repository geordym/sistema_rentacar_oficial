<?php

namespace App\Http\Controllers;

use App\Models\Lessor;
use App\Models\RentalAgreement;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Settings;
use Dompdf\Dompdf;
use Dompdf\Options;
use NumberFormatter;

class RentalAgreementController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage rental agreement')) {
            $agreements = RentalAgreement::where('parent_id', parentId())->get();
            return view('rental_agreement.index', compact('agreements'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        if (\Auth::user()->can('create rental agreement')) {
            $vehicles = Vehicle::where('parent_id', parentId())->get();

            $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get()->pluck('name', 'id');
            $drivers->prepend(__('Select Driver'), '');

            $status = RentalAgreement::$status;

            $lessors = Lessor::pluck('name', 'id');
            $tenants = Tenant::pluck('name', 'id');

            return view('rental_agreement.create', compact('vehicles', 'lessors', 'tenants', 'status'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create rental agreement')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'vehicle' => 'required',
                    'rental_start_date' => 'required',
                    'rental_end_date' => 'required',
                    'rental_duration' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $rentalAgreement = new RentalAgreement();
            $rentalAgreement->agreement_id = $this->agreementNumber();
            $rentalAgreement->date = date('Y-m-d');
            $rentalAgreement->rental_start_date = $request->rental_start_date;
            $rentalAgreement->rental_end_date = $request->rental_end_date;
            $rentalAgreement->rental_duration = $request->rental_duration;
            $rentalAgreement->vehicle = $request->vehicle;
            $rentalAgreement->driver = -1;
            $rentalAgreement->terms_condition = $request->terms_condition;
            $rentalAgreement->description = $request->description;
            $rentalAgreement->status = $request->status;

            $rentalAgreement->rental_agreement_duration_days = $request->rental_agreement_duration_days;

            $rentalAgreement->lease_clause_third_tenant_payment_concept = $request->tenant_payment_concept;
            $rentalAgreement->lease_clause_third_tenant_payment_amount = $request->tenant_payment_amount;

            $rentalAgreement->lease_clause_fifth_transport_concept = $request->transport_concept;
            $rentalAgreement->lease_clause_fifth_transport_destination = $request->transport_destination;

            $rentalAgreement->lease_signature_city = $request->signature_city;
            $rentalAgreement->lease_signature_date = $request->signature_date;

            $rentalAgreement->contract_number = $request->contract_number;

            $rentalAgreement->lessor_id = $request->lessor;
            $rentalAgreement->tenant_id = $request->tenant;


            $rentalAgreement->parent_id = parentId();
            $rentalAgreement->save();
            return redirect()->route('rental-agreement.index')->with('success', __('Rental agreement successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($ids)
    {
        if (\Auth::user()->can('show rental agreement')) {
            $id = Crypt::decrypt($ids);
            $rentalAgreement = RentalAgreement::find($id);
            $settings = settings();
            return view('rental_agreement.show', compact('rentalAgreement', 'settings'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit(RentalAgreement $rentalAgreement)
    {
        if (\Auth::user()->can('edit rental agreement')) {
            $vehicles = Vehicle::where('parent_id', parentId())->get();

            $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get()->pluck('name', 'id');
            $drivers->prepend(__('Select Driver'), '');

            $status = RentalAgreement::$status;
            return view('rental_agreement.edit', compact('vehicles', 'drivers', 'rentalAgreement', 'status'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, RentalAgreement $rentalAgreement)
    {
        if (\Auth::user()->can('edit rental agreement')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'vehicle' => 'required',
                    'rental_start_date' => 'required',
                    'rental_end_date' => 'required',
                    'rental_duration' => 'required',
                    'driver' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $rentalAgreement->rental_start_date = $request->rental_start_date;
            $rentalAgreement->rental_end_date = $request->rental_end_date;
            $rentalAgreement->rental_duration = $request->rental_duration;
            $rentalAgreement->vehicle = $request->vehicle;
            $rentalAgreement->driver = $request->driver;
            $rentalAgreement->terms_condition = $request->terms_condition;
            $rentalAgreement->description = $request->description;
            $rentalAgreement->status = $request->status;
            $rentalAgreement->save();
            return redirect()->route('rental-agreement.index')->with('success', __('Rental agreement successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(RentalAgreement $rentalAgreement)
    {
        if (\Auth::user()->can('delete rental agreement')) {
            $rentalAgreement->delete();
            return redirect()->route('rental-agreement.index')->with('success', __('Rental agreement successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function agreementNumber()
    {
        $latest = RentalAgreement::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->agreement_id + 1;
    }


    public function printSignDocument($id)
    {

        $rentalAgreement = RentalAgreement::find($id);
        $lessor = Lessor::find($rentalAgreement->lessor_id);
        $tenant = Tenant::find($rentalAgreement->tenant_id);
        $vehicle = Vehicle::find($rentalAgreement->vehicle);

        $tenantDocumentImagePath = $this->saveImageToTemp($tenant->document_image);
        $tenantDriveLicenseImagePath = $this->saveImageToTemp($tenant->drive_license_image);

        $transmision = $vehicle->gearbox == "automatic" ? "automatica" : "manual";

        $templateName = "templates/pdf/contrato_arrendamiento_template";
        $data = [
            'PRIMER_PARRAFO_ARRENDADOR_NOMBRE' => $lessor->name,
            'PRIMER_PARRAFO_ARRENDATARIO_NOMBRE' => $tenant->name,

            'DECLARACIONES_ARRENDADOR_NACIONALIDAD' => strtolower($lessor->nationality),
            'DECLARACIONES_ARRENDADOR_TIPO_DOCUMENTO' => strtoupper($lessor->document_type),
            'DECLARACIONES_ARRENDADOR_NUMERO_DOCUMENTO' => strtoupper($lessor->document_number),
            'DECLARACIONES_ARRENDADOR_DOMICILIO_FISCAL_DIRECCION' => $lessor->fiscal_address,
            'DECLARACIONES_ARRENDADOR_DOMICILIO_PARTICULAR_DIRECCION' => $lessor->residence_address,
            'DECLARACIONES_ARRENDADOR_VEHICULO_MARCA' => $vehicle->mark,
            'DECLARACIONES_ARRENDADOR_VEHICULO_MODELO' => $vehicle->model,
            'DECLARACIONES_ARRENDADOR_VEHICULO_COLOR' => $vehicle->color,
            'DECLARACIONES_ARRENDADOR_VEHICULO_TRANSMISION' => $transmision,
            'DECLARACIONES_ARRENDADOR_VEHICULO_PUERTAS' => $vehicle->number_of_doors,
            'DECLARACIONES_ARRENDADOR_VEHICULO_PASAJEROS' => $vehicle->number_of_seats,
            'DECLARACIONES_ARRENDADOR_VEHICULO_PLACAS_CIRCULACION' => $vehicle->license_plate,
            'DECLARACIONES_ARRENDADOR_VEHICULO_ESTADO_GEOGRAFICO' => $vehicle->state,

            'DECLARACIONES_ARRENDATARIO_NACIONALIDAD' => strtolower($tenant->nationality),
            'DECLARACIONES_ARRENDATARIO_TIPO_DOCUMENTO' => strtolower($tenant->document_type),
            'DECLARACIONES_ARRENDATARIO_NUMERO_DOCUMENTO' => strtolower($tenant->document_number),
            'DECLARACIONES_ARRENDATARIO_DOMICILIO' => $tenant->address,
            'DECLARACIONES_ARRENDATARIO_CIUDAD' => $tenant->city,
            'DECLARACIONES_ARRENDATARIO_MUNICIPIO' => $tenant->municipality,
            'DECLARACIONES_ARRENDATARIO_LICENCIA_EXPEDIDA_ESTADO' => $tenant->license_issued_state,
            'DECLARACIONES_ARRENDATARIO_LICENCIA_NUMERO_IDENTIFICACION' => $tenant->license_number,

            'CLAUSULAS_SEGUNDA_ARRENDAMIENTO_DURACION_DIAS' => $rentalAgreement->rental_duration,
            'CLAUSULAS_SEGUNDA_ARRENDAMIENTO_FECHA_INICIO' => Carbon::parse($rentalAgreement->rental_start_date)
                ->locale('es')
                ->isoFormat('dddd D [de] MMMM [de] YYYY [a las] h:mm a'),
            'CLAUSULAS_SEGUNDA_ARRENDAMIENTO_FECHA_FIN' => Carbon::parse($rentalAgreement->rental_end_date)
                ->locale('es')
                ->isoFormat('dddd D [de] MMMM [de] YYYY [a las] h:mm a'),
            'CLAUSULAS_SEGUNDA_ARRENDAMIENTO_VIGENCIA_DIAS' => $rentalAgreement->rental_agreement_duration_days,

            'CLAUSULAS_TERCERA_ARRENDAMIENTO_PAGO_CONCEPTO' => $rentalAgreement->lease_clause_third_tenant_payment_concept,
            'CLAUSULAS_TERCERA_ARRENDAMIENTO_PAGO_MONTO' =>  $this->formatAmount($rentalAgreement->lease_clause_third_tenant_payment_amount),

            'CLAUSULAS_QUINTA_ARRENDAMIENTO_VEHICULO_USO' => $rentalAgreement->lease_clause_fifth_transport_concept,
            'CLAUSULAS_QUINTA_ARRENDAMIENTO_DESTINO' => $rentalAgreement->lease_clause_fifth_transport_destination,
            'CLAUSULAS_QUINTA_ARRENDAMIENTO_VEHICULO_CONDUCTOR' => $tenant->name,
            'CLAUSULAS_QUINTA_ARRENDAMIENTO_ARRENDATARIO_LICENCIA_NUMERO_IDENTIFICACION' => $tenant->license_number,

            'CLAUSULAS_DECIMA_TERCERA_UBICACION_FIRMA' => $rentalAgreement->lease_signature_city,
            'CLAUSULAS_DECIMA_TERCERA_FECHA_FIRMA' => $rentalAgreement->lease_signature_date,

            'FIRMAS_ZONA_ARRENDADOR_NOMBRE' => $lessor->name,
            'FIRMAS_ZONA_ARRENDATARIO_NOMBRE' => $tenant->name,
            
            "IMAGEN_DOCUMENTO_IDENTIDAD_RUTA" => $tenantDocumentImagePath,
            "LICENCIA_CONDUCCION_RUTA" => $tenantDriveLicenseImagePath
        ];

        // Renderiza el template como HTML
        $html = view($templateName, $data)->render();

        // Configura DOMPDF
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans'); // Fuente predeterminada
        $options->setIsHtml5ParserEnabled(true); // Habilitar el parser HTML5
        $options->set('isRemoteEnabled', true);


        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Tamaño y orientación del papel
        $dompdf->render();

        // Generar el archivo PDF
        $output = $dompdf->output();

        // Mostrar el PDF directamente en el navegador
        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Contrato_' . $id . '.pdf"');
    }


    public function saveImageToTemp($base64Image)
    {
        // Decodificar la imagen en base64
        $imageData = base64_decode($base64Image);
    
        // Crear un nombre único para el archivo
        $tempFileName = 'temp_image_' . uniqid() . '.jpg'; // Cambia la extensión según el formato real
    
        // Crear el archivo en el directorio público
        $publicPath = public_path('storage/temp/' . $tempFileName); // Ruta en "public/storage/temp/"
    
        // Asegúrate de que la carpeta exista
        if (!file_exists(dirname($publicPath))) {
            mkdir(dirname($publicPath), 0777, true);
        }
    
        // Guardar el contenido decodificado en el archivo público
        file_put_contents($publicPath, $imageData);
    
        // Retornar la ruta pública accesible
        return asset('storage/temp/' . $tempFileName);
    }
    

    public function formatAmount($amount)
    {
        $formattedNumber = number_format($amount, 2, '.', ',');
        $numberToWords = $this->convertNumberToWords($amount);
        return "$" . $formattedNumber . " (" . ucfirst($numberToWords) . ")";
    }

    public function convertNumberToWords($number)
    {
        $formatter = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        return $formatter->format($number) . " pesos 00/100 M.N.";
    }
}
