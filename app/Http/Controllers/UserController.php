<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['users'] = User::latest()
                        ->when($request->username != '', function($q) use ($request) {
                            $q->where(DB::raw('lower(username)'), 'like', '%' . $request->username . '%');
                        })
                        ->paginate(5);

        return view('index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {

            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = \bcrypt($request->password);
            $user->save();

            DB::commit();

            return \redirect()->route('user.index')->with('success', 'Berhasil menambahkan User');
        } catch (Exception $e) {
            DB::rollBack();

            report($e);

            return \back()->with('danger', 'Gagal menambahkan user');
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
        $user = User::findOrFail($id);
        $user->delete();

        return \redirect()->route('user.index')->with('success', 'Berhasil delete User');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);

        return view('edit')->with($data);
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
        $validator = Validator::make(
            $request->all(), [
            'email' => 'required',
            'phone' => 'required|numeric',
            'password' => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {

            $user = User::findOrFail($id);
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password ? \bcrypt($request->password) : $user->password;
            $user->save();

            DB::commit();

            return \redirect()->route('user.index')->with('success', 'Berhasil update User');
        } catch (Exception $e) {
            DB::rollBack();

            report($e);

            return \back()->with('danger', 'Gagal update user');
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
        //
    }
}
