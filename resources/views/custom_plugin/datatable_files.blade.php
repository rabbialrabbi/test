<script>
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); var data_id = button.data('id'); var modal = $(this); modal.find('.modal-body #data_id').val(data_id);
    });
</script>


 <!-- datatable js files
<script type="text/javascript" src="{{asset('public/datatable/js/jquery-3.3.1.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/buttons.flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/datatable/js/buttons.print.min.js')}}"></script>
 -->


