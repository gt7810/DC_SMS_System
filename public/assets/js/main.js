$(document).ready(function() {

  // Show number of characters left
  $('#message-input').keyup(function() {
    updateCharCount($(this));
  });

  // Set default messages
  $('.red-rain-btn').click(function() {
    var message = "The Red Rain signal is raised. Students should stay at home today.";
    $('#message-input').val(message);
    updateCharCount($('#message-input'));
  });

  $('.black-rain-btn').click(function() {
    var message = "The Black Rain signal is raised. Students should stay at home today. CCA and activities provided by external providers have also been cancelled.";
    $('#message-input').val(message);
    updateCharCount($('#message-input'));
  });

  $('.typhoon-btn').click(function() {
    var message = "The T8 signal is raised. Students should stay at home today. CCA and activities provided by external providers have also been cancelled.";
    $('#message-input').val(message);
    updateCharCount($('#message-input'));
  });

  // Display year group selection
  $('.dropdown-toggle').click(function(e) {
    e.preventDefault();
    $(this).next('.sub-menu').toggle('slow');
  });

  // Get Year group selection and add to URL
  $('.send-year-btn').click(function(e){
    e.preventDefault();
    if($('input[name=year]:checked').length > 0){
      var yeargroups = $('input[name=year]:checked').map(function() {return this.value;}).get().join();
      window.location.href = $(this).attr('href')+yeargroups;
    }else{
      alert('You need to select a year group');
    }
  });

  $('input[name=year]').change(function(){
    if($(this).is(":checked")){
      $(this).parent().addClass('checked');
    }else{
      $(this).parent().removeClass('checked');
    }
  });

  // Function to update character counter
  function updateCharCount(input){
    var characters_left = 160 - input.val().length;
    $('#character-count').text(characters_left);
  };

	//Send test message form via AJAX
  $('#send-test-form').submit(function(e) {

      $('.message-response').remove();
      var _this = $(this);
      $('.loading-overlay').show();
      $(':submit',_this).attr('disabled','disabled');
      var postData = $(this).serializeArray();
      var formURL = $(this).attr("action");

      $.ajax(
      {
          url : formURL,
          type: "POST",
          data : postData,
          success:function(data) 
          { 
              $("#mobileInput").val('');
              $("#messageInput").val('');
              $('.loading-overlay').hide();
              $('.send-test').append(data);
              $(':submit',_this).removeAttr('disabled');
              $('.message-response').delay(3000).fadeOut('slow');
          },
          error: function(data) 
          {
              $('.loading-overlay').hide(); 
              $('.send-test').append(data);
              $(':submit',_this).removeAttr('disabled');
              $('.message-response').delay(3000).fadeOut('slow');
          }
      });
      e.preventDefault();
    });
  
  // Send text to group via Ajax
  $('#send-group-form').submit(function(e) {
      var _this = $(this);
      $('.loading-overlay').show();
      $(':submit',_this).attr('disabled','disabled');
      var postData = $(this).serializeArray();
      var formURL = $(this).attr("action");

      $.ajax(
      {
          url : formURL,
          type: "POST",
          data : postData,
          success:function(url) 
          {
              window.location.href = url;
          },
          error: function(data)
          { 
              $('.loading-overlay').hide(); 
              $('#results-table').prepend(data);
              $(':submit',_this).removeAttr('disabled');
              $('.message-response').delay(3000).fadeOut('slow');
              //Show errors
              var response = JSON.parse(data.responseText);
              $.each( response.errors, function( key, value) {
                  $('.'+key+'-error').text(value).show();
              });
          }
      });
      e.preventDefault();
    });
  

});
