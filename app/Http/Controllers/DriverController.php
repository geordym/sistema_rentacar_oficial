<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DriverController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage driver')) {
            $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('driver.index', compact('drivers'));
    }


    public function newCreate()
    {
        $gender = User::$gender;
        return view('driver.new_create', compact('gender'));
    }

    public function create()
    {
        $gender = User::$gender;
        return view('driver.create', compact('gender'));
    }


    public function store(Request $request)
    {

        if (\Auth::user()->can('create driver')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users',
                    'phone_number' => 'required|numeric|unique:users',
                    'gender' => 'required',
                    'birth_date' => 'required',
                    'address' => 'required',
                    'license_number' => 'required',
                    'issue_date' => 'required',
                    'expiration_date' => 'required',
                    'document' => 'required',
                    'license' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            if(Carbon::now()->subYears(18)->format('Y-m-d') > $request->birth_date){
                $drv=new Driver();
                $drv->birth_date = $request->birth_date;
            }else{
                return redirect()->back()->with('error', __('Driver age should not be 18 years old.'));
            }
            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalDriver = $authUser->totalDriver();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalDriver >= $subscription->driver_limit && $subscription->driver_limit != 0) {
                return redirect()->back()->with('error', __('Your driver limit is over, please upgrade your subscription.'));
            }

            $userRole = Role::where('name', 'driver')->where('parent_id', parentId())->first();
            $user = new User();
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->phone_number = !empty($request->phone_number) ? $request->phone_number : null;
            $user->password = \Hash::make(123456);
            $user->type = $userRole->name;
            $user->profile = 'avatar.png';
            $user->lang = 'english';
            $user->parent_id = parentId();
            $user->save();
            $user->assignRole($userRole);


            if (!empty($user)) {
                $driver = new Driver();
                $driver->driver_id = $this->driverNumber();
                $driver->user_id = $user->id;
                $driver->gender = $request->gender;
                $driver->age = !empty($request->age) ? $request->age : 0;
                $driver->address = !empty($request->address) ? $request->address : null;
                $driver->license_number = !empty($request->license_number) ? $request->license_number : null;
                $driver->issue_date = !empty($request->issue_date) ? $request->issue_date : null;
                $driver->expiration_date = !empty($request->expiration_date) ? $request->expiration_date : null;
                $driver->reference = !empty($request->reference) ? $request->reference : null;
                $driver->notes = !empty($request->notes) ? $request->notes : null;
                $driver->parent_id = parentId();

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
            if (isset($request->direct_create)) {
                if (!empty($driver)) {
                    $driverList = User::where('type', 'driver')->where('parent_id', parentId())
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->pluck('name', 'id');

                    $response['status'] = true;
                    $response['message'] = __('Driver successfully created');
                    $response['data'] = $driverList;
                } else {
                    $response['status'] = false;
                    $response['message'] = __('Driver created failed');
                    $response['data'] = [];
                }

                return json_encode($response);
            } else {
                return redirect()->route('driver.index')->with('success', __('Driver successfully created.'));
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
        $user = User::find($id);
        $name = explode(' ', $user->name);
        $user->first_name = isset($name[0]) ? $name[0] : null;
        $user->last_name = isset($name[1]) ? $name[1] : null;
        $driver = $user->drivers;
        $gender = User::$gender;
        return view('driver.edit', compact('driver', 'user', 'gender'));
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