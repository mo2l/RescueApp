<!-- Own style -->
<link href="{{ asset('css/lightgallery.css') }}" rel="stylesheet" type="text/css" />
<!-- Table - OPEN -->
<table class="table dt-responsive table-hover text-center" id="tasks">

    <!-- Table header - OPEN -->
    <thead>
        <tr class="bg-light">
            <th scope="col"> {{ __('forms.sector') }} </th>
            <th scope="col"> {{ __('forms.status') }} </th>
            <th scope="col"> {{ __('forms.task_group') }} </th>
            <th scope="col"> {{ __('forms.task_start') }} </th>
            <th scope="col"> {{ __('forms.task_end') }} </th>
            <th scope="col"> {{ __('forms.task_type') }} </th>
            <th scope="col"> {{ __('forms.description') }} </th>
            <th scope="col"> {{ __('forms.gpx') }} </th>
            <th scope="col"> {{ __('forms.actions') }} </th>
        </tr>
    </thead>
    <!-- Table header - CLOSE -->

    <!-- Table content - OPEN -->
    <tbody>
    @foreach ($tasks as $task)
        <tr>

            <td class="align-middle">
                {{ $task->Sector }}
            </td>

            <td class="align-middle">
                @if($task->Status == "to_do")
                    <div class="ml-3" value="To do" style="border-radius: 3px; width: 30px; height: 30px; background-color: #d9534f;">
                            <div style="visibility: hidden;">To do</div>
                    </div>
                @elseif($task->Status == "in_progress")
                    <div class="ml-3" value="In progress" style="border-radius: 3px; width: 30px; height: 30px; background-color: #f0ad4e;">
                            <div style="visibility: hidden;">In Progress</div>
                    </div>
                @else
                    <div class="ml-3" value="Done" style="border-radius: 3px; width: 30px; height: 30px; background-color: #5cb85c;">
                            <div style="visibility: hidden;">Done</div>
                    </div>
                @endif
            </td>

            <td class="align-middle">
            	<div> Group 
                    {{ $task->Group }}
                </div>
            </td>

            <td class="align-middle">
                @if ($task->Start == NULL)
                    --
                @else
                    @php
                        $date = new Date($task->Date);
                        echo $date->format('H:i');
                    @endphp
                @endif
            </td>

            <td class="align-middle">
                @if ($task->End == NULL)
                    --
                @else
                    @php
                        $date = new Date($task->End);
                        echo $date->format('H:i');
                    @endphp
                @endif
            </td>

            <td class="align-middle">
            	{{ $task->Type }}
            </td>

            <td class="align-middle">
                <!-- Show Desctiption - OPEN -->
                @include('searches.tasks.buttons.show_description')
            </td>

            <td class="align-middle">
                @if($task->Gpx == 0)
            	<div class="ml-2" style="border-radius: 3px; width: 30px; height: 30px; background-color: #d9534f;">
                </div>
                @else
                <div class="ml-2" style="border-radius: 3px; width: 30px; height: 30px; background-color: #5cb85c;">
                </div>
                @endif
            </td>

            <td class="align-middle">
                <!-- Edit incident - OPEN -->
                @include('searches.tasks.buttons.edit_task')
                <!-- Edit incident - OPEN -->

                <!-- Delete incident - OPEN -->
                @include('searches.tasks.buttons.delete_task')
                <!-- Delete incident - OPEN -->
            </td>
        </tr>
    @endforeach
    </tbody>
    <!-- Table content - CLOSE -->

</table>
<!-- Table - CLOSE -->
<script src="{{ asset('js/fresco.min.js') }}"></script>
<link href="{{ asset('css/fresco.css') }}" rel="stylesheet" type="text/css" />

<!-- JS -->
<script>

    $(document).ready(function() {
        // settings tables
        $.extend( $.fn.dataTable.defaults, {
            "scrollX": true,
            "scrollY": true,
            "pagingType": "full_numbers",
            "responsive": true,
            "order": [ 0, "desc" ],
            "language": {
                "decimal":        "",
                "emptyTable":     "{{ __('tables.emptyTable') }}",
                "info":           "{{ __('tables.info') }}",
                "infoEmpty":      "{{ __('tables.infoEmpty') }}",
                "infoFiltered":   "{{ __('tables.infoFiltered') }}",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "{{ __('tables.lengthMenu') }}",
                "loadingRecords": "{{ __('tables.loadingRecords') }}",
                "processing":     "{{ __('tables.processing') }}",
                "search":         "{{ __('tables.search') }}",
                "zeroRecords":    "{{ __('tables.zeroRecords') }}",
                "paginate": {
                    "first":      "{{ __('tables.first') }}",
                    "last":       "{{ __('tables.last') }}",
                    "next":       "{{ __('tables.next') }}",
                    "previous":   "{{ __('tables.previous') }}",
                },
                "aria": {
                    "sortAscending":  "{{ __('tables.sortAscending') }}",
                    "sortDescending": "{{ __('tables.sortDescending') }}",
                }
            }
        });

        // initialize tables
        var task_table = $('#tasks').removeAttr('width').DataTable();
    
        $('#typeFilter').on('change', function(){
            task_table.columns(5).search(this.value).draw();   
        });

        $('#groupFilter').on('change', function(){
            task_table.columns(2).search(this.value).draw();
        });

        $('#statusFilter').on('change', function(){
            task_table.columns(1).search(this.value).draw();
        });

        // resize tables after tab
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script>
