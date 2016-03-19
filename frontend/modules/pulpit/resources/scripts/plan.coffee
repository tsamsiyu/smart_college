$ () ->
  subjectsList = $('#subjects-list').data 'subjects-list'
  formName = $('#plan-form-name').data 'plan-form-name'

  subjectsListRaw = (() ->
    raw = ''
    console.log(subjectsList);
    for index, subject of subjectsList
      raw += "<option value='#{index}'>#{subject}</option>";
    raw
  )()

  buildInputName = (yearPart, index, name) ->
    "#{formName}[#{yearPart}][#{index}][#{name}]"

  buildPlanRow = (yearPart, index) ->
    "<tr>
      <td>
        <select name='{subjectInputName}' class='form-control'>
          <option value=''></option>
          #{subjectsListRaw}
        </select>
      </td>
      <td>
        <input type='text' name='{creditsInputName}' class='form-control'>
      </td>
      <td></td>
    </tr>"
    .replace '{subjectInputName}', buildInputName yearPart, index, 'subject_id'
    .replace '{creditsInputName}', buildInputName yearPart, index, 'credits'

  $('.add-plan-row').on 'click', (event) ->
    $self = $(this)
    yearPart = $self.data 'year-part'
    nextIndex = $self.data 'next-index'
    $self.data 'next-index', nextIndex + 1
    $self.closest('tr').before (buildPlanRow yearPart, nextIndex)

  $('.remove-plan-row').on 'click', () ->
    $(this).closest('tr').remove()