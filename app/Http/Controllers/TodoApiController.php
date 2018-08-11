<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Http\Resources\Todo as TodoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TodoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TodoResource::collection(Todo::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TodoResource|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if($validator->fails()){
            return $this->validationErrors($validator);
        }

        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->save();

        return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return TodoResource|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:todos'
        ]);

        if($validator->fails()){
            return $this->validationErrors($validator);
        }

        return new TodoResource(Todo::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return TodoResource|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:todos',
            'title' => 'required',
            'body' => 'required',
        ]);

        if($validator->fails()){
            return $this->validationErrors($validator);
        }

        $todo = Todo::find($request->input('id'));
        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->save();

        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return TodoResource|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:todos'
        ]);

        if($validator->fails()){
            return $this->validationErrors($validator);
        }

        $todo = Todo::find($id);
        $todo->delete();

        return new TodoResource($todo);
    }

    /**
     * Return validator errors
     *
     * @param $validator
     * @return \Illuminate\Http\Response
     */
    private function validationErrors($validator)
    {
        return Response::make([
            'errors' => $validator->errors()
        ]);
    }
}
