
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('asset/js/app.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        @if(Session::has('messege'))
        var type = "{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                Swal.fire({
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    title: 'Info!',
                    text: '{{Session::get('messege')}}',
                    icon: 'info',
                    position:'top-end',
                    toast:true
                })
                break;
            case 'success':
                Swal.fire({
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    title: 'Success!',
                    text: '{{Session::get('messege')}}',
                    icon: 'success',
                    position:'top-end',
                    toast:true
                })
                break;
            case 'warning':
                Swal.fire({
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    title: 'Warning!',
                    text: '{{Session::get('messege')}}',
                    icon: 'warning',
                    position:'top-end',
                    toast:true
                })
                break;
            case 'error':
                Swal.fire({
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    title: 'Error!',
                    text: '{{Session::get('messege')}}',
                    icon: 'error',
                    position:'top-end',
                    toast:true
                })
                break;
        }
        @endif
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            })
            });
        });
    </script>

    
