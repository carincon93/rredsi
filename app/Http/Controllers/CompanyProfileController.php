<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use App\Models\Project;
use App\Models\User;
use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionFaculty;
use Illuminate\Support\Facades\Bus;
use PharIo\Manifest\Author;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $business = $user->business()->first();
        return view('company-profile.index',compact('user','business'));
    }
 
    public function edit(User $user)
    {
        
        $user = auth()->user();
        $user->business()->get();
        $business = $user->business()->first();
        return view('company-profile.edit',compact('user','business'));
    }

    public function update(BusinessRequest $request, Business $business)
    {
        $business->name = $request->get('name');
        $business->nit = $request->get('nit');
        $business->address = $request->get('address');
        $business->cellphone_number = $request->get('cellphone_number');
        $business->email = $request->get('email');
        $business->data_authorization = true;


        if($business->save()){  
            
        return redirect()->back()->with('status', 'Actualización exitosa'); 
        }else{
            return redirect()->back()->with('status','Hubo probema al guardar');
        }
    }
}
