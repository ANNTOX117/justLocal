$(document).ready(function () {
    $('#edit_compny_info').click(function() {
        $('#modalCompany').modal('show');
    });
    $('#modal_review').click(function() {
        $('#modalReview').modal('show');
    });

    $("#list_options_edit button").click(function(){
        $('#list_options_edit button').removeClass('active');
        $(this).addClass('active');
    });

    $("#review_button").click(function(){
        $('.menu_forms').addClass('d-none');
        $("#reviews").removeClass('d-none');
    });
    $("#offers_button").click(function(){
        $('.menu_forms').addClass('d-none');
        $("#offers").removeClass('d-none');
    });
    $("#multiple_image_button").click(function(){
        $('.menu_forms').addClass('d-none');
        $("#multiple_image").removeClass('d-none');
    });

    $('#multipleimages_form').submit(function(event) {
        event.preventDefault();
        let formData = new FormData();
        let files = $('#multiple_images')[0].files;
        for (let i = 0; i < files.length; i++) {
            formData.append('images[]', files[i]);
        }
        const id = $("#company_id").val();
        formData.append('id', id);
        $.ajax({
            url: '/ajax/insert_multiple_image',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR, textStatus, errorThrown);
                alert(errorThrown);
            }
        });
    });

    $('#submit_form_review').click(function(event) {  
        const comment_review = $("#comment-review").val();
        const name_review = $("#name-review").val();
        const job_description_review = $("#job-description-review").val();
        const company_id = $("#company_id").val();
        const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ']+( [A-Za-zÀ-ÖØ-öø-ÿ']+)*$/;
        const dutchTextRegex = /[a-zA-ZÀ-ÿ]+/g;
        if (!dutchTextRegex.test(comment_review)) return alert("Comment Incorrect");
        if (!nameRegex.test(name_review)) return alert("Name incorrect");
        if (!nameRegex.test(job_description_review)) return alert("job incorrect");
        $.ajax({
            url: '/ajax/insert_review',
            type: 'post',
            data: {
                comment_review,
                name_review,
                job_description_review,
                company_id
            },
            success: function(response) {
                let newRow = `<tr><td>${response}</td><td>${comment_review}</td><td>${name_review}</td><td>${job_description_review}</td><td>jjjwjwjw</td></tr>`;
                $("#table_reviews > tbody").append(newRow);
                $("#comment-review").val("");
                $("#name-review").val("");
                $("#job-description-review").val("");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR, textStatus, errorThrown);
                alert(errorThrown);
            }
        });
    });

})
