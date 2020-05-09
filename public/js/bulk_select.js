function toggle(source)
{

    let aInputs = document.getElementsByName("dons");

    for (let i=0; i<aInputs.length; i++) {
        console.log(aInputs[i]);
        console.log(source);
        if (aInputs[i] != source && aInputs[i].className == source.className) {
            aInputs[i].checked = source.checked;
        }
    }

}
jQuery(document).ready(function () {
    // get all checked checkboxes in dons list

    $("#checkalldons").change(function () {
        var checked = $(this).is(':checked'); // Checkbox state

        console.log(checked);
        // Select all
        if (checked) {
            $('.checkall').each(function () {
                $(this).prop('checked',true);
            });
        } else {
            // Deselect All
            $('.checkall').each(function () {
                $(this).prop('checked',false);
            });
        }

    });
    $('#bulk_generate').on('click', function () {

        let value = [];
        $('.checkall:checked').each(function (index) {
            //part where the magic happens
            value.push($(this).val());
        });

        if (value.length) {
            let path = Routing.generate('don_receipt_generate_bulk');
            $.ajax({
                url: path,
                type: "POST",
                dataType: "json",
                data: {
                    "dons": value,
                },
                async: true,
                success: function (data) {
                    window.location.href =  window.location.pathname;
                }
            })
        } else {
            alert('Select dons !!');
        }
    })

});