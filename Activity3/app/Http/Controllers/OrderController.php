<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Services\Business\SecurityService;

//Controller for the Order page
class OrderController extends Controller
{
    public function index(Request $request)
    {
        //Put customer data in a model 
        $customerData = new CustomerModel(request()->get('firstName'), request()->get('lastName'));
        
        
        
       //Since we are not using a model this time
       $product = request()->get('product');
       
       //THis is more efficent since it is not calling a method
       $customerID = request()->get('customerID');     //returning null
       
      
        
       $serviceCustomer = new SecurityService();
       
       $isValid = $serviceCustomer->addAllInformation($product, $customerID, $customerData);
       
       if($isValid)
       {
           echo ("Order Data Commited Successfully");
           return view('order');
       }
       else
       {
           echo ("Order Data Was Rolled Back");
           return view('order');
       }
    }
    
    //Validation added for Activity 3
    public function validateForm(Request $request)
    {
/*         //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 4, 10 | Alpha',
                    'password' => 'Required | Between: 4, 10'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules); */
    }
    
}
