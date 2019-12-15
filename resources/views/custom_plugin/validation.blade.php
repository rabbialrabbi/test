<script type="text/javascript">
    $(document).ready(function(){
        $('#email').keyup(function(){
            var email = $('#email').val();
            var _token = $('input[name="_token"]').val();

            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!filter.test(email))
            {
                $('#error_email').html('<label class="text-danger"></label>');$('#register').attr('disabled', 'disabled');
            }
            else
            {
                $.ajax({
                    url:"{{ route('chck-email') }}",
                    method:"POST",
                    data:{email:email, _token:_token},
                    success:function(result)
                    {
                        if(result == 'unique')
                        {
                            $('#error_email').html('<label class="text-success">Unique <i class="fa fa-check"></i></label>');
                            $('#email').removeClass('has-error');$('#register').attr('disabled', false);
                        }
                        else
                        {
                            $('#error_email').html('<label class="text-danger">Email Exists. Enter Another Email</label>');
                            $('#email').addClass('has-error');$('#register').attr('disabled', 'disabled');
                        }
                    }
                })
            }
        });

        $('#password, #conf_password').on('keyup', function ()  {

            if(this.value.length < 6 && this.value.length > 0){
                $('#error_password').html('<label class="text-primary">Password will have to minimum 6 digits</label>');
                $('#error_password').addClass('has-error');$('#register').attr('disabled', 'disabled');
            }
            else if(this.value.length == 0){
                $('#error_password').html('<label class="text-primary"></label>');
                $('#message').html('<label class="text-danger"></label>');
                $('#error_password').addClass('has-error');$('#register').attr('disabled', 'disabled');
            }
            else{
                if ($('#password').val() == $('#conf_password').val()) {
                    $('#message').html("Password Matched").css('color', 'green');
                    $('#error_password').html('<label class="text-primary"></label>');
                    $('#error_password').removeClass('has-error');$('#message').removeClass('has-error');
                    $('#register').attr('disabled', false);
                } else {
                    $('#message').html("Password Did not Matched").css('color', 'red');
                    $('#message').addClass('has-error');$('#register').attr('disabled', 'disabled');
                }
            }
        });
    });

</script>
