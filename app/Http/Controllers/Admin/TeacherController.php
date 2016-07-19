<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherFormRequest;
use App\Models\Teacher\Label;
use App\Models\Teacher\Level;
use App\Models\User\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate();

        return $this->backView('backend.admins.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->backView('backend.admins.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherFormRequest|Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(TeacherFormRequest $request)
    {
        try {
            \DB::transaction(function() use ($request) {
                $teacher = new Teacher();
                $teacher->fill($request->all())->save();

                /* If have levels */
                if ($levels = $request->input('levels')) {
                    $teacher->levels()->sync($levels);
                }

                /* If have labels */
                if ($labels = $request->input('labels')) {
                    $existingLabels = Label::lists('name');

                    /* If have new labels */
                    $newLabels = collect($labels)->diff($existingLabels);
                    foreach ($newLabels as $newLabel) {
                        Label::create(['name' => $newLabel]);
                    }

                    $labelIds = Label::whereIn('name', $labels)->lists('id')->all();
                    $teacher->labels()->sync($labelIds);
                }
            });
        } catch (\Exception $e) {
            // TODO write to logs and notify
        }

        \Flash::success('添加成功');
        return redirect()->route('admins::teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        return $this->backView('backend.admins.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);

        return $this->backView('backend.admins.teachers.edit', compact('teacher'));
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
        //
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
