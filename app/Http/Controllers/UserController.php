<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Subdepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department','subdepartment')->get();
        return view('back.master.users.index', compact(
            'users'
        ));
    }

    public function create()
    {
        $departments = Department::get();
        $subdepartments = Subdepartment::get();
        return view('back.master.users.create', compact(
            'departments',
            'subdepartments'
        ));
    }

    public function store(UserRequest $request)
    {
        if($request->hasFile('avatar') && $request->hasFile('signature')){
            $slug = $request['name'];

            $extFile = $request->avatar->getClientOriginalExtension();
            $extFileSignature = $request->signature->getClientOriginalExtension();

            $nameFile = $slug.'-'.time().".".$extFile;
            $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;

            $request->avatar->storeAs('public/uploads/users/',$nameFile);
            $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
        }else{
            $nameFile = 'avatar.jpeg';
            $nameFileSignature = 'paraf.jpg';
        }

        User::create([
            'nik' => $request['nik'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'signature' => $nameFileSignature,
            'avatar' => $nameFile,
            'department_id' => $request['department'],
            'subdepartment_id' => $request['subdepartment'] ?? null
        ]);

        return redirect()
            ->route('users.index')
            ->with('message',"Berhasil menambahkan user baru");
    }

    public function edit(User $user)
    {
        $departments = Department::get();
        $subdepartments = Subdepartment::get();
        return view('back.master.users.edit', compact(
            'user',
            'departments',
            'subdepartments'
        ));
    }

    public function update(UserRequest $request, User $user)
    {
        if($request->hasFile('avatar') && $request->hasFile('signature')){
            $slug = $request['name'];
            $extFile = $request->avatar->getClientOriginalExtension();
            $extFileSignature = $request->signature->getClientOriginalExtension();
            $nameFile = $slug.'-'.time().".".$extFile;
            $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;
            $request->avatar->storeAs('public/uploads/users/',$nameFile);
            $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
            $user->update([
                'nik' => $request['nik'],
                'name' => $request['name'],
                'signature' => $nameFileSignature,
                'avatar' => $nameFile,
                'department_id' => $request['department'],
                'subdepartment_id' => $request['subdepartment'] ?? null
            ]);
        }else{
            $user->update([
                'nik' => $request['nik'],
                'name' => $request['name'],
                'department_id' => $request['department'],
                'subdepartment_id' => $request['subdepartment'] ?? null
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('message',"Berhasil memperbaharui user");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('users.index')
            ->with('message',"Berhasil menghapus user");
    }

    public function profile()
    {
        $departments = Department::get();
        $subdepartments = Subdepartment::get();
        return view('back.master.users.profiles.index', compact(
            'departments',
            'subdepartments'
        ));
    }

    public function updateProfile(UserRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        if($request->hasFile('avatar') && $request->hasFile('signature')){
            $slug = $request['name'];
            $extFile = $request->avatar->getClientOriginalExtension();
            $extFileSignature = $request->signature->getClientOriginalExtension();
            $nameFile = $slug.'-'.time().".".$extFile;
            $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;
            $request->avatar->storeAs('public/uploads/users/',$nameFile);
            $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
            $user->update([
                'name' => $request['name'],
                'signature' => $nameFileSignature,
                'avatar' => $nameFile,
                'department_id' => $request['department'],
                'subdepartment_id' => $request['subdepartment'] ?? null
            ]);
        }else{
            $user->update([
                'name' => $request['name'],
                'department_id' => $request['department'],
                'subdepartment_id' => $request['subdepartment'] ?? null
            ]);
        }

        return redirect()
            ->route('profiles.index')
            ->with('message',"Berhasil memperbaharui profile");
    }

    public function setting()
    {
        return view('back.master.users.settings.index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_old' => [
                'required',
            ],
            'password_new' => [
                'required',
                'min:8',
                'confirmed'
            ]
        ]);

        if(!Hash::check($request->password_old, auth()->user()->password)){
            return back()->with('error','Password lama salah');
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password_new)
        ]);


        return back()
            ->with('message','Password berhasil diperbaharui');

    }
}
