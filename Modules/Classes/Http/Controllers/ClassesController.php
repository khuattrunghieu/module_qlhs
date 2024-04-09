<?php

namespace Modules\Classes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Classes\Entities\Classes;
use App\User;
use Modules\Classes\Http\Requests\ClassStoreRequest;
use Modules\Classes\Http\Requests\ClassUpdateRequest;
use Modules\School\Entities\School;

class ClassesController extends Controller
{
    public $class;
    public $user;
    public function __construct(Classes $class, User $user)
    {
        $this->class = $class;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->user->checkRole(9)) {
            $classes = $this->class->orderBy('id', 'desc');
            if ($request->has('search') && $search = $request->search) {
                $classes = $classes->where('name', 'like', '%' . $search . '%');
            }
            $classes = $classes->paginate(10);
            return view('classes::index', compact('classes'));
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
        if ($this->user->checkRole(10)) {
            $schools = School::all();
            return view('classes::create', compact('schools'));
        }
        return redirect()->route('classes.index')->with('message', 'Bạn không có quyền');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassStoreRequest $request)
    {
        $this->class->create([
            'name' => $request->name,
            'school_id' => $request->school,
        ]);
        return redirect()->route('classes.index');
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
        if ($this->user->checkRole(11)) {
            $schools = School::all();
            $class = $this->class->find($id);
            if ($class) {
                return view('classes::edit', compact('class', 'schools'));
            } else {
                return redirect()->route('error404');
            }
        }
        return redirect()->route('classes.index')->with('message', 'Bạn không có quyền');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassUpdateRequest $request, $id)
    {
        $class = $this->class->find($id);
        $class->update([
            'name' => $request->name
        ]);
        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->checkRole(12)) {
            $this->class->find($id)->delete();
            return response()->json([
                'result' => true
            ]);
        }
        return response()->json([
            'error' => false
        ], 403);
    }
}