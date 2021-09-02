export let feedback = {
    init: function () {
        let $table = $('#feedback_table .dataTable');
        let $tableContent = $('#feedback_table .ibox-content');

        $table.on('ifClicked', '#feedback_all', function () {
            $('.group-element').iCheck('toggle');
        });

        $('#feedback_table a.group-action').on('click', function () {
            let $btn = $(this);

            let url = $btn.data('url');
            let data = $table.find('.group-element').serializeJSON();

            swal({
                title: "Вы уверены?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Отмена",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Да"
            }).then((result) => {
                if (result.value) {
                    $tableContent.toggleClass('sk-loading');

                    $.ajax({
                        url: url,
                        method: "POST",
                        dataType: "json",
                        data: data,
                        success: function (data) {
                            $tableContent.toggleClass('sk-loading');
                            $('#feedback_all').iCheck('uncheck');

                            if (data.success === true) {
                                swal({
                                    title: "Записи обновлены",
                                    type: "success"
                                });
                                $table.DataTable().ajax.reload(null, false);
                            } else {
                                showError('При обновлении записей произошла ошибка');
                            }
                        },
                        error: function () {
                            $tableContent.toggleClass('sk-loading');
                            $('#feedback_all').iCheck('uncheck');

                            showError('При обновлении записей произошла ошибка');
                        }
                    });
                }
            });
        });

        $table.on('draw.dt', function () {
            if ($('.i-checks').length > 0) {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });
            }

            let $switchers = $table.find('input.switchery');

            $switchers.each(function () {
                new Switchery($(this).get(0), {
                    size: 'small'
                });
            });

            $switchers.on('change', function () {
                let $input = $(this);

                let url = $input.data('target');
                let val = $input.val();

                $tableContent.toggleClass('sk-loading');

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        feedback: [val]
                    },
                    success: function (data) {
                        $tableContent.toggleClass('sk-loading');

                        if (data.success === true) {
                            swal({
                                title: "Запись изменена",
                                type: "success"
                            });
                        } else {
                            showError('Произошла ошибка');
                        }
                    },
                    error: function () {
                        $tableContent.toggleClass('sk-loading');

                        showError('Произошла ошибка');
                    }
                });
            });
        });

        function showError(text) {
            swal({
                title: "Ошибка",
                text: text,
                type: "error"
            });
        }
    }
};
