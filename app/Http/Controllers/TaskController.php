<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskController extends Controller{

    private $model;
    public function __construct(TaskRepository $task) 
	{
		$this->task = $task;
	}
 
	/**
	 * Get all tasks.
	 *
	 * @return Illuminate\View
	 */
	public function getAllTasks($id = null)
	{
		$tasks = $this->task->getAll();
		$editTask = (isset($id)) ? $this->task->getById($id) : null;
 
		return view('tasks.index', compact('tasks', 'editTask'));
	}
 
	/**
	 * Store a task
	 *
	 * @var array $attributes
	 *
	 * @return mixed
	 */
	public function postStoreTask(Request $request)
	{
		$attributes = $request->only(['description']);
		$this->task->create($attributes);
 
		return redirect()->route('task.index');
	}
 
	/**
	 * Update a task
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function postUpdateTask($id, Request $request)
	{
		$attributes = $request->only(['description']);
		$this->task->update($id, $attributes);
 
		return redirect()->route('task.index');
	}
 
	/**
	 * Delete a task
	 *
	 * @var integer $id
	 *
	 * @return mixed
	 */
	public function postDeleteTask($id)
	{
		$this->task->delete($id);
 
		return redirect()->route('task.index');
	}
}