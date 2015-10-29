<?php

class TasksController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function get_tasks()
	{
		$tasks = Auth::user()->tasks;

		return View::make('index', array('tasks' => $tasks));
	}

	public function post_add_new()
	{
		$data = Input::all();

		$UserValidation = Validator::make( Input::all(), array('new' => 'required|max:100') );

		if(!$UserValidation->fails()){
			$user_id = Auth::id();

			$task = new Tasks;

			$task->task_name = $data['new'];
			$task->user_id = $user_id;
			$task->created_at = new DateTime;

			$task->save();

			$tasks = Auth::user()->tasks;
			$response=$tasks;

			return $response;
		}
	}

	public function post_remove_task()
	{
		$data = Input::all();

		$user_id = Auth::id();
		
		$task = Tasks::where('id', $data['remove_task'])
			->where('user_id', Auth::id())
			->delete();

		return Response::json();
	}

	public function post_check_task()
	{
		$data = Input::all();
		
		Tasks::where(array( 'id' => $data['check_task'],'user_id'=> Auth::id()) )
            ->update(array('status' => 1, 'updated_at' => new DateTime));

        $updated_task = Tasks::where( array('id' => $data['check_task'],'user_id'=> Auth::id()) )->first();

		return array('task_name' => $updated_task->task_name);
	}

	public function post_uncheck_task()
	{
		$data = Input::all();
		
		Tasks::where( array('id' => $data['uncheck_task'], 'user_id'=> Auth::id()) )
            ->update(array('status' => 0, 'updated_at' => new DateTime));
        
        $updated_task = Tasks::where( array('id' => $data['uncheck_task'],'user_id'=> Auth::id()) )->first();

		return array('task_name' => $updated_task->task_name);
	}
}
