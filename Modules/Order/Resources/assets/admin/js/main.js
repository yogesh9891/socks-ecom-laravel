$('#order-status').change((e) => {
    $.ajax({
        type: 'PUT',
        url: route('admin.orders.status.update', e.currentTarget.dataset.id),
        data: { status: e.currentTarget.value },
        success: (message) => {
            success(message);
        },
        error: (xhr) => {
            error(xhr.responseJSON.message);
        },
    });
});







import '../../../../node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable';
        


            $('.tracking_id').editable({
                url: route('admin.orders.tracking.update'),
                method:'PUT',
                type: 'text',
                mode: 'inline',
                success: (message) => {
                    success(message);
                },
                error: (xhr) => {
                    error(xhr.responseJSON.message);
                },
            });
