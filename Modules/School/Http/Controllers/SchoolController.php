<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\School\Entities\School;
use Modules\School\Http\Requests\SchoolUpdateRequest;
use Modules\School\Http\Requests\SchoolStoreRequest;
use App\User;
class SchoolController extends Controller
{
    public $school;

    public $user;
    public function __construct(School $school, User $user)
    {
        $this->school = $school;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->user->checkRole(13)) {
            $schools = $this->school->orderBy('id', 'desc');
            if ($request->has('search') && $search = $request->search) {
                $schools = $schools->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            }
            $schools = $schools->paginate(10);
            return view('school::index', compact('schools'));
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
        if ($this->user->checkRole(14)) {
            return view('school::create');
        }
        return redirect()->route('school.index')->with('message', 'Bạn không có quyền');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolStoreRequest $request)
    {
        $this->school->create([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        return redirect()->route('school.index');
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
        if ($this->user->checkRole(15)) {
            $school = $this->school->find($id);
            if ($school) {
                return view('school::edit', compact('school'));
            } else {
                return redirect()->route('error404');
            }
        }
        return redirect()->route('school.index')->with('message', 'Bạn không có quyền');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolUpdateRequest $request, $id)
    {
        $school = $this->school->find($id);
        $school->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        return redirect()->route('school.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->checkRole(16)) {
            $this->school->find($id)->delete();
            return response()->json([
                'result' => true
            ]);
        }
        return response()->json([
            'error' => false
        ], 403);
    }
}

