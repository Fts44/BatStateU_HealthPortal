$('#home_prov').change(function(){
    set_municipality('#home_mun','', $('#home_prov').val(), '#home_brgy');
});
$('#home_mun').change(function(){
    set_barangay('#home_brgy', '', $('#home_mun').val());
});

$('#birth_prov').change(function(){
    set_municipality('#birth_mun','', $('#birth_prov').val(), '#birth_brgy');
});
$('#birth_mun').change(function(){
    set_barangay('#birth_brgy', '', $('#birth_mun').val());
});

$('#dorm_prov').change(function(){
    set_municipality('#dorm_mun','', $('#dorm_prov').val(), '#dorm_brgy');
});
$('#dorm_mun').change(function(){
    set_barangay('#dorm_brgy', '', $('#dorm_mun').val());
});

$('#emerg_prov').change(function(){
    set_municipality('#emerg_mun','', $('#emerg_prov').val(), '#emerg_brgy');
});
$('#emerg_mun').change(function(){
    set_barangay('#emerg_brgy', '', $('#emerg_mun').val());
});

$('#department').change(function(){
    set_program('#program', '', $('#department').val());
});

$('#profile_pic').change(function(){
    let file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#profile_pic_preview").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
});

$('.showpassword').click(function(){            
    let input = $('#old_pass, #new_pass, #confirm_pass');
    if(input.attr('type') === 'password'){
        input.attr('type','text');
    }
    else{
        input.attr('type','password');
    }
});