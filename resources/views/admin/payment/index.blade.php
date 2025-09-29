<div class="card h-min-600">
    <div class="card-body">
        <div class="box">
            <div class="box-body">
                <div class="d-flex justify-content-between my-1">
                    <a href="/admin/payment/create" class="me-1 nowrap">
                        <button class="btn btn-primary">+新增</button>
                    </a>
                </div>
                <div class="table-push">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>显示名称</th>
                            <th>支付接口</th>
                            <th>通知地址</th>
                            <th class="text-end">操作</th>
                        </tr>

                        </thead>

                        <tbody>

                        @foreach($payments as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->payment}}</td>
                                <td>{{$cat->notify_url}}</td>
                                <td>
                                    <button class="btn btn-info" data-id={{$cat->id}} data-toggle="modal"
                                            data-target="#edit">Edit
                                    </button>
                                    /
                                    <button class="btn btn-danger" data-id={{$cat->id}} data-toggle="modal"
                                            data-target="#delete">Delete
                                    </button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



