<?php

namespace App\Http\Controllers;


use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    public function addAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'district' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('country')){
                return redirect()->back()->with(['notify_error' => 'Country is required to add new address'])->withErrors(['country' => 'Country is required (ex: Sri Lanka)']);
            }elseif ($validator->errors()->has('district')){
                return redirect()->back()->with(['notify_error' => 'District is required to add new address'])->withErrors(['district' => 'District is required (ex: Hambanthota)']);
            }elseif ($validator->errors()->has('city')){
                return redirect()->back()->with(['notify_error' => 'City is required to add new address'])->withErrors(['city' => 'City is required (ex: Beliatta)']);
            }elseif ($validator->errors()->has('postal_code')){
                return redirect()->back()->with(['notify_error' => 'Postal Code is required to add new address'])->withErrors(['postal_code' => 'Postal Code is required (ex: 82400)']);
            }elseif ($validator->errors()->has('address')){
                return redirect()->back()->with(['notify_error' => 'Address is required to add new address'])->withErrors(['address' => 'Address is required (ex: 252/1)']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong can not add new address']);
            }

        }
        $validated = $validator->validated();
        try{
            $address = new UserAddress();
            $address->country = $validated['country'];
            $address->district = $validated['district'];
            $address->city = $validated['city'];
            $address->postal_code = $validated['postal_code'];
            $address->address = $validated['address'];
            $address->user_id = session()->get('auth_user')->user_id;
            $address->save();
            return redirect()->back()->with(['success' => 'New Address Added Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['notify_error' => 'Something went wrong can not add new address']);
        }
    }
    public function deleteAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()->with(['notify_error' => 'Sorry...! Can not identify this address']);
        }
        $validated = $validator->validated();
        try{
            UserAddress::where('id', '=', $validated['address_id'])->where('user_id', '=', session()->get('auth_user')->user_id)->delete();
            return redirect()->back()->with(['success' => 'Your Address deleted successfully...!']);
        }catch (Exception $excepton){
            return redirect()->back()->with(['notify_error' => 'Sorry...! Can not identify this address']);
        }
    }
    public function updateAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'country' => 'required',
            'district' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('country')){
                return redirect()->back()->with(['notify_error' => 'Country is required to update this address'])->withErrors(['update_country' => 'Country is required (ex: Sri Lanka)']);
            }elseif ($validator->errors()->has('district')){
                return redirect()->back()->with(['notify_error' => 'District is required to update this address'])->withErrors(['update_district' => 'District is required (ex: Hambanthota)']);
            }elseif ($validator->errors()->has('city')){
                return redirect()->back()->with(['notify_error' => 'City is required to update this address'])->withErrors(['update_city' => 'City is required (ex: Beliatta)']);
            }elseif ($validator->errors()->has('postal_code')){
                return redirect()->back()->with(['notify_error' => 'Postal Code is required to update this address'])->withErrors(['update_postal_code' => 'Postal Code is required (ex: 82400)']);
            }elseif ($validator->errors()->has('address')){
                return redirect()->back()->with(['notify_error' => 'Address is required to update this address'])->withErrors(['update_address' => 'Address is required (ex: 252/1)']);
            }elseif ($validator->errors()->has('address_id')){
                return redirect()->back()->with(['notify_error' => 'Sorry...! can not update this address']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong can not update this address']);
            }

        }
        $validated = $validator->validated();
        try{
            $address = UserAddress::where('id', '=', $validated['address_id'])->where('user_id', '=', session()->get('auth_user')->user_id)->first();
            $address->country = $validated['country'];
            $address->district = $validated['district'];
            $address->city = $validated['city'];
            $address->postal_code = $validated['postal_code'];
            $address->address = $validated['address'];
            $address->user_id = session()->get('auth_user')->user_id;
            $address->save();
            return redirect()->back()->with(['success' => 'Address Updated Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['notify_error' => 'Something went wrong can not update this address']);
        }
    }
}
