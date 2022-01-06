var getParameters = function () {
    var parameters = '';
    if ($('#q').val() != null && $('#q').val() != '')
        parameters += '&q=' + $('#q').val();
    if ($('#user_name').val() != null && $('#user_name').val() != '')
        parameters += '&name=' + $('#user_name').val();
    if ($('#category_name').val() != null && $('#category_name').val() != '')
        parameters += '&category=' + $('#category_name').val();
    if ($('#type').val() != null && $('#type').val() != '')
        parameters += '&type=' + $('#type').val();
    if ($('#claimedvalue').val() != null && $('#claimedvalue').val() != '')
        parameters += '&claimed=' + $('#claimedvalue').val();
    if ($('#user_email').val() != null && $('#user_email').val() != ''){
        parameters += '&email=' + $('#user_email').val();
    }
    if ($('#user_country').val() != null && $('#user_country').val() != ''){
        parameters += '&country=' + $('#user_country').val();
    }
    if ($('#brand_name').val() != null && $('#brand_name').val() != ''){
        parameters += '&brand_name=' + $('#brand_name').val();
    }
    if ($('#model_name').val() != null && $('#model_name').val() != ''){
        parameters += '&model_name=' + $('#model_name').val();
    }
    if ($('#user_mobile').val() != null && $('#user_mobile').val() != '')
        parameters += '&mobile=' + $('#user_mobile').val();
     if ($('#user_gender').val() != null && $('#user_gender').val() != '')
        parameters += '&gender=' + $('#user_gender').val();
    if ($('#user_platform').val() != null && $('#user_platform').val() != '')
        parameters += '&platform=' + $('#user_platform').val();
    if ($('#pickup_point').val() != null && $('#pickup_point').val() != '')
        parameters += '&pickup_point=' + $('#pickup_point').val();
    if ($('#dest_point').val() != null && $('#dest_point').val() != '')
        parameters += '&dest_point=' + $('#dest_point').val();
    if ($('#datepicker-from').val() != null && $('#datepicker-from').val() != '')
        parameters += '&from_date=' + $('#datepicker-from').val();
    if ($('#datepicker-to').val() != null && $('#datepicker-to').val() != '')
        parameters += '&to_date=' + $('#datepicker-to').val();
    if (getUrlParameter('page') != null)
        parameters += '&page=' + getUrlParameter('page');
    if ($('#offset').val() != null && $('#offset').val() != '')
        parameters += '&offset=' + $('#offset').val();
    if ($('#sort_ele').val() != null && $('#sort_ele').val() != '')
        parameters += '&sort_ele=' + $('#sort_ele').val();
    if ($('#sort_with').val() != null && $('#sort_with').val() != '')
        parameters += '&sort_with=' + $('#sort_with').val();
    return parameters;
};

