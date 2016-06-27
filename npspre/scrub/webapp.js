$(document).ready(function(){
  
  $('#table_lines').on('preInit.dt',function(){
    show_loading_message();
  });
  
  // On page load: datatable
  var tablescrub = $('#table_lines').DataTable({
    "ajax": "data.php?job=get_lines",
    "columns": [
      { "data": "functions",      "sClass": "functions" },
    //  { "data": "id" },
     // { "data": "scrub_Location"},
    //  { "data": "week_ending" },
      { "data": "date", "sclass":"dname"},
      { "data": "case_id"},
      { "data": "queue"},
      { "data": "channel"},
    //  { "data": "manager" },
      { "data": "agent_name" },
      { "data": "csat_score","sClass":"integer" },
      { "data": "resolution_rate"},
      { "data": "verbatim", "sClass":"comment" },
      { "data": "NPS" ,"sClass":"integer"},
      { "data": "site" }
      
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [-1] }
    ],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "oLanguage": {
      "oPaginate": {
        "sFirst":       " ",
        "sPrevious":    " ",
        "sNext":        " ",
        "sLast":        " ",
      },
      "sLengthMenu":    "Records per page: _MENU_",
      "sInfo":          "Total of _TOTAL_ records (showing _START_ to _END_)",
      "sInfoFiltered":  "(filtered from _MAX_ total records)"
      
    }
  });
  
  
  
  
  //run shorten comments, once draw is complete
  $('#table_lines').on('draw.dt',function(){
     NProgress.inc(0.8);
    hide_loading_message();
    $('.comment').shorten();
  });
  
  $('#dropdown1').on('change', function () {
    var ts = tablescrub.columns(10).search( this.value ).draw();
   });
  
  $('#dropdown2').on('change', function () {
    var ts2 = tablescrub.columns(6).search( this.value ).draw();
   });
  
  // On page load: form validation
  jQuery.validator.setDefaults({
    success: 'valid',
    rules: {
      fiscal_year: {
        required: true,
        min:      2000,
        max:      2025
      }
    },
    errorPlacement: function(error, element){
      error.insertBefore(element);
    },
    highlight: function(element){
      $(element).parent('.field_container').removeClass('valid').addClass('error');
    },
    unhighlight: function(element){
      $(element).parent('.field_container').addClass('valid').removeClass('error');
    }
  });
  
  var form_company = $('#form_company');
  form_company.validate();
  var verb;
  var caseid;

  // Edit company button
  $(document).on('click', '.function_edit a', function(e){
    e.preventDefault();
    // Get company information from database
    show_loading_message();
    var id = $(this).data('id');
    console.log(id);
    var request = $.ajax({
      url:          'data.php?job=get_line',
      cache:        false,
      data:         'id=' + id,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    request.done(function(output){
      if (output.result == 'success'){
        //$('.lightbox_content h2').text('Scrub Lines');
        //$('#form_company button').text('Edit Score');
        caseid=output.data[0].case_id;
        
        $("#sc").html("Scrub Case: "+caseid);
        $('#form_company').attr('class', 'form edit');
        $('#form_company').attr('data-id', id);
        $('#form_company .field_container label.error').hide();
        $('#form_company .field_container').removeClass('valid').removeClass('error');
       // $('#form_company #id').val(output.data[0].id);
       // $('#form_company #scrub_Location').val(output.data[0].scrub_Location);
       // $('#form_company #week_ending').val(output.data[0].week_ending);
       // $('#form_company #date').val(output.data[0].date);
     //   $('#form_company #case_id').val(output.data[0].case_id);
        $('#form_company #queue').val(output.data[0].queue);
       // $('#form_company #channel').val(output.data[0].channel);
       // $('#form_company #manager').val(output.data[0].manager);
        $('#form_company #agent_name').val(output.data[0].agent_name);
        $('#form_company #csat_score').val(output.data[0].csat_score);
        $('#form_company #resolution_rate').val(output.data[0].resolution_rate);
        $('#form_company #verbatim').val(output.data[0].verbatim);
        $('#form_company #NPS').val(output.data[0].NPS);
       // $('#form_company #site').val(output.data[0].site);
        
        verb = output.data[0].verbatim;
        caseid=output.data[0].case_id;
        
        hide_loading_message();
        show_lightbox();
        
        $("select#level_1").prop("selectedIndex", -1);
        $("select#dropdown1").prop("selectedIndex", -1);
        $("#level2").hide();
        $("#level22").hide();
        $("#level3").hide();
        $(".people").hide();
        $(".process").hide();
        $(".product").hide();
        $("#level21").hide();
        $('#level_1').val('');
        $('#level_2').val('');
        $('#level22').val('');
        $('#level_3').val('');
        
      } else {
        hide_loading_message();
        show_message('Information request failed', 'error');
      }
    });
    request.fail(function(jqXHR, textStatus){
      hide_loading_message();
      show_message('Information request failed: ' + textStatus, 'error');
    });
  });
  
  // Edit company submit form
  $(document).on('submit', '#form_company.edit', function(e){
    e.preventDefault();
    // Validate form
    if (form_company.valid() == true){
      // Send company information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      
      var id        = $('#form_company').attr('data-id');
      var form_data = $('#form_company').serialize();
      var request   = $.ajax({
        url:          'data.php?job=edit_line&id=' + id,
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
              tablescrub.ajax.reload(function(){
              hide_loading_message();
              //var scrub_id = $('#id').val();
              //console.log(scrub_id);
              show_message("Case ID '" + caseid + "' scrubbed successfully", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Edit request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Edit request failed: ' + textStatus, 'error');
      });
    }
  });
  
  $("select#level_1").on("change",function(){
    var lev1=$("select#level_1 option:selected").val();
    $('#level_22').prop('checked', false);
    $('#level_3').val('');
    
    $("#level22").hide();
    $("#level3").hide();
    
    //console.log(lev1);
    if (lev1=="people") {
        $("#level2").show();
        $("select#level_2").prop("selectedIndex", -1);
        $(".process").hide();
        $(".product").hide();
        $(".people").show(); 
    }
    else if (lev1=="process") {
        $("#level2").show();
        $("select#level_2").prop("selectedIndex", -1);
        $(".people").hide();
        $(".product").hide();
        $(".process").show();
    }
    else if (lev1=="product") {
        $("#level2").show();
        $("select#level_2").prop("selectedIndex", -1);
        $(".people").hide();
        $(".process").hide();
        $(".product").show();
    }
  });
    
  $("select#level_2").on("change",function(){
      var lev2=$("select#level_2 option:selected").val();
      $("#level21").hide();
      $('input#level_2').val('');
      $('#level_22').prop('checked', false); 
      $("#level22").show();
      $("#level3").show();
      $('#level_3').val('');
  });
  
  
  
  
});