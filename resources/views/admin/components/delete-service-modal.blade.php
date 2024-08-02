<div class="modal fade" id="deleteService" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="text-danger" id="serviceName"></span>?</p>
                <form id="deleteServiceForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.deleteServiceBtn').on('click', function() {
            var serviceId = $(this).data('id');
            $('#serviceName').text($(this).data('name'));
            $('#delete_id').val(serviceId);
            $('#deleteService').modal('show');
            $('#deleteServiceForm').attr('action', '/our-services/' + serviceId);
        });
    });
</script>
