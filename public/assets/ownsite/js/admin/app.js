$(function() {
    //$("#sortable").sortable();
    // var fileInput = document.getElementById('image_carousel');
    // var imagePreview = document.getElementById('imagePreview');
    // fileInput.addEventListener('change', function(e) {
    //     var file = e.target.files[0];
    //     var reader = new FileReader();
    //     reader.onload = function(e) {
    //         imagePreview.src = e.target.result;
    //     };
    //     reader.readAsDataURL(file);
    // });
    let userId,companyId;
    $(".edit_user").click(function () {
        userId = $(this).data("id");
        
        $.ajax({
            url: '/ajax/get_info_user/'+userId,
            type: 'get',
            success:function(response) {
                companyId = response.user.company_id
                $('#updateModal').modal('show');
                $("#name").val(response.user.name);
                $("#email").val(response.user.email);
                $("#companyName").val(response.user.company_name);
                $("#blockUser").prop("checked", response.user.blocked === "1");
                $("#deleteUser").prop("checked", response.user.deleted === "1");
                $("#approveUser").prop("checked", response.user.approved === "1");
                $("#activeUser").prop("checked", response.user.active === "1");
                $("#verifiedUser").prop("checked", response.user.verified === "1");
                $("#blockCompany").prop("checked", response.user.company_block === "1");
                $("#activeCompany").prop("checked", response.user.company_active === "1");
                $("#deleteCompany").prop("checked", response.user.company_deleted === "1");
            }
        });
        
    });

    $("#update_info").click(function () {
        let name = $("#name").val();
        let email = $("#email").val();
        let comapanyName = $("#companyName").val();
        let blockUser =  $("#blockUser").prop("checked");
        let deleteUser =  $("#deleteUser").prop("checked");
        let approveUser =  $("#approveUser").prop("checked");
        let activeUser =  $("#activeUser").prop("checked");
        let verifiedUser =  $("#verifiedUser").prop("checked");
        let blockCompany =  $("#blockCompany").prop("checked");
        let activeCompany =  $("#activeCompany").prop("checked");
        let deleteCompany =  $("#deleteCompany").prop("checked");

        $.ajax({
            url: '/ajax/update_user_info/'+userId,//+"/"+companyId,
            type: 'post',
            data:{
                name,
                email,
                comapanyName,
                blockUser,
                deleteUser,
                approveUser,
                activeUser,
                verifiedUser,
                blockCompany,
                activeCompany,
                deleteCompany,
            },
            success:function(response) {
                console.log(response);
                // companyId = response.user.company_id
                // $('#updateModal').modal('show');
                // console.log(response.user);
            },error:function(a,b,c){
                console.error(a,b,c);
            }
        });
    })
    $("#hide_modal").click(function() {
        // Find the closest modal and call the modal() method with the 'hide' option to close it
        $(this).closest(".modal").modal("hide");
      });
    
    var id_to_delete = 0;
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
    const appendAlert = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
          `<div class="alert alert-${type} alert-dismissible" role="alert">`,
          `   <div>${message}</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
        ].join('')
      
        alertPlaceholder.append(wrapper)
    }      
    const inputs_img = document.querySelectorAll('.input-image');
    inputs_img.forEach(img_input => {
        img_input.addEventListener('change', function handleChange(e) {
            var imagePreview = document.getElementById(this.id+'_prev')
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    });
    const delete_offer = document.querySelectorAll('.delete-icon');
    delete_offer.forEach(delete_button => {
        delete_button.addEventListener('click', function clickEv(e) {
            id_to_delete = this.dataset.id;
        });
    });

    document.getElementById('delete_popular_offer').addEventListener('click', function clickEv(e) {
        $.ajax({
            url: "/ajax/delete/offer/"+id_to_delete,
            method: "get",
            processData: false,
            contentType: false, 
            success: function(response) {
                $('#exampleModal').modal('hide');
                window.scrollTo(0,0);
                appendAlert('Deleted successfully !', 'success')
                setTimeout(() => {
                    location.reload();
                }, 3000);
                console.log("hello there",response);
            },
            error: function(xhr, status, error) {
                console.error("Error here ", error);
            }
        });
    }); 

    document.getElementById('delete_how_it_work').addEventListener('click', function clickEv(e) {
        $.ajax({
            url: "/ajax/delete/how_work/"+id_to_delete,
            method: "get",
            processData: false,
            contentType: false, 
            success: function(response) {
                window.scrollTo(0,0);
                $('#howWorkModal').modal('hide');
                appendAlert('Deleted successfully !', 'success')
                setTimeout(() => {
                    location.reload();
                }, 3000);
                console.log("hello there",response);
            },
            error: function(xhr, status, error) {
            console.error("Error here ", error);
            }
        });
    }); 

    function checkImgSize(fuData, inputFile){
        var Extension = inputFile.substring(inputFile.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var size = fuData.files[0].size;
                    if(size > 1000024){
                        alert("Maximum file size exceeds");
                        return false;
                    }else{
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#blah').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(fuData.files[0]);
                        return true;
                    }
                }
        } 
    }

    $("#carousel_form_head").on("submit", function(event) {
        event.preventDefault();
        let title_home = $("#title_home").val();
        let description_home = $("#description_home").val();
        if (title_home === "") return alert_user("add the title","the title is empty","error");
        if (description_home === "") return alert_user("add the description","the description is empty","error");

        var fuData = document.getElementById('image_principal');
        let inputFile = $("#image_principal").val();
        var check = checkImgSize(fuData, inputFile);
        if(inputFile !== '' && !check){
            return alert_user("Error","Select a principal image to continue.","error");
        }
        // if (inputFile === '') return alert_user("Error","Select a image to continue.","error");

        var fuData = document.getElementById('image_deco1');
        let inputFile1 = $("#image_deco1").val();
        var check = checkImgSize(fuData, inputFile1);
        if(inputFile1 !== '' && !check){
            return alert_user("Error","Select the first decoration image to continue.","error");
        }
        // if (inputFile1 === '') return alert_user("Error","Select a image to continue 2.","error");

        var fuData = document.getElementById('image_deco2');
        let inputFile2 = $("#image_deco2").val();
        var check = checkImgSize(fuData, inputFile2);
        if(inputFile2 !== '' && !check){
            return alert_user("Error","Select the first decoration image to continue .","error");
        }
        // if (inputFile === '') return alert_user("Error","Select a image to continue 3.","error");

        let formData = new FormData(this);
        console.log(formData);
        $.ajax({
            url: "/ajax/insert_carousel_head",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                window.scrollTo(0,0);
                appendAlert('Updated successfully !', 'success')
                setTimeout(() => {
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                //console.error("Aqui mi rey: " + error);
            }
        });
    });


    $("#carousel_form").on("submit", function(event) {
        event.preventDefault();
        let inpurUrl = $("#url_image_carousel").val();
        var fuData = document.getElementById('image_carousel');
        let inputFile = $("#image_carousel").val();
        var check = checkImgSize(fuData, inputFile);
        if(!check){
            return;
        }
        let regex_url = /^(https?:\/\/)?([\w.-]+\.[a-zA-Z]{2,6})(\/[\w.-]*)*\/?$/;
        if (inputFile === '') return alert_user("Error","Select a image to continue.","error");
        if (!regex_url.test(inpurUrl)) return alert_user("Error","Url is invalid.","error");
        let formData = new FormData(this);
        $.ajax({
            url: "/ajax/settings",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false, 
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                window.scrollTo(0,0);
                appendAlert('Added successfully !', 'success')
                setTimeout(() => {
                    location.reload();
                }, 3000);
                // $.ajax({
                //     url: "/ajax/carousel/"+data.id,
                //     method: "GET",
                //     data: formData,
                //     processData: false,
                //     contentType: false, 
                //     success: function(response) {
                //         console.log("hello there",response);
                //     },
                //     error: function(xhr, status, error) {
                //     console.error("Error here ", error);
                //     }
                // });
                // // jQuery code to append a new <li> element
                // let newLi = $('<li class="ui-state-default">New List Item</li>');
                // $('#sortable').append(newLi);
                // $('#carousel_form')[0].reset();
                // $('#imagePreview').attr('src', '');
            },
            error: function(xhr, status, error) {
            // Handle error response
            console.error("Error submitting form: " + error);
            }
        });
    });

    $('#company_id').change(function() {
        var company_id = $(this).val();
        $.ajax({
            url: '/ajax/offers_by_company/'+company_id,
            type: 'get',
            success:function(response) {
                let data = JSON.parse(response);
                $('#offer_id').empty();
                data.map(e=>{
                    $('#offer_id').append('<option value="' + e.id + '">' + e.title + '</option>');
                })
            }
        });
    });
    
    $("#offers_order_form").on("submit", function(event) {
        event.preventDefault();
        let offer_id = $("#offer_id").val();
        let company_id = $("#company_id").val();
        if (offer_id === "" || company_id === "") return alert_user("Error","Its necesary the company and the offer","error");
        let formData = new FormData(this);
        $.ajax({
            url: "/ajax/insert_popular_offer",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false, 
            success: function(response) {
                $("table#table_popular_offers").removeClass("d-none");
                console.log(response);
                $.ajax({
                    url: '/ajax/popular_offer/'+response,
                    type: 'get',
                    success:function(response) {
                        let data = JSON.parse(response);
                        console.log(data);
                        $('table#table_popular_offers > tbody').append(`<tr><td>${data.name}</td><td>${data.title}</td><td><i class="fa-solid fa-trash" data-id="${data.id}"></i></td></tr>`);
                    }
                });
            },
            error: function(xhr, status, error) {
                //console.error("Aqui mi rey: " + error);
            }
        });
    });

    $("#how_it_works_form").on("submit", function(event) {
        event.preventDefault();
        let comment = $("#comment").val();
        let icon_html = $("#icon_html").val();
        let comment_title = $("#comment_title").val();
        if (comment === "") return alert_user("add the comment","the comment is empty","error");
        if (icon_html === "") return alert_user("add the icon","the icon is empty","error");
        if (comment_title === "") return alert_user("Empty title","the title is required","error");
        $.ajax({
            url: "/ajax/insert_how_it_works",
            method: "POST",
            data: {
                comment,
                icon_html,
                comment_title
            },
            success: function(response) {
                let respuesta = JSON.parse(response);
                $('#comment').val('');
                $("#icon_html").val('');
                if (respuesta.status === 200) {
                    alert_user("Review inserted",respuesta.msg,"success");
                    $column = $(`<tr data-id=${respuesta.id}><td>${comment}</td><td>${icon_html}</td><td><span class="text-danger"><i class="fa-solid fa-trash"></i></span></td></tr>`);
                    $("#table_how_it_works > tbody").append($column);
                }
            },
            error: function(xhr, status, error) {
                //console.error("Aqui mi rey: " + error);
            }
        });
    });



function hideModal(){
    $('#deleteModal').modal('hide');
}

$('#deleteModal').on('hide.bs.modal', function () {
    $('#delete_user_button').removeAttr('data-id');
});

$("#review_justlocal").on("submit", function(event) {
    event.preventDefault();
    let comment_review = $("#comment_review").val();
    let name_user = $("#name_user").val();
    let job_description = $("#job_description").val();
    let review_image = $("#review_image").val();
    let formData = new FormData(this);

    var fuData = document.getElementById('review_image');
    let inputFile = $("#review_image").val();
    var check = checkImgSize(fuData, inputFile);
    if(!check){
        return;
    }

    $.ajax({
        url: "/ajax/insert_review",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false, 
        success: function(response) {
            //let data = JSON.parse(response);
            // let respuesta = JSON.parse(response);
            window.scrollTo(0,0);
            appendAlert('Added successfully !', 'success')
            setTimeout(() => {
                location.reload();
            }, 3000);
            // alert_user("Review inserted",respuesta.msg,"success");
            console.log(response);
        },
        error: function(xhr, status, error) {
        // Handle error response
        console.error("Error submitting form: " + error);
        }
    });
});
});