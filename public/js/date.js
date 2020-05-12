jQuery(document).ready(function () {
    $('.js-datepicker').datepicker(
        {
            todayBtn: "linked",
            autoclose: true,
            toggleActive: true,
            format : 'yyyy-MM-dd'
        }
    );
});
