<?php

namespace App\Http\Controllers;

use App\Task;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    /**
     * タスクリポジトリインスタンス
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * 新しいコントローラーインスタンスの生成
     * TasksController constructor.
     * @param TaskRepository $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /**
     * ユーザーの全タスク表示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('tasks', [
            'tasks' => $this->tasks->foruser($request->user()),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
           'name' => $request->name
        ]);

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
       return redirect('/tasks');
    }

}
