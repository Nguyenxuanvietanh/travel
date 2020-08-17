<div class="panel panel-default">
    <div class="panel-heading">Booking Management</div>
    <div class="panel-body">
        <link href="http://travel.local/assets/xcrud/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"
            type="text/css">
        <link href="http://travel.local/assets/xcrud/plugins/jcrop/jquery.Jcrop.min.css" rel="stylesheet"
            type="text/css">
        <link href="http://travel.local/assets/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet"
            type="text/css">
        <link href="http://travel.local/assets/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">
        <div class="xcrud">
            <div class="xcrud-container">
                <div class="xcrud-ajax">
                    <input type="hidden" class="xcrud-data" name="key"
                        value="8684a9665c348d23428da07cd094abc861dcdb41"><input type="hidden" class="xcrud-data"
                        name="orderby" value="pt_bookings.booking_id"><input type="hidden" class="xcrud-data"
                        name="order" value="desc"><input type="hidden" class="xcrud-data" name="start" value="0"><input
                        type="hidden" class="xcrud-data" name="limit" value="50"><input type="hidden" class="xcrud-data"
                        name="instance" value="b114b89d4f31ac9870f850904b24eae0b0a569bd"><input type="hidden"
                        class="xcrud-data" name="task" value="list">
                    <div class="xcrud-top-actions">
                        <div class="btn-group pull-right">

                            <a href="javascript:;" data-task="print"
                                class="btn btn-default xcrud-in-new-window xcrud-action"><i
                                    class="glyphicon glyphicon-print"></i> Print</a><a href="javascript:;"
                                data-task="csv" class="btn btn-default xcrud-in-new-window xcrud-action"><i
                                    class="glyphicon glyphicon-file"></i> Export into CSV</a> </div>
                        <div class="clearfix"></div>
                        <a href="javascript: multiDelfunc('http://travel.local/admin/bookings/delMultipleBookings', 'checkboxcls')"
                            class="delete_button btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i>
                            Delete Selected</a>
                    </div>

                    <div class="xcrud-list-container">
                        <table class="xcrud-list table table-striped table-hover">
                            <thead>
                                <tr class="xcrud-th">
                                    <th>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="all" type="checkbox" value="" id="select_all"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </th>
                                    <th class="xcrud-num">#</th>
                                    <th data-order="asc" data-orderby="pt_bookings.booking_id"
                                        class="xcrud-column xcrud-action xcrud-current xcrud-desc">↓ ID</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_ref_no"
                                        class="xcrud-column xcrud-action">Ref No.</th>
                                    <th data-order="desc" data-orderby="pt_accounts.ai_first_name"
                                        class="xcrud-column xcrud-action">Customer</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_type"
                                        class="xcrud-column xcrud-action">Module</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_date"
                                        class="xcrud-column xcrud-action">Date</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_total"
                                        class="xcrud-column xcrud-action">Total</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_amount_paid"
                                        class="xcrud-column xcrud-action">Paid</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_remaining"
                                        class="xcrud-column xcrud-action">Remaining</th>
                                    <th data-order="desc" data-orderby="pt_bookings.booking_status"
                                        class="xcrud-column xcrud-action">Status</th>
                                    <th class="xcrud-actions">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="xcrud-row xcrud-row-0">
                                    <td>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="checkboxcls" type="checkbox" value="6"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="xcrud-current xcrud-num">1</td>
                                    <td class="xcrud-current">6</td>
                                    <td>5013</td>
                                    <td>Johny</td>
                                    <td>hotels</td>
                                    <td>07/03/2019</td>
                                    <td>2288</td>
                                    <td>0</td>
                                    <td>2288</td>
                                    <td><span class="btn btn-xs btn-info">Unpaid</span></td>
                                    <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a
                                                class="btn btn-default btn-xcrud btn btn-primary"
                                                href="http://travel.local/invoice/?id=6&amp;sessid=5013"
                                                title="View Invoice" target="_blank"><i
                                                    class="fa fa-search-plus"></i></a><a
                                                class="btn btn-default btn-xcrud btn btn-warning"
                                                href="http://travel.local/admin/bookings/edit/hotels/6" title="Edit"
                                                target="_self"><i class="fa fa-edit"></i></a><a
                                                class="btn btn-default btn-xcrud btn-danger"
                                                href="javascript: delfunc('6','http://travel.local/admin/bookings/delBooking')"
                                                title="DELETE" target="_self" id="6"><i
                                                    class="fa fa-times"></i></a></span></td>
                                </tr>
                                <tr class="xcrud-row xcrud-row-1">
                                    <td>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="checkboxcls" type="checkbox" value="5"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="xcrud-current xcrud-num">2</td>
                                    <td class="xcrud-current">5</td>
                                    <td>2840</td>
                                    <td>Qasim</td>
                                    <td>flights</td>
                                    <td>16/11/2018</td>
                                    <td>1028.5</td>
                                    <td>0</td>
                                    <td>1028.5</td>
                                    <td><span class="btn btn-xs btn-info">Unpaid</span></td>
                                    <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a
                                                class="btn btn-default btn-xcrud btn btn-primary"
                                                href="http://travel.local/invoice/?id=5&amp;sessid=2840"
                                                title="View Invoice" target="_blank"><i
                                                    class="fa fa-search-plus"></i></a><a
                                                class="btn btn-default btn-xcrud btn btn-warning"
                                                href="http://travel.local/admin/bookings/edit/flights/5" title="Edit"
                                                target="_self"><i class="fa fa-edit"></i></a><a
                                                class="btn btn-default btn-xcrud btn-danger"
                                                href="javascript: delfunc('5','http://travel.local/admin/bookings/delBooking')"
                                                title="DELETE" target="_self" id="5"><i
                                                    class="fa fa-times"></i></a></span></td>
                                </tr>
                                <tr class="xcrud-row xcrud-row-0">
                                    <td>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="checkboxcls" type="checkbox" value="4"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="xcrud-current xcrud-num">3</td>
                                    <td class="xcrud-current">4</td>
                                    <td>8906</td>
                                    <td>Qasim</td>
                                    <td>flights</td>
                                    <td>14/11/2018</td>
                                    <td>1446.9</td>
                                    <td>0</td>
                                    <td>1446.9</td>
                                    <td><span class="btn btn-xs btn-info">Unpaid</span></td>
                                    <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a
                                                class="btn btn-default btn-xcrud btn btn-primary"
                                                href="http://travel.local/invoice/?id=4&amp;sessid=8906"
                                                title="View Invoice" target="_blank"><span class="ink animate"
                                                    style="top: 11.375px; left: 0.734375px;"></span><i
                                                    class="fa fa-search-plus"></i></a><a
                                                class="btn btn-default btn-xcrud btn btn-warning"
                                                href="http://travel.local/admin/bookings/edit/flights/4" title="Edit"
                                                target="_self"><i class="fa fa-edit"></i></a><a
                                                class="btn btn-default btn-xcrud btn-danger"
                                                href="javascript: delfunc('4','http://travel.local/admin/bookings/delBooking')"
                                                title="DELETE" target="_self" id="4"><i
                                                    class="fa fa-times"></i></a></span></td>
                                </tr>
                                <tr class="xcrud-row xcrud-row-1">
                                    <td>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="checkboxcls" type="checkbox" value="3"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="xcrud-current xcrud-num">4</td>
                                    <td class="xcrud-current">3</td>
                                    <td>9182</td>
                                    <td>Qasim</td>
                                    <td>hotels</td>
                                    <td>01/11/2018</td>
                                    <td>204</td>
                                    <td>0</td>
                                    <td>204</td>
                                    <td><span class="btn btn-xs btn-info">Unpaid</span></td>
                                    <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a
                                                class="btn btn-default btn-xcrud btn btn-primary"
                                                href="http://travel.local/invoice/?id=3&amp;sessid=9182"
                                                title="View Invoice" target="_blank"><i
                                                    class="fa fa-search-plus"></i></a><a
                                                class="btn btn-default btn-xcrud btn btn-warning"
                                                href="http://travel.local/admin/bookings/edit/hotels/3" title="Edit"
                                                target="_self"><i class="fa fa-edit"></i></a><a
                                                class="btn btn-default btn-xcrud btn-danger"
                                                href="javascript: delfunc('3','http://travel.local/admin/bookings/delBooking')"
                                                title="DELETE" target="_self" id="3"><i
                                                    class="fa fa-times"></i></a></span></td>
                                </tr>
                                <tr class="xcrud-row xcrud-row-0">
                                    <td>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="checkboxcls" type="checkbox" value="2"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="xcrud-current xcrud-num">5</td>
                                    <td class="xcrud-current">2</td>
                                    <td>2536</td>
                                    <td>Qasim</td>
                                    <td>hotels</td>
                                    <td>01/11/2018</td>
                                    <td>45.32</td>
                                    <td>45.32</td>
                                    <td>0</td>
                                    <td><span class="btn btn-xs btn-success">Paid</span></td>
                                    <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a
                                                class="btn btn-default btn-xcrud btn btn-primary"
                                                href="http://travel.local/invoice/?id=2&amp;sessid=2536"
                                                title="View Invoice" target="_blank"><i
                                                    class="fa fa-search-plus"></i></a><a
                                                class="btn btn-default btn-xcrud btn btn-warning"
                                                href="http://travel.local/admin/bookings/edit/hotels/2" title="Edit"
                                                target="_self"><i class="fa fa-edit"></i></a><a
                                                class="btn btn-default btn-xcrud btn-danger"
                                                href="javascript: delfunc('2','http://travel.local/admin/bookings/delBooking')"
                                                title="DELETE" target="_self" id="2"><i
                                                    class="fa fa-times"></i></a></span></td>
                                </tr>
                                <tr class="xcrud-row xcrud-row-1">
                                    <td>
                                        <div class="icheckbox_square-grey" style="position: relative;"><input
                                                class="checkboxcls" type="checkbox" value="1"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="xcrud-current xcrud-num">6</td>
                                    <td class="xcrud-current">1</td>
                                    <td>8563</td>
                                    <td>Qasim</td>
                                    <td>hotels</td>
                                    <td>22/10/2018</td>
                                    <td>339.9</td>
                                    <td>0</td>
                                    <td>339.9</td>
                                    <td><span class="btn btn-xs btn-info">Unpaid</span></td>
                                    <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a
                                                class="btn btn-default btn-xcrud btn btn-primary"
                                                href="http://travel.local/invoice/?id=1&amp;sessid=8563"
                                                title="View Invoice" target="_blank"><i
                                                    class="fa fa-search-plus"></i></a><a
                                                class="btn btn-default btn-xcrud btn btn-warning"
                                                href="http://travel.local/admin/bookings/edit/hotels/1" title="Edit"
                                                target="_self"><i class="fa fa-edit"></i></a><a
                                                class="btn btn-default btn-xcrud btn-danger"
                                                href="javascript: delfunc('1','http://travel.local/admin/bookings/delBooking')"
                                                title="DELETE" target="_self" id="1"><i
                                                    class="fa fa-times"></i></a></span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <div class="xcrud-nav">
                        <div class="btn-group xcrud-limit-buttons" data-toggle="buttons-radio"><button type="button"
                                class="btn btn-default xcrud-action" data-limit="25">25</button><button type="button"
                                class="btn btn-default active xcrud-action" data-limit="50">50</button><button
                                type="button" class="btn btn-default xcrud-action" data-limit="100">100</button><button
                                type="button" class="btn btn-default xcrud-action" data-limit="all">All</button></div>
                        <a class="xcrud-search-toggle btn btn-default" href="javascript:;">Search</a><span
                            class="xcrud-search form-inline" style="display:none;"><input
                                class="xcrud-searchdata xcrud-search-active input-small form-control" name="phrase"
                                data-type="text" style="" data-fieldtype="default" type="text" value=""><select
                                class="xcrud-data xcrud-columns-select input-small form-control" name="column">
                                <option value="">All fields</option>
                                <option value="pt_bookings.booking_id" data-type="int">ID</option>
                                <option value="pt_bookings.booking_ref_no" data-type="text">Ref No.</option>
                                <option value="pt_accounts.ai_first_name" data-type="text">Customer</option>
                                <option value="pt_bookings.booking_type" data-type="text">Module</option>
                                <option value="pt_bookings.booking_status" data-type="text">Status</option>
                            </select><span class="btn-group"><a class="xcrud-action btn btn-primary" href="javascript:;"
                                    data-search="1">Go</a></span></span> <span class="xcrud-benchmark"><span>Execution
                                time: 0.044 s</span><span>Memory usage: 0.18 MB</span></span>
                    </div>
                </div>
                <div class="xcrud-overlay" style="display: none;"></div>
            </div>
        </div>
        <script src="http://travel.local/assets/xcrud/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="http://travel.local/assets/xcrud/plugins/jcrop/jquery.Jcrop.min.js"></script>
        <script src="http://travel.local/assets/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.js"></script>
        <script src="http://travel.local/assets/xcrud/plugins/xcrud.js"></script>
        <script type="text/javascript">
           	var xcrud_config = { "url": "http:\/\/travel.local\/xcrud_ajax", "editor_url": false, "editor_init_url": false, "force_editor": false, "date_first_day": 1, "date_format": "dd.mm.yy", "time_format": "HH:mm:ss", "lang": { "add": "Add", "edit": "Edit", "view": "View", "remove": "Remove", "duplicate": "Duplicate", "print": "Print", "export_csv": "Export into CSV", "search": "Search", "go": "Go", "reset": "Reset", "save": "Save", "save_return": "Save & Return", "save_new": "Save & New", "save_edit": "Save & Edit", "return": "Return", "modal_dismiss": "Close", "add_image": "Add image", "add_file": "Add file", "exec_time": "Execution time:", "memory_usage": "Memory usage:", "bool_on": "Yes", "bool_off": "No", "no_file": "no file", "no_image": "no image", "null_option": "- none -", "total_entries": "Total entries:", "table_empty": "Entries not found.", "all": "All", "deleting_confirm": "Do you really want remove this entry?", "undefined_error": "It looks like something went wrong...", "validation_error": "Some fields are likely to contain errors. Fix errors and try again.", "image_type_error": "This image type is not supported.", "unique_error": "Some fields are not unique.", "your_position": "Your position", "search_here": "Search here...", "all_fields": "All fields", "choose_range": "- choose range -", "next_year": "Next year", "next_month": "Next month", "today": "Today", "this_week_today": "This week up to today", "this_week_full": "This full week", "last_week": "Last week", "last_2weeks": "Last two weeks", "this_month": "This month", "last_month": "Last month", "last_3months": "Last 3 months", "last_6months": "Last 6 months", "this_year": "This year", "last_year": "Last year" }, "rtl": 0 };
        </script>
    </div>
</div>