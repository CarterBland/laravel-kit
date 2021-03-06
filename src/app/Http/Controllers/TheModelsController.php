<?php

namespace App\Http\Controllers;

use App\Http\Requests\TheModelRequest;
use App\Services\TheModelCrud;
use App\TheModel;
use Illuminate\Http\Request;
use Spatie\Permission\Model\Role;
use Yajra\DataTables\Html\Builder;

class TheModelsController extends Controller
{
    public function __construct(TheModelCrud $theModelHandler)
    {
        $this->theModelHandler = $theModelHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', TheModel::class);

        $models = TheModel::all();

        return view('models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', TheModel::class);

        return view('models.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TheModelRequest $request)
    {
        $this->authorize('create', TheModel::class);

        $model = $this->theModelHandler->create($request);

        return redirect()->route('models.show', $model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TheModel $model)
    {
        $this->authorize('view', $model);

        return view('models.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TheModel $model)
    {
        $this->authorize('update', $model);

        return view('models.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TheModelRequest $request, TheModel $model)
    {
        $this->authorize('update', $model);

        $model = $this->theModelHandler->update($request, $model);

        return redirect()->back()->with('success', 'TheModel Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheModel $model)
    {
        $this->authorize('delete', $model);

        $model->delete();

        return $model;
    }
}
