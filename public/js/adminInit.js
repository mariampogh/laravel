$(document).ready(function(){
    $(".delete").click(function(){
    	var id = $(this).attr('data-id');
        $(".confirm").attr("action", "/admin/users/"+id)
    })
})
