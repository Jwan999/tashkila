<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddCustomerController extends Controller
{
    public function addCustomer(){
        $rules = $this->validate($request, [
            "name" => "required",
            "email" => "required",
            "phone" => "required",
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->code . $request->phone,
            'address' => $request->address,
            'password' => $request->password,

        ];

//        dd($data);

        Applicant::create($data);


        return redirect('/',)->withSuccess('تم التسجيل بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
//        orderByAsc('created_at')
        $query = Applicant::orderBy('created_at', 'asc')->where('stage', null);

        $applicants = $query->paginate(15);
        return view('dashboard/thirdStage', ['applicants' => $applicants]);
    }
}
