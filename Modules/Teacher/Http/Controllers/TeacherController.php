<?php

namespace Modules\Teacher\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Role;
use Modules\Teacher\Http\Requests\TeacherStoreRequest;
use Modules\Teacher\Http\Requests\TeacherUpdateRequest;

class TeacherController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->user->checkRole(5)) {
            $teachers = $this->user->where('account_id', 1)->orderBy('id', 'desc');
            if ($request->has('search') && $search = $request->search) {
                $teachers = $teachers->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('birthday', 'like', '%' . $search . '%');
            }
            $teachers = $teachers->paginate(10);
            return view('teacher::index', compact('teachers'));
        }
        return redirect()->route('admin.index')->with('message', 'Bạn không có quyền');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->user->checkRole(6)) {
            $roles = Role::get();
            $accounts = Account::get();
            $role_user = [1, 5, 9, 13];
            return view('teacher::create', compact('roles', 'role_user', 'accounts'));
        }
        return redirect()->route('teacher.index')->with('message', 'Bạn không có quyền');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request)
    {
        $data_teacher = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => 1
        ];
        if ($request->has('password')) {
            $data_teacher['password'] = Hash::make($request->password);
        }
        $user_id = $this->user->create($data_teacher);
        $roles = $request->input('role', []);
        foreach ($roles as $role) {
            RoleUser::create([
                'role_id' => $role,
                'user_id' => $user_id->id,
            ]);
        }
        return redirect()->route('teacher.index');
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
        if ($this->user->checkRole(7)) {
            $accounts = Account::get();
            $roles = Role::get();
            $role_user = RoleUser::where('user_id', $id)->get();
            $teacher = $this->user->find($id);
            if ($teacher) {
                return view('teacher::edit', compact('teacher', 'roles', 'accounts', 'role_user'));
            } else {
                return redirect()->route('error404');
            }
        }
        return redirect()->route('teacher.index')->with('message', 'Bạn không có quyền');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateRequest $request, $id)
    {
        $teacher = $this->user->find($id);
        $data_teacher = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => $request->account
        ];
        if ($request->has('password')) {
            $data_teacher['password'] = Hash::make($request->password);
        }
        $teacher->update($data_teacher);
        RoleUser::where('user_id', $teacher->id)->delete();
        $roles = $request->input('role', []);
        foreach ($roles as $role) {
            RoleUser::create([
                'role_id' => $role,
                'user_id' => $teacher->id,
            ]);
        }
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->checkRole(8)) {
            $this->user->find($id)->delete();
            return response()->json([
                'result' => true
            ]);
        }
        return response()->json([
            'error' => false
        ], 403);
    }
}
