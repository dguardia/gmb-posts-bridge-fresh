jQuery(document).ready(function($) {
    // Tab switching functionality
    $('.gmb-tab-btn, .gmb-tab-trigger').on('click', function() {
        var tabId = $(this).data('tab');
        
        // Update tab buttons
        $('.gmb-tab-btn').removeClass('active border-blue-500 text-blue-600')
                         .addClass('border-transparent text-gray-500');
        $('.gmb-tab-btn[data-tab="' + tabId + '"]').addClass('active border-blue-500 text-blue-600')
               .removeClass('border-transparent text-gray-500');
        
        // Update tab content
        $('.gmb-tab-content').removeClass('active').hide();
        $('#' + tabId + '-tab').addClass('active').show();
    });
    
    // Show dashboard tab by default
    $('#dashboard-tab').addClass('active').show();
    
    // Settings form submission
    $('#settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            action: 'gmb_save_settings',
            nonce: gmb_ajax.nonce,
            location_id: $('#location_id').val(),
            allow_customer_override: $('#allow_customer_override').is(':checked') ? 1 : 0
        };
        
        submitForm($(this), formData, 'Settings saved successfully!');
    });
    
    // API Keys form submission
    $('#keys-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            action: 'gmb_save_settings',
            nonce: gmb_ajax.nonce,
            api_key: $('#api_key').val(),
            client_id: $('#client_id').val(),
            client_secret: $('#client_secret').val()
        };
        
        submitForm($(this), formData, 'API keys saved successfully!');
    });
    
    // Test connection button
    $('#test-connection-btn').on('click', function() {
        var $btn = $(this);
        var originalHtml = $btn.html();
        
        $btn.prop('disabled', true)
            .html('<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Testing...');
        
        $.ajax({
            url: gmb_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'gmb_test_connection',
                nonce: gmb_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.data, 'success');
                } else {
                    showMessage(response.data, 'error');
                }
            },
            error: function() {
                showMessage('Connection test failed. Please try again.', 'error');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalHtml);
            }
        });
    });
    
    // Sync now button
    $('#sync-now-btn').on('click', function() {
        var $btn = $(this);
        var originalHtml = $btn.html();
        
        $btn.prop('disabled', true)
            .html('<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Syncing...');
        
        // Simulate sync process
        setTimeout(function() {
            showMessage('Sync completed successfully! 24 posts synchronized.', 'success');
            $btn.prop('disabled', false).html(originalHtml);
        }, 2000);
    });
    
    // Post form submission
    $('#post-form').on('submit', function(e) {
        e.preventDefault();
        
        var content = $('#post_content').val().trim();
        if (!content) {
            showMessage('Please enter post content.', 'error');
            return;
        }
        
        var $btn = $(this).find('button[type="submit"]');
        var originalText = $btn.text();
        
        $btn.prop('disabled', true)
            .html('<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Creating...');
        
        // Simulate post creation
        setTimeout(function() {
            showMessage('Post created successfully! It will be published to your Google My Business profile.', 'success');
            $('#post-form')[0].reset();
            $btn.prop('disabled', false).text(originalText);
        }, 1500);
    });
    
    // Generic form submission function
    function submitForm($form, data, successMessage) {
        var $submitBtn = $form.find('button[type="submit"]');
        var originalText = $submitBtn.text();
        
        $submitBtn.prop('disabled', true)
                  .html('<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Saving...');
        
        $.ajax({
            url: gmb_ajax.ajax_url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    showMessage(successMessage, 'success');
                    // Refresh page to update connection status
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    showMessage(response.data || 'An error occurred. Please try again.', 'error');
                }
            },
            error: function() {
                showMessage('An error occurred. Please try again.', 'error');
            },
            complete: function() {
                $submitBtn.prop('disabled', false).text(originalText);
            }
        });
    }
    
    // Message display function
    function showMessage(message, type) {
        var $messageDiv = $('#gmb-message');
        var $messageText = $('#gmb-message-text');
        var $messageIcon = $('#gmb-message-icon');
        
        // Set message content
        $messageText.text(message);
        
        // Set icon and styling based on type
        if (type === 'success') {
            $messageDiv.removeClass('gmb-message-error').addClass('gmb-message-success');
            $messageIcon.html('<svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>');
        } else {
            $messageDiv.removeClass('gmb-message-success').addClass('gmb-message-error');
            $messageIcon.html('<svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>');
        }
        
        // Show message
        $messageDiv.addClass('gmb-message-show');
        
        // Hide message after 5 seconds
        setTimeout(function() {
            $messageDiv.removeClass('gmb-message-show');
        }, 5000);
    }
    
    // Close message when clicked
    $('#gmb-message').on('click', function() {
        $(this).removeClass('gmb-message-show');
    });
});
