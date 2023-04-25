$(document).ready(function(){
    $('#car_id').on('change', function(){
        let car_model = $('#car_model');
        if ($(this).val() != 0) {
            car_model.prop('disabled', false);
            let options = '<option value="0">Виберіть модель</option>';
            $.ajax({
                method: 'POST',
                dataType: 'json',
                data: $('#form').serialize(),
                url: '/get-models',
                success: function(data) {
                    data.data.forEach((elem) => {
                        options += '<option value="' + elem.id + '">' + elem.name + '</option>';
                    });
                    car_model.html(options);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        } else {
            car_model.html('<option value="0">Виберіть модель</option>');
            car_model.prop('disabled', true);
        }
    });

    $('#send-button').on('click', function(){
        if ($('#car_id').val() == 0) {
            alert('Виберіть марку');
            return false;
        }

        if ($('#car_model').val() == 0) {
            alert('Виберіть модель');
            return false;
        }

        $.ajax({
            method: 'POST',
            dataType: 'json',
            data: $('#form').serialize(),
            url: '/send-data',
            success: function(data) {
                if (data.status == 'OK') {
                    alert('Дані відправлені');
                    return false;
                }
            },
            error: function(data) {
                console.log(data);
                return false;
            }
        })
    });

    $('#form').on('submit', function(data){
        return false;
    });
});
