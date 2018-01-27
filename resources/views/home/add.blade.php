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
    <div class="row">
        <div class="col-sm-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Add New Task
                </h6>
                <div class="element-box-tp">
                    <div class="controls-above-table">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    @include('layouts.error')
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="usr">Name:</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">List:</label>
                                            <input type="text" class="form-control" name="list" value="{{ old('list') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Archived:</label>
                                            <input type="text" class="form-control" name="archived" value="{{ old('archived') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Due:</label>
                                            <input type="text" class="form-control" name="due" value="{{ old('due') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Pkey:</label>
                                            <input type="text" class="form-control" name="pkey" value="{{ old('pkey') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Account:</label>
                                            <input type="text" class="form-control" name="account" value="{{ old('account') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Created:</label>
                                            <input type="text" class="form-control" name="created" value="{{ old('created') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Status:</label>
                                            <select class="form-control bs-select" name="status" >
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable</option>
                                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Disable</option>
                                            </select>
                                        </div>
                                        <h6 class="element-header">
                                        </h6>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop