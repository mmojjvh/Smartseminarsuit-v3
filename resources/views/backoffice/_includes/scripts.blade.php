<script src="{{asset('assets/plugins/jquery/jquery-1.11.1.min.js')}}"></script>
<script>

    $('.alert-close').on('click', function(){
        $(this).closest('.alert-div').remove();
    })

    $(document).ready(() => {

        let url = window.location.origin + '/api/events/monitor'

        setInterval(() => {
            $.get(url).then((data) => {
                try {
                    let result = JSON.parse(data)
                    console.log(result)
                } catch (error) {
                    console.log(error)
                }
            }).catch((error) => {
                console.log(error)
            })
        }, 60000);

    });

</script>