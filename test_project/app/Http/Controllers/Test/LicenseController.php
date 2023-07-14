<?php

namespace App\Http\Controllers\Test;

use App\Test\Licence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{
    public function saveLicense(Request $request)
    {
        $input     = $request->all();
        // var_dump($input );return;
        $validator = \Validator::make($input,
        [
            'off_name' => 'required',
            'lic_no' => 'required',
            'lic_date' => 'required',
            'lic_name' => 'required',
            'lic_addr' => 'required',
            'lic_type' => 'required'
        ],
        [
            'off_name.required' => 'Please enter office name',
            'lic_no.required' => 'Please enter licence number!',
            'lic_date.required' => 'Please select date!',
            'lic_name.required' => 'Please enter license name!',
            'lic_addr.required' => 'Please enter  address!',
            'lic_type.required' => 'Please select license type!',
        ]);
        if ($validator->passes()) {
            
            $lic  = new Licence();
            $lic->office = $request->input('off_name');
            $lic->licence_no = $request->input('lic_no');
            $lic->licence_date = $request->input('lic_date');
            $lic->licence_name = $request->input('lic_name');
            $lic->licence_address = $request->input('lic_addr');
            $lic->licence_type = $request->input('lic_type');
            $lic->status = 1;
            $lic->save();
            
            $data['message']     = 'saved successfully';
            
            return \Response::json($data, 200);
        } else {
            $data['error'] = $validator->errors()->all();
            return \Response::json($data, 400);
        }
    }

     

    public function getLicense()
        {
        $condition = ['licence_details.status' => 1];
        $data =DB::table('licence_details')
        ->where($condition)
        ->orderby('licence_details.id','asc')
        ->select('licence_details.id','licence_details.office','licence_details.licence_no','licence_details.licence_date','licence_details.licence_name','licence_details.licence_address','licence_details.licence_type')
        ->get();
        return response($data, 200);

        }

    public function destroy($id)
        {
           
            if ($id > 0) {
                
                           $lic         = Licence::findOrFail($id);
                           $lic->status = 0;
                           $lic->save();
                
                           $data['message'] = 'License deleted successfully';
                           $data['id']      = $id;
                           return response($data, 200);
                       } else {
                           $data['error'] = "Invalid id";
                           return response($data, 400);
                       }

     }


     

     public function updateLicense(Request $request)
    {
        $input     = $request->all();
        $id        = $request->input('id');
        dd( $input );
         
            $lc       = Licence::findOrFail($id);
            $lc->office = $request->input('office');
            
            
            $lc->save();
            $data['message']     = 'updated successfully';
            
            return \Response::json($data, 200);
         
    }
     
}
