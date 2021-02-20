<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Services\Business\SecurityService;

//Controller for the login page
class CustomerController extends Controller
{
    public function index(Request $request)
    {
       $customerData = new CustomerModel(request()->get('firstName'), request()->get('lastName'));
        
       $nextID = 0;
       
       
//       $serviceCustomer = new SecurityService();
       
//        $isValid = $serviceCustomer->addCustomer($customerData);
       
//        if($isValid)
//        {
//            echo ("Customer Data Added Successfully");
//            return view('Customer');
//        }
//        else
//        {
//            echo ("Customer Data Was Not Added Successfully");
//            return view('Customer');
//        }

        return redirect('neworder')->with('nextID', $nextID)
                                        ->with('firstName', request()->get('firstName'))
                                        ->with('lastName', request()->get('lastName'));

    }
    
    //Validation added for Activity 3
    public function validateForm(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 4, 10 | Alpha',
                    'password' => 'Required | Between: 4, 10'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
}
