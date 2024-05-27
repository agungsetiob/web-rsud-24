$('#submitButton').click(function(e) {
    e.preventDefault();
    var $button = $(this);
    $button.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...').prop('disabled', true);

    let name = $("#name").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let message = $("#message").val();
    let token = $("meta[name='csrf-token']").attr("content");
    
    $.ajax({
        url: "send/message",
        type: "POST",
        cache: false,
        data: {
            "name": name,
            "email": email,
            "phone": phone,
            "message": message,
            "_token": token,
        },
        success:function(response){
            console.log(response);
            $('#success-message').text(response.message);
            $('#success-alert').removeClass('d-none').addClass('show');

            $('#alert-name').addClass('d-none');
            $('#alert-email').addClass('d-none');
            $('#alert-phone').addClass('d-none');
            $('#alert-message').addClass('d-none');
            
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#message').val('');               
        },
        error:function(error){
            console.log(error);

            if(error.responseJSON && error.responseJSON.name && error.responseJSON.name[0]) {
                //show alert
                $('#alert-name').removeClass('d-none');
                $('#alert-name').addClass('d-block');

                //add message to alert
                $('#alert-name').text(error.responseJSON.name[0]);
            }
            if(error.responseJSON && error.responseJSON.email && error.responseJSON.email[0]) {
                //show alert
                $('#alert-email').removeClass('d-none');
                $('#alert-email').addClass('d-block');

                //add message to alert
                $('#alert-email').text(error.responseJSON.email[0]);
            }
            if(error.responseJSON && error.responseJSON.phone && error.responseJSON.phone[0]) {
                //show alert
                $('#alert-phone').removeClass('d-none');
                $('#alert-phone').addClass('d-block');

                //add message to alert
                $('#alert-phone').text(error.responseJSON.phone[0]);
            }
            if(error.responseJSON && error.responseJSON.message && error.responseJSON.message[0]) {
                //show alert
                $('#alert-message').removeClass('d-none');
                $('#alert-message').addClass('d-block');

                //add message to alert
                $('#alert-message').text(error.responseJSON.message[0]);
            } else {
                $('#error-message').text('An error occurred.');
                $('#error-alert').removeClass('d-none').addClass('show');
            }

            // Hide success alert if it was shown
            $('#success-alert').addClass('d-none');

        },
        complete: function () {
            // Hide loading spinner and reset button text
            $button.html('Kirim').prop('disabled', false);
        }
    });
});