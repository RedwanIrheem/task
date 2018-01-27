@extends("layouts.layout")
@section("content")
    <div class="row">
        <div class="col-sm-12">
            <div class="element-wrapper">
                <div class="element-actions">
                    <form class="form-inline justify-content-sm-end">
                        <select class="form-control form-control-sm rounded">
                            <option value="Pending">
                                Today
                            </option>
                            <option value="Active">
                                Last Week
                            </option>
                            <option value="Cancelled">
                                Last 30 Days
                            </option>
                        </select>
                    </form>
                </div>
                <h6 class="element-header">
                    Sales Dashboard
                </h6>
                <div class="element-content">
                    <div class="row">
                        <div class="col-sm-4">
                            <a class="element-box el-tablo" href="#">
                                <div class="label">
                                    Products Sold
                                </div>
                                <div class="value">
                                    57
                                </div>
                                <div class="trending trending-up-basic">
                                    <span>12%</span><i class="os-icon os-icon-arrow-up2"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="element-box el-tablo" href="#">
                                <div class="label">
                                    Gross Profit
                                </div>
                                <div class="value">
                                    $457
                                </div>
                                <div class="trending trending-down-basic">
                                    <span>12%</span><i class="os-icon os-icon-arrow-down"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="element-box el-tablo" href="#">
                                <div class="label">
                                    New Customers
                                </div>
                                <div class="value">
                                    125
                                </div>
                                <div class="trending trending-down-basic">
                                    <span>9%</span><i class="os-icon os-icon-arrow-down"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.error')
    <div class="row">
        <div class="col-sm-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                    TASKS
                </h6>
                <div class="element-box-tp">
                    <div class="controls-above-table">
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-sm btn-secondary" href="{{ route('tasks.get') }}">Sync</a>
                                <a class="btn btn-sm btn-secondary" href="{{ route('task.add') }}">Add</a>
                                {{--<a class="btn btn-sm btn-secondary" href="#">Archive</a>--}}
                                {{--<a class="btn btn-sm btn-danger" href="#">Delete</a>--}}
                            </div>
                            <div class="col-sm-6">
                                <form class="form-inline justify-content-sm-end">
                                    <input class="form-control form-control-sm rounded bright"
                                           placeholder="Search" type="text"><select
                                            class="form-control form-control-sm rounded bright">
                                        <option selected="selected" value="">
                                            Select Status
                                        </option>
                                        <option value="Pending">
                                            Pending
                                        </option>
                                        <option value="Active">
                                            Active
                                        </option>
                                        <option value="Cancelled">
                                            Cancelled
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-lg table-v2 table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    <input class="form-control" type="checkbox">
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    List
                                </th>
                                <th>
                                    DUE
                                </th>
                                <th>
                                    PKey
                                </th>
                                <th>
                                    Account
                                </th>
                                <th>
                                    Created
                                </th>
                                <th>
                                    status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($task as $row)
                                <tr>
                                    <td class="text-center">
                                        <input class="form-control" type="checkbox">
                                    </td>
                                    <td>
                                        {{ $row->name }}
                                    </td>
                                    <td>
                                        {{ $row->list }}
                                    </td>
                                    <td class="text-right">
                                        {{ $row->due }}
                                    </td>
                                    <td>
                                        {{ $row->pkey }}
                                    </td>
                                    <td>
                                        {{ $row->account }}
                                    </td>
                                    <td>
                                        {{ $row->created }}
                                    </td>
                                    <td class="text-center">
                                        @if($row->status == 1)
                                            <div class="status-pill green" data-title="Enable" data-toggle="tooltip"></div>
                                        @else
                                            <div class="status-pill red" data-title="Disable" data-toggle="tooltip"></div>
                                        @endif
                                    </td>
                                    <td class="row-actions">
                                        <a href="{{ route('task.edit',[ 'id' => Crypt::encrypt($row->id)]) }}"><i class="os-icon os-icon-ui-49"></i></a>
                                        <a href="{{ route('task.delete',[ 'id' => Crypt::encrypt($row->id)]) }}"><i class="os-icon os-icon-ui-15"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="controls-below-table">
                <div class="table-records-info">
                    Showing records 1 - 5
                </div>
                    <div class="table-records-pages">
                        <ul>
                            <li>
                                {{ $task->links() }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{--<div class="modal fade" id="myModal" role="dialog">--}}
        {{--<div class="modal-dialog">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">Delete Task</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<p>Do you want to delete this task?!</p>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--                                                <a href="{{ route('task.delete',[ 'id' => Crypt::encrypt($row->id)]) }}"><i class="os-icon os-icon-ui-15"></i></a>--}}
                    {{--<button type="submit" href="{{ route('task.delete',[ 'id' => Crypt::encrypt($row->id)]) }}" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
@stop
@section('js')
@stop