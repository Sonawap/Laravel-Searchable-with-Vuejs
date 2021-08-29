@section('javascript')
    <script src="{{ asset('js/Jquery3.4.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#DataTable').DataTable({
                responsive: {

                },
                columnDefs: [ {
                    className: 'dtr-control',
                    orderable: false,
                    targets:   0
                } ],
                order: [ 1, 'asc' ]
            });
        } );
    </script>
@endsection
