$ () ->
  planRowExample = $('#plan-row-example').clone().removeClass('hide')[0].outerHTML
  $('#plan-row-example').remove()
  lastNewRowIndex = 0

  $('.add-plan-row').on 'click', (event) ->
    $self = $(this)
    yearPart = $self.data 'year-part'
    planRow = planRowExample
    planRow = planRow.replace /\{index\}/gi, lastNewRowIndex
    planRow = planRow.replace /\{yearPart\}/gi, yearPart
    ++lastNewRowIndex
    $self.closest('tr').before planRow
