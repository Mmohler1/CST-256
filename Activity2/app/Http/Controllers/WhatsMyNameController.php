<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Controller used for the whoiam type classes to forward first and last name.
class WhatsMyNameController extends Controller
{
    //
    public function index(Request $request)
    {
        // Usage of path method
        $path = $request->path();
        echo 'Path Method: '.$path;
        echo '<br>';
        
        // Usage of is method
        $method = $request->isMethod('get') ? "GET" : "POST";
        echo 'GET or POST Method: '.$method;
        echo '<br>';
        
        // Usage of url method
        $url = $request->url();
        echo 'URL method: '.$url;
        echo '<br>';
        
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        echo "Your name is: " . $firstName . " " . $lastName;
        echo '<br>';
        
        $data = ['firstName' => $firstName, 'lastName' => $lastName];
        return view('thatswhoiam')->with($data);
        
    }
    
}
