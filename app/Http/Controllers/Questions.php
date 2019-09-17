<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Question;

class Questions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get post request data for question, category and level
        $data = $request->only(["question", "category", "level"]);

        // create question with data and store in DB
        $question = Question::create($data);

        // return the question along with a 201 status code
        return response($question, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Question::find($id);
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
        // find the current question
        $question = Question::find($id);

        // get the request data
        $data = $request->only(["question", "category", "level"]);

        // update the question
        $question->fill($data)->save();

        // return the updated version
        return $question;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();

        // use a 204 code as there is no content in the response
        return response(null, 204);
    }
}
