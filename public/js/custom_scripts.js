jQuery(document).ready(function () {
    $('#formModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let affectation = button.data('affectation');
        let month = button.data('month') ;
        let amount = button.data('amount') ;
        let ref = button.data('ref');
        let modal = $(this);
        modal.find('.modal-title').text('');
        modal.find('.modal-body input#affectation-name').val(affectation);
        modal.find('.modal-body input#month-name').val(month);
        modal.find('.modal-body input#td-ref').val(ref);
        modal.find('.modal-body input#amount-name').val(amount);
    })

    $('#saveTransaction').on('click', function (e) {
        var year = $('#selectYear').val();
        var month = $('#month-name').val();
        var amount = $('#amount-name').val();
        var ref = '#'+$('#td-ref').val();
        var affectation = $('#affectation-name').val();
        var path = Routing.generate('proposing_transaction_save');
        var id_btn = '#btn-'+affectation+'-'+month;
        var id_amount = '#amount-'+affectation+'-'+month;
        var icon_recieved = '#icon-recieved-'+affectation+'-'+month;
        var div_recieved = '#div-recieved-'+affectation+'-'+month;

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
                $(ref).removeClass("bg-warning-c");
                $(ref).addClass("bg-success-c");
                var html_div_recieved = '<button type="button" class="btn btn-light" data-toggle="modal" data-target="#recievedModal"\n' +
                    ' data-recievedtransaction="'+ data.id +'"\n' +
                    ' id="btn-recieved-'+ data.id +'"' +
                    ' data-affectation="'+data.affectation.id +'"\n' +
                    ' data-month="' + data.month +'">recieved?</button>';
                $(icon_recieved).html('<span class="fas fa-thumbs-down"></span>');
                $(div_recieved).html(html_div_recieved);

                $(id_amount).text(data.amount + ' €');
                $('#formModal').modal('hide');

            }
        })
    });


    $('#recievedModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let transaction = button.data('recievedtransaction');
        let affectation = button.data('affectation');
        let month = button.data('month') ;
        let modal = $(this);

        modal.find('.modal-body input#ref-transaction').val(transaction);
        modal.find('.modal-title').text('Amount recieved');
        modal.find('.modal-body input#affectation-ref').val(affectation);
        modal.find('.modal-body input#month-transaction').val(month);
    })


    $('#validateRecieved').on('click', function (e) {
        var transaction = $('#ref-transaction').val();
        var affectation = $('#affectation-ref').val();
        var month = $('#month-transaction').val();

        var path = Routing.generate('proposing_transaction_update');
        var id_btn = '#btn-recieved-'+transaction;
        var icon_recieved = '#icon-recieved-'+affectation+'-'+month;
        $.ajax({
            url: path,
            type: "POST",
            dataType: "json",
            data: {
                "field": 'recieved',
                "id": transaction,
            },
            async: true,
            success: function (data) {
                $(id_btn).remove();
                $(icon_recieved).html('<span class="fas fa-thumbs-up"></span>');
                //$(id_icon).addClass("fa-thumbs-up");

                $('#recievedModal').modal('hide');

            }
        })
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let item = button.data('item');
        let modal = $(this);
        modal.find('.modal-body input#ref-item').val(item);
    })


    $('#confirmDelete').on('click', function (e) {
        var item = $('#ref-item').val();
        var path = Routing.generate('delete_case_item', {item: item});

        console.log(item);
        console.log(path);
        $.ajax({
            url: path,
            type: "GET",
            success: function (data) {
                console.log(data);
                if (data.status) {
                    window.location.href =  window.location.pathname;
                } else {
                    alert('Error deleting');
                }

            }
        })
    });

    $('#selectYear').on('change', function () {

        var el = $(this);

        let folder = $(this).data("folder");
        let current_year = $(this).data("currentyear");
        if (this.value != current_year) {
            window.location.href = Routing.generate('show_case',{case: folder, year: this.value});
        }

    });



});
