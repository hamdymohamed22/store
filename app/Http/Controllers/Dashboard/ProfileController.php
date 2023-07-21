<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();
        $countries =  Countries::getNames();
        $languages =  Languages::getNames();
        // dd($languages);
        return view('admin.profile',compact('user','countries', 'languages'));
    }
    public function update(Request $request){

        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            // 'birthdate' => 'nullable|date|before:today',
            'birthdate' => 'nullable',
            'gender' => "required|in:male,female",
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'str_address' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'locale' => 'string'
        ]);

        $user = $request->user();
        if ($request->has('image')) {
            if ($user->profile->image != null) {
               Storage::delete($user->profile->image); 
            }
            $data['image'] = Storage::putFile('users',$data['image']);
        }
        $user->profile->fill($data)->save();

        return redirect()->back()->with('success' , 'data inserted successfuly');


        // fill method create data if there no data for this user profile or update
        // data for this user if its exist

        // if ($user->profile->first_name) {
        //     $user->profile->update($data);
        // }else {
        //     $user->profile()->create($data);
        // }

    }
}
