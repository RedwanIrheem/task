<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Validator;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    const INSERT_SUCCESS_MESSAGE = "Success, Insert Successfully";
    const EXECUTION_ERROR = "Error, Operation Error";
    const NOT_FOUND = "Error, Data not found";
    const UPDATE_SUCCESS = "Success, Update Successfully";
    const DELETE_SUCCESS = "Success, Delete Successfully";

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        return view("home.index");
    }

    public function getAllTask()
    {
        try
        {
            $http = new Client(['headers' => [
                'Accept' => 'application/json',
                'Authorization' => parent::$data['key'],
                'allow_redirects' => false
            ]]);
            //////////////////////////////////////////////
            $request = $http->get('http://capi.tokeet.com/v1/task?account=' . parent::$data['account']);
            $result = json_decode($request->getBody()->getContents(),true);
//            print_r($result);
            //$result['token'] = $final;
            //echo $result = json_encode($result);
            //echo json_decode($result,true);

//            return $result;
            foreach ($result['data'] as $row)
            {
                if (isset($row['status']))
                {
                    $status = $row['status'];
                }
                else
                {
                    $status = 1;
                }
                ///////////////////////////////////

                $task = new Task();
                $info = $task->getPkey($row['pkey']);
                if (!$info)
                {
                    $task = new Task();
                    $task->addTask($row['name'], $row['list'], $row['archived'], $row['due'], $row['pkey'], $row['account'], $row['created'], $status);
                }
            }
            return redirect('/');

        }
        catch(ClientException $exception)
        {
            return json_decode((string) $exception->getResponse()->getBody(), true);
        }
    }

    public function getTask()
    {
        $tasks = new Task();
        parent::$data['task'] = $tasks->getAllTask();

        return view('home.index', parent::$data);
    }

    public function getAdd()
    {
        return view("home.add");
    }

    public function postAdd(Request $request)
    {
        $name = $request->get('name');
        $list = $request->get('list');
        $archived = $request->get('archived');
        $due = $request->get('due');
        $pkey = $request->get('pkey');
        $account = $request->get('account');
        $created = $request->get('created');
        $status = (int)$request->get('status');

        $validator = Validator::make([
            'name' => $name,
            'list' => $list,
            'archived' => $archived,
            'due' => $due,
            'pkey' => $pkey,
            'account' => $account,
            'created' => $created,
            'status' => $status
        ], [
            'name' => 'required',
            'list' => 'required',
            'archived' => 'required|numeric',
            'due' => 'required|numeric',
            'pkey' => 'required',
            'account' => 'required',
            'created' => 'required|numeric',
            'status' => 'required|numeric|in:0,1'
        ]);
        //////////////////////////////////////////////////////////
        if ($validator->fails())
        {
            $request->session()->flash('danger', $validator->messages());
            return redirect(route('task.add'))->withInput();
        }
        else
        {
            $task = new Task();
            $add = $task->addTask($name, $list, $archived, $due, $pkey, $account, $created, $status);
            if ($add)
            {
                $request->session()->flash('success', self::INSERT_SUCCESS_MESSAGE);
                return redirect(route('task.index'));
            }
            else
            {
                $request->session()->flash('danger', self::EXECUTION_ERROR);
                return redirect(route('task.add'))->withInput();
            }
        }
    }
    //////////////////////////////////////////
    public function getEdit(Request $request, $id)
    {
        try
        {
            $id = Crypt::decrypt($id);
        }
        catch (DecryptException $e)
        {
            $request->session()->flash('danger', self::NOT_FOUND);
            return redirect(route('home.index'));
        }
        /////////////////////////////
        $task = new Task();
        $info = $task->getTask($id);
        if ($info)
        {
            parent::$data['info'] = $info;
            return view('home.edit', parent::$data);
        }
        else
        {
            $request->session()->flash('danger', self::NOT_FOUND);
            return redirect(route('home.index'));
        }
    }
//////////////////////////////////////////////
    public function postEdit(Request $request, $id)
    {
        try
        {
            $encrypted_id = $id;
            $id = Crypt::decrypt($id);
        }
        catch (DecryptException $e)
        {
            $request->session()->flash('danger', self::NOT_FOUND);
            return redirect(route('home.index'));
        }
        /////////////////////////////////////////
        $task = new Task();
        $info = $task->getTask($id);
        if ($info)
        {
            $name = $request->get('name');
            $list = $request->get('list');
            $archived = $request->get('archived');
            $due = $request->get('due');
            $pkey = $request->get('pkey');
            $account = $request->get('account');
            $created = $request->get('created');
            $status = (int)$request->get('status');

            $validator = Validator::make([
                'name' => $name,
                'list' => $list,
                'archived' => $archived,
                'due' => $due,
                'pkey' => $pkey,
                'account' => $account,
                'created' => $created,
                'status' => $status
            ], [
                'name' => 'required',
                'list' => 'required',
                'archived' => 'required|numeric',
                'due' => 'required|numeric',
                'pkey' => 'required',
                'account' => 'required',
                'created' => 'required|numeric',
                'status' => 'required|numeric|in:0,1'
            ]);
            //////////////////////////////////////////////////////////
            if ($validator->fails())
            {
                $request->session()->flash('danger', $validator->messages());
                return redirect(route('menus.edit', ['id' => $encrypted_id]))->withInput();
            }
            else
            {
                $update = $task->updateTask($info, $name, $list, $archived, $due, $pkey, $account, $created, $status);
                if ($update)
                {
                    $request->session()->flash('success', self::UPDATE_SUCCESS);
                    return redirect(route('task.index'));
                }
                else
                {
                    $request->session()->flash('danger', self::EXECUTION_ERROR);
                    return redirect(route('task.edit', ['id' => $encrypted_id]))->withInput();
                }
            }
        }
        else
        {
            $request->session()->flash('danger', self::NOT_FOUND);
            return redirect(route('task.index'));
        }
    }
    ////////////////////////////////////////////////
    public function postDelete(Request $request, $id)
    {
        try
        {
            $id = Crypt::decrypt($id);
        }
        catch (DecryptException $e)
        {
            $request->session()->flash('danger', self::NOT_FOUND);
            return redirect(route('task.index'));
        }
        /////////////////////////////////////
        $task = new Task();
        $info = $task->getTask($id);
        if ($info)
        {
            $delete = $task->deleteTask($info);
            if ($delete)
            {
                $request->session()->flash('success', self::DELETE_SUCCESS);
                return redirect(route('task.index'));
            }
            else
            {
                $request->session()->flash('danger', self::NOT_FOUND);
                return redirect(route('task.index'));
            }
        }
        else
        {
            $request->session()->flash('danger', self::EXECUTION_ERROR);
            return redirect(route('task.index'));
        }
    }
}
