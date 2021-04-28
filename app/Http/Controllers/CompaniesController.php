<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\FavouriteCompany;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $xMember = $request->header('x-member');
        if($xMember){
            return FavouriteCompany::notFavouriteCompany($xMember);
        }

        return Company::orderBy('created_at','DESC')->get();


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCompany = new Company;
        $newCompany->company_name =  $request->company['company_name'];
        $newCompany->phone_number = $request->company['phone_number'];
        $newCompany->save();

        return $newCompany;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingCompany = Company::find( $id );
        
        if( $existingCompany ){
            $existingCompany->company_name = $request->company['company_name'];
            $existingCompany->phone_number = $request->company['phone_number'];
            $existingCompany->save();
            return $existingCompany;
        }

        return "Company not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingCompany = Company::find( $id );

        if( $existingCompany ){
            $existingCompany->delete();
            return "Company successfully deleted.";
        }

        return "Company not found.";
    }
}
