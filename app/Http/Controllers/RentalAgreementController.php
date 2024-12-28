<?php

namespace App\Http\Controllers;

use App\Models\RentalAgreement;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

            $status=RentalAgreement::$status;
            return view('rental_agreement.create', compact('vehicles', 'drivers','status'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create rental agreement')) {
            $validator = \Validator::make(
                $request->all(), [
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

            $rentalAgreement = new RentalAgreement();
            $rentalAgreement->agreement_id = $this->agreementNumber();
            $rentalAgreement->date = date('Y-m-d');
            $rentalAgreement->rental_start_date = $request->rental_start_date;
            $rentalAgreement->rental_end_date = $request->rental_end_date;
            $rentalAgreement->rental_duration = $request->rental_duration;
            $rentalAgreement->vehicle = $request->vehicle;
            $rentalAgreement->driver = $request->driver;
            $rentalAgreement->terms_condition = $request->terms_condition;
            $rentalAgreement->description = $request->description;
            $rentalAgreement->status = $request->status;
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
            $id=Crypt::decrypt($ids);
            $rentalAgreement=RentalAgreement::find($id);
            $settings = settings();
            return view('rental_agreement.show', compact('rentalAgreement','settings'));
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

            $status=RentalAgreement::$status;
            return view('rental_agreement.edit', compact('vehicles', 'drivers','rentalAgreement','status'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, RentalAgreement $rentalAgreement)
    {
        if (\Auth::user()->can('edit rental agreement')) {
            $validator = \Validator::make(
                $request->all(), [
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
}
