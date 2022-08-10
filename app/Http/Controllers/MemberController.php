<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listMembers()
    {
        $members = Member::all();

        foreach($members as $member){
            $sum = strtoupper($member->summery);

            if($sum == $member->summery){
                $member->last_name = $member->last_name.' '.$member->summery;
            }else{
                $member->last_name;
            }
        }
        return response()->json([
            "message" => "Get All Data",
            "members" => $members
        ]);
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
    public function addMember(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'summery' => 'required',
            'division' => 'required',
            'date_of_birth' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => "check your validations again"
            ]);
        }

        $addMember = new Member;
        $addMember->first_name = $request->first_name;
        $addMember->last_name = $request->last_name;
        $addMember->summery = $request->summery;
        $addMember->division = $request->division;
        $addMember->date_of_birth = $request->date_of_birth;

        $addMember->save();

        return response()->json([
            'message' => "Intert Successfull"
        ]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function getMember($id)
    {
        $member = Member::find($id);

        return response()->json([
            'member' => $member
        ]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function searchMember($name)
    {
        if($name != null){
            $data = Member::where('last_name', 'like', '%'.$name.'%')->get();
            foreach($data as $member){
                $sum = strtoupper($member->summery);
    
                if($sum == $member->summery){
                    $member->last_name = $member->last_name.' '.$member->summery;
                }else{
                    $member->last_name;
                }
            }

            return response()->json([
                "name"=>$data
            ]);
        }else {
            $data = Member::all();

            foreach($data as $member){
                $sum = strtoupper($member->summery);
    
                if($sum == $member->summery){
                    $member->last_name = $member->last_name.' '.$member->summery;
                }else{
                    $member->last_name;
                }
            }
            return response()->json([
                "name"=>$data
            ]);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'summery' => 'required',
            'division' => 'required',
            'date_of_birth' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => "check your validations again"
            ]);
        }

        $updateMember = Member::find($id);
        $updateMember->first_name = $request->first_name;
        $updateMember->last_name = $request->last_name;
        $updateMember->summery = $request->summery;
        $updateMember->division = $request->division;
        $updateMember->date_of_birth = $request->date_of_birth;

        $updateMember->save();

        return response()->json([
            'message' => "Updated Successfull"
        ]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteMember = Member::find($id); 
        $deleteMember->delete();

        return response()->json([
            'message' => "Delete Successfull",
            "member" => $deleteMember
        ]);  
    }
}