var getParametersObject = function () {
    var parameters = new Object();
    parameters['sync'] = 1;
    if ($('#q').val() != null && $('#q').val() != '')
        parameters['q'] = $('#q').val();
    if ($('#user_name').val() != null && $('#user_name').val() != '')
        parameters['name'] = $('#user_name').val();
    if ($('#category_name').val() != null && $('#category_name').val() != '')
        parameters['category'] = $('#category_name').val();
    if ($('#type').val() != null && $('#type').val() != '')
        parameters['type'] = $('#type').val();
    if ($('#claimedvalue').val() != null && $('#claimedvalue').val() != '')
        parameters['claimed'] = $('#claimedvalue').val();
    if ($('#user_country').val() != null && $('#user_country').val() != '')
        parameters['country'] = $('#user_country').val();
    if ($('#brand_name').val() != null && $('#brand_name').val() != '')
        parameters['brand_name'] = $('#brand_name').val();
    if ($('#model_name').val() != null && $('#model_name').val() != '')
        parameters['model_name'] = $('#model_name').val();
    if ($('#user_email').val() != null && $('#user_email').val() != '')
        parameters['email'] = $('#user_email').val();
    if ($('#user_mobile').val() != null && $('#user_mobile').val() != '')
        parameters['mobile'] = $('#user_mobile').val();
     if ($('#user_gender').val() != null && $('#user_gender').val() != '')
        parameters['gender'] = $('#user_gender').val();
    if ($('#user_platform').val() != null && $('#user_platform').val() != '')
        parameters['platform'] = $('#user_platform').val();
    if ($('#pickup_point').val() != null && $('#pickup_point').val() != '')
        parameters['pickup_point'] = $('#pickup_point').val();
    if ($('#dest_point').val() != null && $('#dest_point').val() != '')
        parameters['dest_point'] = $('#dest_point').val();
    if ($('#accident_spot').val() != null && $('#accident_spot').val() != '')
        parameters['accident_spot'] = $('#accident_spot').val();
    if ($('#datepicker-from').val() != null && $('#datepicker-from').val() != '')
        parameters['from_date'] = $('#datepicker-from').val();
    if ($('#datepicker-to').val() != null && $('#datepicker-to').val() != '')
        parameters['to_date'] = $('#datepicker-to').val();
    if (getUrlParameter('page') != null)
        parameters['page'] = getUrlParameter('page');
    if ($('#offset').val() != null && $('#offset').val() != '')
        parameters['offset'] = $('#offset').val();
    if ($('#sort_ele').val() != null && $('#sort_ele').val() != '')
        parameters['sort_ele'] = $('#sort_ele').val();
    if ($('#sort_with').val() != null && $('#sort_with').val() != '')
        parameters['sort_with'] = $('#sort_with').val();
    return parameters;
};

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
    
    var recordList = function(){
        //$('#btnSearch').html('Please Wait');
        //$('#btnSearch').attr("disabled", true);
        var parameters = getParametersObject();
       var urlparameters = getParameters();
                $.ajax({
                    url: tblObj.data('url'),
                    type : 'GET',
                    data : parameters,
                    dataType: 'json'
                })
                        .success(function(response) {
                           // $('#list-loader').hide();
                           // tblObj.find('tbody').append(response.rows);
                            tblObj.find('tbody').html(response.rows);
                            tblObj.find('tfoot tr td').html(response.pagination);
                            //tblObj.find('tfoot tr td').html(response.pagination);
                            //total_pages = response.items.last_page;
                            //page = parseInt(response.items.current_page) + 1;
                            //needScroll = true;
                            reinitPagination();
                            window.history.replaceState({
                                isBackPage: false,
                                "html": 'jscv',
                                "pageTitle": 'bsckj'
                            }, "", listUrl + '?query=q' + urlparameters);
                            //$('#btnSearch').html('Search');
                            //$('#btnSearch').attr("disabled", false);
                            
                        })
                        .error(function(response, code) {
                            if(response.status == "419"){
                                toastr.error('Page session expired');
                                setTimeout(function(){
                                    location.reload();             
                                   },2000);
                            }
                            toastr.error('Error in listing rows');
                        });
            };

    recordList();

   

    //var nearToBottom = 200;
    //var needScroll = false;
    
  /*$(window).scroll(function(){
    
    if($(window).scrollTop() + $(window).height() > $(document).height() - nearToBottom) {
      if (page > total_pages){
        return false;
      }else{
      	if(needScroll){
            //paginationURL(page);
            var parameters = getParameters();
          $('#list-loader').show();
          tblObj.data('url', searchUrl + '?page=' + page + parameters );
          recordList();
        //loadVideos(total_pages,page);
        needScroll=false;
    }
      }
    }
  });*/

  var reinitPagination = function(){
        $('.pagination a').on('click', function(e){
            var parameters = getParameters();
            e.preventDefault();
            $("#record-list").data('url', ($(this).data('url') + parameters));
            recordList();
        });
    }

    var sortList = function(_ele, sort_ele){
        var obj = $(_ele);
        $('#sort_ele').val(sort_ele);
        if($('#sort_with').val() == "none" || $('#sort_with').val() == "desc")
        $('#sort_with').val('asc');
        else
        $('#sort_with').val('desc');
        searchUserPageList();
        $('#record-list thead tr th').each(function() { 
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-sort');
         });
         obj.find('i').removeClass('fa-sort');
         if($('#sort_with').val() == "none" || $('#sort_with').val() == "desc")
         obj.find('i').addClass('fa-caret-up');
         else
         obj.find('i').addClass('fa-caret-down');
    }

    var searchUserPageList = function(reset = true){
        if(reset)
        paginationURL(1);
        
        var parameters = getParametersObject();
           var urlparameters = getParameters();
        var tblObj = $("#record-list");
        $.ajax({
            url: searchUrl,
            type : 'GET',
            data : parameters,
            dataType: 'json'
        })
                .success(function(response) {
                    tblObj.find('tbody').html(response.rows);
                    tblObj.find('tfoot tr td').html(response.pagination);
                    
                    reinitSearchedUserPagePagination();
                    window.history.replaceState({
                        isBackPage: false,
                        "html": 'jscv',
                        "pageTitle": 'bsckj'
                    }, "", listUrl + '?query=q' + urlparameters);
                    //initPosition();
                })
                .error(function(response, code) {
                    if(response.status == "419"){
                        toastr.error('Page session expired');
                        setTimeout(function(){
                            location.reload();             
                           },2000);
                    }
                    console.log('Error in listing rows');
                });
                return false;
    };
    
    var reinitSearchedUserPagePagination = function(){
    $('.pagination a').on('click', function(e){
        var parameters = getParameters();
        e.preventDefault();
        searchUrl = $(this).data('url') + parameters;
        searchUserPageList(false);
    });
    }

    var deleteRecord = function(id, ele){
        if(confirm('Are you sure want to delete this record?'))
        {
            $.ajax({
                url: deleteUrl,
                type : 'DELETE',
                data : {id:id, _token:window.Laravel.csrfToken},
                dataType: 'json'
            })
                    .success(function(response) {
                        ele.parents('tr').remove();
                        toastr.success(response.message);
                        
                        reformatSerialNo(ele);
                        if(tblObj.find('tbody').find('tr').length == 0){
                            window.location.href = listUrl;
                        }
                        //recordList();
                    })
                    .error(function(response, code) {
                        if(response.status == "419"){
                            toastr.error('Page session expired');
                            setTimeout(function(){
                                location.reload();             
                               },2000);
                        }
                        toastr.error(response.responseJSON.message);
                    });
        }
    }

    var deleteImageRecord = function(id){
        if(confirm('Are you sure want to delete this record?'))
        {
            $.ajax({
                url: deleteUrl,
                type : 'DELETE',
                data : {id:id, _token:window.Laravel.csrfToken},
                dataType: 'json'
            })
                    .success(function(response) {
                        toastr.success(response.message);
                        productImageList();
                    })
                    .error(function(response, code) {
                        if(response.status == "419"){
                            toastr.error('Page session expired');
                            setTimeout(function(){
                                location.reload();             
                               },2000);
                        }
                        toastr.error(response.message);
                    });
        }
    }

    var changeStatus = function(id, ele){
        if(confirm('Are you sure want to change this status?'))
        {
            $.ajax({
                url: changeUrl,
                type : 'POST',
                data : {id:id, _token:window.Laravel.csrfToken},
                dataType: 'json'
            })
                .success(function(response) {
                    toastr.success(response.message);
                    if(ele.hasClass('btn-primary')){
                    ele.removeClass('btn-primary');
                    ele.addClass('btn-info');
                    ele.html('Inactive');
                    }else{
                    ele.removeClass('btn-info');
                    ele.addClass('btn-primary');
                    ele.html('Active');
                    }
                })
                .error(function(response, code) {
                    if(response.status == "419"){
                        toastr.error('Page session expired');
                        setTimeout(function(){
                            location.reload();             
                           },2000);
                    }
                   // console.log(response.responseJSON.message);
                    toastr.error(response.responseJSON.message);
                });
        }
    }

    var searchRecordList = function(reset = true){
        //if(reset)
        //paginationURL(1);
        var btnSearch = $('.searchBtn');
        startLoader(btnSearch);
        var parameters = getParametersObject();
       var urlparameters = getParameters();
        var tblObj = $("#record-list");
        $.ajax({
            url: searchUrl,
            type : 'GET',
            data : parameters,
            dataType: 'json'
        })
                .success(function(response) {
                    endLoader(btnSearch);
                    $('#list-loader').hide();
                            tblObj.find('tbody').html(response.rows);
                            total_pages = response.items.last_page;
                            page = parseInt(response.items.current_page) + 1;
                            needScroll = true;
                            window.history.replaceState({
                                isBackPage: false,
                                "html": 'jscv',
                                "pageTitle": 'bsckj'
                            }, "", listUrl + '?query=q' + urlparameters);
                })
                .error(function(response, code) {
                    endLoader(btnSearch);
                    if(response.status == "419"){
                        toastr.error('Page session expired');
                        setTimeout(function(){
                            location.reload();             
                           },2000);
                    }
                    console.log('Error in listing rows');
                });
                return false;
    };


