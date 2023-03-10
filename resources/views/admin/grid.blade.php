<div class="box">
    <div class="box-header">

        <h3 class="box-title"></h3>

        <div class="pull-right">
            {{--{!! $grid->renderFilter() !!}--}}
            {!! $grid->renderExportButton() !!}
            {!! $grid->renderCreateButton() !!}
        </div>

        <span>
            {!! $grid->renderHeaderTools() !!}
        </span>

    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                @foreach($grid->columns() as $column)
                    <th style="white-space: nowrap;">
                        {{$column->getLabel()}}
                        {!! $column->sorter() !!}
                    </th>
                @endforeach
            </tr>

            <tr>
                {!! $grid->renderFilter() !!}
            </tr>

            @foreach($grid->rows() as $row)
                <tr {!! $row->getHtmlAttributes() !!}>
                    @foreach($grid->columnNames as $name)
                        <td>{!! $row->column($name) !!}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>
    </div>
    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
    <!-- /.box-body -->
</div>
