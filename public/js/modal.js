jQuery(document).ready(function () {
    $('#formModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let affectation = button.data('affectation');
        let month = button.data('month') ;
        let ref = button.data('ref');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);
        let year = $('#selectYear').val();
        modal.find('.modal-title').text('');
        modal.find('.modal-body input#affectation-name').val(affectation);
        modal.find('.modal-body input#month-name').val(month);
        modal.find('.modal-body input#td-ref').val(ref);
    })

    $('#saveTransaction').on('click', function (e) {
        var year = $('#selectYear').val();
        var month = $('#month-name').val();
        var amount = $('#amount-name').val();
        var ref = '#'+$('#td-ref').val();
        var affectation = $('#affectation-name').val();
        var path = Routing.generate('proposing_transaction_save');
        var id_btn = '#btn-'+affectation+'-'+month;
        $.ajax({
            url: path,
            type: "POST",
            dataType: "json",
            data: {
                "affectation": affectation,
                "amount": amount,
                "year": year,
                "month": month,
            },
            async: true,
            success: function (data) {
                $(id_btn).remove();
                $(ref).removeClass("bg-warning");
                $(ref).addClass("bg-success");
                $('#formModal').modal('hide');
            }
        })
    });
});
