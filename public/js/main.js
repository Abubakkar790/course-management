$(document).ready(function(){
    if ($('.toggle-sidebar-btn')) {
        $('.toggle-sidebar-btn').click(function() {
            $('body').toggleClass('toggle-sidebar');
        })
    }
});