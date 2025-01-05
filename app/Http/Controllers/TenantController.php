<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Validator;

class TenantController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage tenant')) {
            $tenants = Tenant::all();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('tenant.index', compact('tenants'));
    }


    public function newCreate()
    {
       // $tenant = User::$gender;
        return view('tenant.new_create');
    }

    public function create()
    {
      //  $gender = User::$gender;
        return view('tenant.create');
    }

    public function store(Request $request)
    {
        // Verificar permisos de creación
        if (\Auth::user()->can('create tenant')) {
    
            // Validación de los datos del formulario
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'nationality' => 'nullable|string|max:255',
                    'document_type' => 'required|string|max:255',
                    'document_number' => 'required|string|max:255',
                    'residence_address' => 'required|string|max:255',
                    'city' => 'nullable|string|max:255',
                    'municipality' => 'nullable|string|max:255',
                    'license_number' => 'required|string|max:255',
                    'license_issued_state' => 'required|string:max:255',
                    'document_image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validación del archivo documento
                    'drive_license_image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validación del archivo licencia
                    'reference' => 'nullable|string|max:255',
                    'notes' => 'nullable|string|max:500',
                ]
            );
    
            // Si la validación falla, redirigir con los errores
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
    
            // Creación de un nuevo Tenant
            $tenant = new Tenant();
            $tenant->name = $request->name;
            $tenant->nationality = $request->nationality;
            $tenant->document_type = $request->document_type;
            $tenant->document_number = $request->document_number;
            $tenant->residence_address = $request->residence_address;
            $tenant->city = $request->city;
            $tenant->municipality = $request->municipality;
            $tenant->license_number = $request->license_number;
            $tenant->license_issued_state = $request->license_issued_state;


            // Guardar el archivo documento como Base64 en la base de datos
            if ($request->hasFile('document_image')) {
                $document = $request->file('document_image');
                $documentContents = file_get_contents($document); // Obtener el contenido binario del archivo
                $tenant->document_image = base64_encode($documentContents);  // Codificar a Base64
            }

            if ($request->hasFile('drive_license_image')) {
                $driveLicenseImage = $request->file('drive_license_image');
                $driveLicenseContents = file_get_contents($driveLicenseImage); // Obtener el contenido binario del archivo
                $tenant->drive_license_image = base64_encode($driveLicenseContents);  // Codificar a Base64
            }
    
            // Guardar el archivo licencia como Base64 en la base de datos
           /* if ($request->hasFile('license')) {
                $license = $request->file('license');
                $licenseContents = file_get_contents($license); // Obtener el contenido binario del archivo
                $tenant->license_base64 = base64_encode($licenseContents);  // Codificar a Base64
            }*/
    
            // Guardar el Tenant en la base de datos
            $tenant->save();
    
            // Respuesta según si es creación directa o no
            if (isset($request->direct_create)) {
                $tenantList = Tenant::all()->pluck('name', 'id');
    
                $response['status'] = true;
                $response['message'] = __('Tenant successfully created');
                $response['data'] = $tenantList;
    
                return json_encode($response);
            } else {
                return redirect()->route('tenant.index')->with('success', __('Tenant successfully created.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
    


    public function show($id)
    {
        $user = User::find($id);
        $name = explode(' ', $user->name);
        $user->first_name = isset($name[0]) ? $name[0] : null;
        $user->last_name = isset($name[1]) ? $name[1] : null;
        $driver = $user->drivers;
        return view('driver.show', compact('driver', 'user'));
    }


    public function edit($id)
    {
        $tenant = Tenant::find($id);
        return view('tenant.edit', compact('tenant'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit driver')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $user = User::find($id);
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->phone_number = !empty($request->phone_number) ? $request->phone_number : null;
            $user->save();

            if (!empty($user)) {
                $driver = Driver::where('user_id', $id)->first();
                $driver->gender = $request->gender;
                $driver->age = !empty($request->age) ? $request->age : 0;
                $driver->birth_date = !empty($request->birth_date) ? $request->birth_date : null;
                $driver->address = !empty($request->address) ? $request->address : null;
                $driver->license_number = !empty($request->license_number) ? $request->license_number : null;
                $driver->issue_date = !empty($request->issue_date) ? $request->issue_date : null;
                $driver->expiration_date = !empty($request->expiration_date) ? $request->expiration_date : null;
                $driver->reference = !empty($request->reference) ? $request->reference : null;
                $driver->notes = !empty($request->notes) ? $request->notes : null;
                if (!empty($request->document)) {
                    $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                    $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                    $documentExtension = $request->file('document')->getClientOriginalExtension();
                    $documentFileName = $documentFilename . '_' . time() . '.' . $documentExtension;

                    $directory = storage_path('upload/document');
                    $filePath = $directory . $documentFilenameWithExt;


                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $request->file('document')->storeAs('upload/document/', $documentFileName);
                    $driver->document = $documentFileName;
                }
                if (!empty($request->license)) {
                    $licenseFilenameWithExt = $request->file('license')->getClientOriginalName();
                    $licenseFilename = pathinfo($licenseFilenameWithExt, PATHINFO_FILENAME);
                    $licenseExtension = $request->file('license')->getClientOriginalExtension();
                    $licenseFileName = $licenseFilename . '_' . time() . '.' . $licenseExtension;

                    $directory = storage_path('upload/license');
                    $filePath = $directory . $licenseFilenameWithExt;

                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $request->file('license')->storeAs('upload/license/', $licenseFileName);
                    $driver->license = $licenseFileName;
                }
                $driver->save();
            }
            return redirect()->route('driver.index')->with('success', __('Driver successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete driver')) {
            $user = User::find($id);
            $user->delete();
            $driver = Driver::where('user_id', $id)->delete();

            return redirect()->route('driver.index')->with('success', __('Client successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function driverNumber()
    {
        $latest = Driver::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->driver_id + 1;
    }

}
