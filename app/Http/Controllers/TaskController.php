<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->detail = $request->input('detail');
        $task->due_date = Carbon::create($request->input('due_date'));

        $task->user_id = $request->user()->id;
//        $task->user_id = Auth::id();
//        $task->user_id = Auth::user()->id;
        $task->save();


        $tags = trim($request->input('tags'));
        $this->updateTaskTag($task, $tags);

        return redirect()->route('tasks.index');
    }

    private function updateTaskTag($task, $tagsWithComma) {
        if ($tagsWithComma) {
            $tag_array = [];
            $tags = explode(",", $tagsWithComma);
            foreach($tags as $tag_name) {
                $tag_name = trim($tag_name);
                if ($tag_name) {
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    array_push($tag_array, $tag->id);
                }
            }
            $task->tags()->sync($tag_array);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $task->title = $request->input('title');
        $task->detail = $request->input('detail');
        $task->due_date = Carbon::create($request->input('due_date'));
        $task->save();
        $tags = trim($request->input('tags'));
        $this->updateTaskTag($task, $tags);
        return redirect()->route('tasks.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
