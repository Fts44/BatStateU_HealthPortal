function clear_select(input, default_text){
    $(input).empty();
    $(input).append($('<option>', {
        value: '',
        text: default_text
    }));

}

function set_municipality(select_mun, citymunCode, provCode, select_brgy){
    $(select_mun).empty();
    clear_select(select_mun,'--- Choose Municipality ---');
    clear_select(select_brgy,'--- Choose Barangay ---');
    $.ajax({
        url: window.location.origin+"/PopulateSelect/Municipality/"+provCode,
        type: "GET",
        success: function (response) {      
            $.each( response, function( key, item ) {
                $(select_mun).append($('<option>', { 
                    value: item.citymunCode,
                    text : item.citymunDesc,
                    selected: (item.citymunCode==citymunCode) ? true : false
                }));
            });
        },
        error: function(response) {
            console.log(response);
        }
    });
};

function set_barangay(select_brgy, brgyCode, citymunCode){
    $(select_brgy).empty();
    clear_select(select_brgy,'--- Choose Barangay ---');
    $.ajax({
        url: window.location.origin+"/PopulateSelect/Barangay/"+citymunCode,
        type: "GET",
        success: function (response) {      
            $.each( response, function( key, item ) {
                $(select_brgy).append($('<option>', { 
                    value: item.brgyCode,
                    text : item.brgyDesc,
                    selected: (item.brgyCode==brgyCode) ? true : false
                }));
            });
        },
        error: function(response) {
            console.log(response);
        }
    });
};