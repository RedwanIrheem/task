<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class TaskController extends Controller
{
    public function __construct()
    {
        //
    }
    ///////////////////////////////////////////
    public function getAllTask()
    {
        $info = Task::all();
        return response()->json(['status' => true, 'message' => 'Success, Show Successfully', 'errors' => null, 'task' => $info]);
    }
    ///////////////////////////////////////////
    public function getTaskById($id)
    {
        $info =  Task::find($id);
        if ($info == null)
        {
            return response()->json(['status' => true, 'message' => 'Invalid Task', 'errors' => null, 'task' => $info]);
        }
        else
        {
            return response()->json(['status' => true, 'message' => 'Success, Operation successfully', 'errors' => null, 'task' => $info]);
        }
    }
    ///////////////////////////////////////////
    public function postAdd(Request $request)
    {
//        dd(123);
//        $user = JWTAuth::parseToken()->authenticate();
        $name = $request->get('name');
        $due = $request->get('due');
        $status = $request->get('status');

        $validator = Validator::make([
            'name' => $name,
            'due' => $due,
            'status' => $status,
        ], [
            'name' => 'required',
            'due' => 'required',
            'status' => 'required',
        ]);
        /////////////////////////////////////////
        if ($validator->fails())
        {
            return response()->json(['status' => false, 'message' => 'Error, Error Validation', 'errors' => $validator->messages(), 'task' => null]);
        }
        else
        {
            $task = new Task();
            $add = $task->addTask($name, $due, $status);

            if ($add)
            {
                return response()->json(['status' => true, 'message' => 'Success, Insert Successfully', 'errors' => null, 'task' => $add]);
            }
            else
            {
                return response()->json(['status' => false, 'message' => 'Error, Error Inserting', 'errors' => null, 'task' => null]);
            }
        }
    }
    //////////////////////////////////////////////////
    public function postUpdate(Request $request)
    {
        $tasks = new Task();
//        $user = JWTAuth::parseToken()->authenticate();
        $task = Task::find($request->id);

        //////////////////////////////////////////////
        if (!$task)
        {
            return response()->json(['status' => 'Error', 'message' => 'Invalid Task'], 200);
        }
        ///////////////////////////////////
        if ($task)
        {
            $name = $request->get('name');
            $due = $request->get('due');
            $status = $request->get('status');

            $validator = Validator::make([
                'name' => $name,
                'due' => $due,
                'status' => $status,

            ], [
                'name' => 'required',
                'due' => 'required',
                'status' => 'required',

            ]);
            ///////////////////////////////////
            if ($validator->fails())
            {
                return response()->json(['status' => false, 'message' => 'Error, Error Validation', 'errors' => $validator->messages(), 'task' => null]);
            }
            else
            {
                $update = $tasks->updateTask($task, $name, $due, $status);

                if ($update)
                {
//                    return $this->getAuthUser($request);
                    return response()->json(['status' => True, 'message' => 'Success, Update Successfully', 'errors' => Null, 'task' => $update]);
                }
                else
                {
                    return response()->json(['status' => false, 'message' => 'Error, Error Updating', 'errors' => null, 'task' => null]);
                }
            }
        }
        else
        {
            return response()->json(['status' => false, 'message' => 'Not Found', 'errors' => null, 'task' => null]);
        }
    }

    /////////////////////////////////////////////////
    public function postDelete($id)
    {
        $tasks = new Task();
//        $task = Task::find($request->id);

        $task = $tasks->getTask($id);
        if ($task)
        {
            $delete = $tasks->deleteTask($task);
            if ($delete)
            {
                return response()->json(['status' => True, 'message' => 'Success, Delete Successfully', 'errors' => Null, 'task' => $delete, 'info' => $task]);
            }
            else
            {
                return response()->json(['status' => False, 'message' => 'Error, Error Deleting', 'errors' => Null, 'task' => Null]);
            }
        }
        else
            {
            return response()->json(['status' => False, 'message' => 'Not Found', 'errors' => Null, 'task' => Null]);
        }
    }

}