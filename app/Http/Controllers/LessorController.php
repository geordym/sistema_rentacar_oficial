<?php

namespace App\Http\Controllers;

use App\Models\Lessor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class LessorController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage lessor')) {
            $lessors = Lessor::all();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('lessor.index', compact('lessors'));
    }


    public function newCreate()
    {
        return view('lessor.new_create');
    }

    public function create()
    {
        return view('lessor.create');
    }


    public function store(Request $request)
    {
        // Verifica si el usuario tiene permisos para crear un arrendador
        if (Auth::user()->can('create lessor')) {
    
            // Validación de los datos del formulario
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|string',
                    'document_type' => 'required|string',
                    'document_number' => 'required|string',
                    'residence_address' => 'required|string',
                    'fiscal_address' => 'required|string',
                    'document_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                ]
            );
    
            // Si la validación falla, regresa con el error
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
    
            // Crea el arrendador (Lessor)
            $lessor = new Lessor();
            $lessor->name = $request->name;
            $lessor->nationality = $request->nationality;
            $lessor->document_type = $request->document_type;
            $lessor->document_number = $request->document_number;
            $lessor->residence_address = $request->residence_address;
            $lessor->fiscal_address = $request->fiscal_address;

            $lessor->city = $request->city;
            $lessor->municipality = $request->municipality;
            $lessor->license_number = $request->license_number;
    
            // Convertir la imagen del documento a base64 si se sube una imagen
            if ($request->hasFile('document_image')) {
                $image = $request->file('document_image');
                $base64Image = base64_encode(file_get_contents($image));
                $lessor->document_image = $base64Image;
            }
    
    
            // Guarda el arrendador en la base de datos
            $lessor->save();
    
            // Retorna con mensaje de éxito
            return redirect()->route('lessor.index')->with('success', __('Lessor successfully created.'));
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
        $lessor = Lessor::find($id);
        return view('lessor.edit', compact('lessor'));
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
