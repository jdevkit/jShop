$( document ).ready(function(){
    $('select').on('change', function() {
        console.log( this.value );
        $.ajax({
            type: "GET",
            url: '/admin/roles/get',
            data: "roleId=" + this.value,
            success: function(){
                console.log('success')
            }
        })
    })
});