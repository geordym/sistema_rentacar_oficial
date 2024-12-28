<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Place;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PlaceController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage place')) {
            $places = Place::where('parent_id', parentId())->get();
            return view('place.index', compact('places'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        return view('place.create');
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create place')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'city' => 'required',
                    'island' => 'required',
                    'price' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $place = new Place();
            $place->name = $request->name;
            $place->city = $request->city;
            $place->island = $request->island;
            $place->price = $request->price;
            $place->depo_name = $request->depo_name;
            $place->depo_address = $request->depo_address;
            $place->parent_id = parentId();
            $place->save();
            return redirect()->route('place.index')->with('success', __('Place successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Place $place)
    {
        //
    }


    public function edit(Place $place)
    {
        return view('place.edit',compact('place'));
    }


    public function update(Request $request, Place $place)
    {
        if (\Auth::user()->can('edit place')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'city' => 'required',
                    'island' => 'required',
                    'price' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $place->name = $request->name;
            $place->city = $request->city;
            $place->island = $request->island;
            $place->depo_name = $request->depo_name;
            $place->depo_address = $request->depo_address;
            $place->price = $request->price;
            $place->save();
            return redirect()->route('place.index')->with('success', __('Place successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Place $place)
    {
        if (\Auth::user()->can('delete place') ) {
            $place->delete();
            return redirect()->route('place.index')->with('success', __('Place successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getPlaceRateCalculation(Request $request)
    {
        $addonAmount=0;
        $totalRate=0;
        $considerDays=1;
        $vehicle = Vehicle::find($request->vahicle_id);
        $start_date_time=$request->start_date_time;
        $end_date_time=$request->end_date_time;
        $pickup_place=$request->pickup_place;
        $drop_off_place=$request->drop_off_place;

        $pickupPlaceString='';
        if(!empty($pickup_place)){
            $pickupPlaceAmount=placesRateCalculation($pickup_place);
            $pickupPlaceRateCalculation=specificPlacesRateCalculation($pickup_place);
            $pickupPlaceString="<tr><td>".$pickupPlaceRateCalculation['place']."</td><td>".priceFormat($pickupPlaceRateCalculation['final_price'])."</td></tr>";
        }else{
            $pickupPlaceAmount=0;
        }

        $dropPlaceString='';
        if(!empty($drop_off_place)){
            $dropPlaceAmount=placesRateCalculation($drop_off_place);
            $dropPlaceRateCalculation=specificPlacesRateCalculation($drop_off_place);
            $dropPlaceString="<tr><td>".$dropPlaceRateCalculation['place']."</td><td>".priceFormat($dropPlaceRateCalculation['final_price'])."</td></tr>";
        }else{
            $dropPlaceAmount=0;
        }
        $placeAmount=$pickupPlaceAmount+$dropPlaceAmount;
        if (!empty($vehicle) && !empty($start_date_time) && !empty($end_date_time)) {
            $daily_rate = !empty($vehicle->daily_rate) && ($vehicle->daily_rate > 0) ? $vehicle->daily_rate : 0;
            $data=vehicleRateCalculation($daily_rate, $start_date_time, $end_date_time);
            $totalRate=(int)$data['totalRate'];
            $considerDays=$data['considerDays'];
        }

        if(!empty($request->addons)){
            $addonAmount =addonsRateCalculation($request->addons,$considerDays);
        }
        $data['addonAmount']=$addonAmount;
        $data['totalRate']=$totalRate;
        $data['placeAmount']=$placeAmount;
        $data['pickup_place']=$pickupPlaceString;
        $data['drop_place']=$dropPlaceString;
        return json_encode($data);
    }
}
