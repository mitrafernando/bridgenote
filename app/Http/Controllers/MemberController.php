<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = User::with('member')->findOrFail($request->user()->id);

            return response($user);
        } catch (\Throwable $th) {
            return response(['error' => 'data not found']);
        }
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
        try {
            $member = Member::create([
                'user_id' => $request->user()->id,
                'status' => 'active',
                'position' => ''
            ]);
            return response($member, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response(['error' => 'please create with another user']);
        }

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
        try {
            $member = Member::findOrFail($id);
            $this->authorize('update', $member);
            $member->status = $request->status;
            $member->position = $request->position;
            $member->save();
        return response($member);
        } catch (\Throwable $th) {
            return response(['error' => 'data not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            $this->authorize('delete', $member);
            $member->delete();

            return response([
                'status' => 'succeed'
            ]);
        } catch (\Throwable $th) {
            return response(['error' => 'data not found']);
        }
    }
}
