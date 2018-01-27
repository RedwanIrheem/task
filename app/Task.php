<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'list', 'archived', 'due', 'pkey', 'account', 'created', 'status',
    ];
    /////////////////////////////////////////////
    public function addTask($name, $list, $archived, $due, $pkey, $account, $created, $status)
    {
        $this->name = $name;
        $this->list = $list;
        $this->archived = $archived;
        $this->due = $due;
        $this->pkey = $pkey;
        $this->account = $account;
        $this->created = $created;
        $this->status = $status;

        $this->save();
        return $this;
    }
    /////////////////////////////////////////////
    public function updateTask($obj, $name, $list, $archived, $due, $pkey, $account, $created, $status)
    {
        $obj->name = $name;
        $obj->list = $list;
        $obj->archived = $archived;
        $obj->due = $due;
        $obj->pkey = $pkey;
        $obj->account = $account;
        $obj->created = $created;
        $obj->status = $status;

        $obj->save();
        return $obj;
    }
    /////////////////////////////////////////////
    public function getTask($id)
    {
        return $this->find($id);

    }
    /////////////////////////////////////////////
    public function deleteTask($obj)
    {
        return $obj->delete();
    }
    /////////////////////////////////////////////
    function getAllTask()
    {
        return $this::paginate(5);
    }
    /////////////////////////////////////////////
    function getPkey($pkey)
    {
        return $this->where('pkey', '=', $pkey)->first();
    }
}
