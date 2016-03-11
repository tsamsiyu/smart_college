$ () ->
  $('.cape-subjects-list table').removeClass('hide')
  $('.dot3').dotdotdot()
  $subjectModal = $('#subject-modal')
  if errorsInModal
    $subjectModal.modal()
