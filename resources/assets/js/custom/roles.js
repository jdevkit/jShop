$( document ).ready(function(){
    $('select').on('change', function() {
        $("input[name*='permissions']").prop('checked', false);
        $.ajax({
            type: "GET",
            url: '/admin/roles/get',
            data: "roleId=" + this.value,
            success: function(response){
                let perms = JSON.parse(response);
                perms.forEach(function (item) {
                    $("input[name$='permissions[" + item.id +"]'").prop('checked', true);
                })
            }
        })
    })
});