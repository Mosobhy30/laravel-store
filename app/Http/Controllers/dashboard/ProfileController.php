<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;



class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        // dd(Countries::getNames());
        return view('dashboard.profile.edit',  [
            'user' => $user,
            'countries' => Countries::getNames('en') ,
            'local' => Languages::getNames('en') ,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'country' => ['required', 'string', 'size:2'],
            'gender' => ['in:male,female'],
        ]);
        $user =$request->user();    // or $user = Auth::user();

        $user->profile->fill( $request->all() )->save();
        
        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated');
    }
}
