<div class="modal modal-right fade preview_salary_generate_modal show" id="view-salary-list-modal" style="padding-right: 7px;" aria-modal="true">
    <div class="modal-dialog" style="min-width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title preview_salary_generate_title">Salary List: <b class="text-danger" id="salary_month_year"></b> &amp; Total Amount: <b class="text-success" id="total_salary"></b></h5>
                <button type="button" class="close text-danger" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body preview_salary_generate_body" style="overflow-x: hidden;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <div id="data-table-view-salary-list_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="data-table-view-salary-list_length">
                                            <label>Show
                                                <select name="data-table-view-salary-list_length" aria-controls="data-table-view-salary-list" class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="data-table-view-salary-list_filter" class="dataTables_filter">
                                            <label>Search:
                                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="data-table-view-salary-list"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="data-table-view-salary-list" class="table table-sm table-bordered table-hover display nowrap margin-top-10 w-p100 dataTable no-footer" style="white-space: nowrap; width: 0px;" role="grid" aria-describedby="data-table-view-salary-list_info">
                                            <thead>
                                           <tr>
                                               <th>Employee</th>
                                               <th>Department</th>
                                               <th>JD</th>
                                               <th>TP</th>
                                               <th>BMS</th>
                                               <th>PD</th>
                                               <th>FDL</th>
                                               <th>HDL</th>
                                               <th>I & D</th>
                                               <th>PB</th>
                                               <th>MA</th>
                                               <th>FB</th>
                                               <th>AS</th>
                                               <th>GTS</th>
                                               <th>SPM</th>
                                               <th>Received</th>
                                           </tr>
                                            </thead>
                                            <tbody id="view_salary_list">

                                            </tbody>
                                        </table>
                                    </div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="data-table-view-salary-list_info" role="status" aria-live="polite">Showing 1 to 7 of 7 entries (filtered from 25 total entries)</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="data-table-view-salary-list_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="data-table-view-salary-list_previous"><a href="#" aria-controls="data-table-view-salary-list" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="data-table-view-salary-list" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="data-table-view-salary-list_next"><a href="#" aria-controls="data-table-view-salary-list" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                        </div>
                    </div>
                </div>
                <script>
                    var table = $('#data-table-view-salary-list').DataTable({
                        "paging"			: true,
                        "lengthChange"		: true,
                        "lengthMenu"		: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                        "searching"			: true,
                        "ordering"			: true,
                        "order"				: [[ 0, "asc" ]],
                        "info"				: true,
                        "autoWidth"			: true,
                        "responsive"		: false,
                        "ScrollX"			: true,
                        "processing"		: false,
                        "serverSide"		: true,
                        "ajax"				: {
                            url			: "http://erp.mahfuza-overseas.com/mahfuza_v2/home-pages/human-resource/payroll-salary-generate?data-table-view-salary-list=active&salary-id=24",
                            type		: 'POST',
                            beforeSend	: function(){ $.skylo('start'); },
                            complete	: function(){ $.skylo('end');
                                $('#data_list tr').each(function(){
                                    $(this).find('td').each(function(){
                                        $(this).css({"width": $(this).width() + "px"});
                                    });
                                });
                            }
                        },
                        "language"			: {
                            "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
