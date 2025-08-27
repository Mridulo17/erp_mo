
<div class="row">
    <div class="col-sm-12 print_button_container">
        <button type="button" class="btn btn-xs btn-warning" style="float: right;" id="print_button_new"><i class="fa fa-print"></i> &nbsp; Print</button>
    </div>
    <div class="col-sm-12">
        <b class="message_data"></b>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <page size="A4" id="print-area-2">
            @foreach($candidateDynamicForm->updatedCandidateDynamicFormFields as $field)
                <div class="draggable ui-draggable ui-draggable-handle"
                     field-id="{{ $field->id }}"
                     field-name="{{ $field->field_name }}"
                     form-id="{{ $candidateDynamicForm->id }}"
                     style="top: {{ $field->top ?? 0 }}px; left: {{ $field->left ?? 0 }}px;">
                    {{ $field->field_name }}
                </div>
            @endforeach
        </page>
        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">


        <!-- jQuery + jQuery UI -->
{{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>--}}
{{--        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">--}}

        <style>
            page[size="A4"] {
                background: white;
                width: 21cm;
                height: 29.7cm;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
                background: url('{{ asset($candidateDynamicForm->background_image) }}');
                background-repeat: no-repeat;
                background-size: contain;
                background-position: top;
                position: relative; /* important for draggable positioning */
            }

            @media print {
                body, page[size="A4"] {
                    margin: 0;
                    box-shadow: none;
                }
                .draggable {
                    color: black !important;
                    border: none !important;
                    font-weight: normal !important;
                }
                .print_button_container {
                    display: none !important;
                }
            }

            .draggable {
                position: absolute;
                color: rgb(255, 0, 0);
                border-bottom: dotted;
                font-weight: bolder;
                width: fit-content;
                cursor: move;
            }

            .print_button_container {
                margin: 10px 0;
                text-align: right;
            }
        </style>
        <script>
            $(".draggable").draggable({
                containment: "#print-area-2",
                stop: function (e, ui) {
                    let payload = [];

                    $('.draggable').each(function () {
                        console.log('ddd');
                        let $el = $(this);
                        let pos = $el.position();
                        payload.push({
                            field_id: $el.attr('field-id'),
                            field_name: $el.attr('field-name'),
                            form_id: $el.attr('form-id'),
                            top: pos.top,
                            left: pos.left
                        });
                    });

                    if (payload.length) {
                        $.post({
                            url: '{{ route("admin.candidate.dynamic.form.save") }}',
                            data: {
                                dragable_position_save: 'active',
                                information: payload,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (data) {
                                let value = (typeof data === "string") ? JSON.parse(data) : data;
                                $('.message_data').html(value.message);
                            }
                        });
                    }
                }
            });

            // Print only A4 page
            $('#print_button_new').click(function () {
                let printContent = document.getElementById('print-area-2').outerHTML;
                let WinPrint = window.open('', '', 'width=900,height=650');
                WinPrint.document.write('<html><head><title>Print</title>');
                WinPrint.document.write('<style>body{margin:0;} page[size="A4"]{width:21cm;height:29.7cm;}</style>');
                WinPrint.document.write('</head><body>');
                WinPrint.document.write(printContent);
                WinPrint.document.write('</body></html>');
                WinPrint.document.close();
                WinPrint.focus();
                WinPrint.print();
                WinPrint.close();
            });
        </script>
</div>
</div>


