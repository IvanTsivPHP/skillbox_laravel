<div class="overflow-auto">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Уведомления
            </div>
            <div class="card-body">
                <div id="notification"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{mix('/js/app.js')}}"></script>
<script type="text/javascript">

    var i = 0;

    Echo.private('test')

        .listen('.NewTestEvent', (data) => {

            i++;

            $("#notification").append(
                '<div class="alert alert-success">'+i+'.В статье <a href="'+data.url+'">'+data.name+'</a>' +
                ' были изменены поля: '+data.changes+'</div>'
            );

        });

</script>