var paginationURL = function (page) {
    if (getUrlParameter('page') != null){
        var newUrl = location.href.replace("page="+encodeURIComponent(getUrlParameter('page').trim()), "page="+page);
        window.history.replaceState({
            isBackPage: false,
            "html": 'jscv',
            "pageTitle": 'bsckj'
        }, "", newUrl);
    }else if(window.location.search){
        window.history.replaceState({
            isBackPage: false,
            "html": 'jscv',
            "pageTitle": 'bsckj'
        }, "", window.location.href+'&page='+page);
    }else{
        window.history.replaceState({
            isBackPage: false,
            "html": 'jscv',
            "pageTitle": 'bsckj'
        }, "", window.location.href+'?page='+page);
    }
   }

   var startLoader = function(btn){
    btn.addClass('kt-spinner');
    btn.addClass('kt-spinner--right');
    btn.addClass('kt-spinner--sm');
    btn.addClass('kt-spinner--light');
    btn.prop("disabled", true);
}

var endLoader = function(btn){
    btn.removeClass('kt-spinner');
    btn.removeClass('kt-spinner--right');
    btn.removeClass('kt-spinner--sm');
    btn.removeClass('kt-spinner--light');
    btn.prop("disabled", false);
}

var reformatSerialNo = function(ele){
    var tr = tblObj.find('tbody').find('tr');
    //console.log(tblObj.find('tbody').find('tr').html());
    tr.each(function( index ) {
        //console.log($(this).first('th').html())
        $(this).find('th').html(index+1)
        //console.log( index + ": " + $( this ).text() );
      });
}