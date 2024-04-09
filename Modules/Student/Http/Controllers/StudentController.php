<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Role;
use Modules\Student\Http\Requests\StudentStoreRequest;
use Modules\Student\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
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
        if ($this->user->checkRole(1)) {
            $students = $this->user->where('account_id', 2)->orderBy('id', 'desc');
            if ($request->has('search') && $search = $request->search) {
                $students = $students->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('birthday', 'like', '%' . $search . '%');
            }
            $students = $students->paginate(10);
            return view('student::index', compact('students'));
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
        if ($this->user->checkRole(2)) {
            $roles = Role::get();
            $accounts = Account::get();
            $role_user = [1, 5, 9, 13];
            return view('student::create', compact('roles', 'role_user', 'accounts'));
        }
        return redirect()->route('student.index')->with('message', 'Bạn không có quyền');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(studentStoreRequest $request)
    {
        $data_student = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => 2
        ];
        if ($request->has('password')) {
            $data_student['password'] = Hash::make($request->password);
        }
        $user_id = $this->user->create($data_student);
        $roles = $request->input('role', []);
        foreach ($roles as $role) {
            RoleUser::create([
                'role_id' => $role,
                'user_id' => $user_id->id,
            ]);
        }
        return redirect()->route('student.index');
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
        if ($this->user->checkRole(3)) {
            $accounts = Account::get();
            $roles = Role::get();
            $role_user = RoleUser::where('user_id', $id)->get();
            $student = $this->user->find($id);
            if ($student) {
                return view('student::edit', compact('student', 'roles', 'accounts', 'role_user'));
            } else {
                return redirect()->route('error404');
            }
        }
        return redirect()->route('student.index')->with('message', 'Bạn không có quyền');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(studentUpdateRequest $request, $id)
    {
        $student = $this->user->find($id);
        $data_student = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => $request->account
        ];
        if ($request->has('password')) {
            $data_student['password'] = Hash::make($request->password);
        }
        $student->update($data_student);
        RoleUser::where('user_id', $student->id)->delete();
        $roles = $request->input('role', []);
        foreach ($roles as $role) {
            RoleUser::create([
                'role_id' => $role,
                'user_id' => $student->id,
            ]);
        }
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->checkRole(4)) {
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
