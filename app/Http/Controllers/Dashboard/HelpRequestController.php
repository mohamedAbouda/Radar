<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HelpRequestUpdateRequest;
use App\Models\HelpRequest;
use App\Models\User;

class HelpRequestController extends Controller
{
    protected $view = 'dashboard.helprequests.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 20;
        $data['resources'] = HelpRequest::paginate($limit);
        $data['counter_offset'] = ($request->get('page',1) * $limit) - $limit;
        return view($this->view.'index',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HelpRequest $helprequest)
    {
        $data['resource'] = $helprequest;
        $data['drivers'] = User::doesntHave('roles')->where('account_type',0)->pluck('full_name','id')->toArray();
        return view($this->view.'.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HelpRequestUpdateRequest $request,HelpRequest $helprequest)
    {
        $input = $request->all();
        if ($helprequest->location) {
            $helprequest->location->update($input);
        }
        if ($helprequest->update($input)) {
            return redirect()->route('dashboard.helprequests.index')->with('success' , 'Updated successfully');
        }
        return redirect()->back()->withErrors(['error' => 'Something went wrong ! please try again.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(HelpRequest $helprequest)
     {
         $helprequest->delete();
         return redirect()->back()->with('success' , 'Deleted successfully');
     }
}
