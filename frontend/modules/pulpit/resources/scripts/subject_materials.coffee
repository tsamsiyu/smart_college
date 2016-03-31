$fileInput = $('#add-file-input')

$('#add-file').on 'click', () ->
  $fileInput.trigger 'click'

console.log $fileInput.closest('form').attr('action')

$('#add-file-input').fileupload
  dataType: 'json'
  url: $fileInput.closest('form').attr('action')