$('#exampleModal').on('shown.bs.modal', function () {
    $('.btn-primary').trigger('focus')
  })

  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
 

/*var select_box_element = document.querySelector('#product-cost-id');

dselect(select_box_element, {
    search: true
});
*/
$(document).ready(function(){ 
  $(
    '#product-cost-type').on('change', function (e) {
    var optionSelected = $("option:selected", this); 
    var selectId = 'product-cost-id';
    var dataIdToKeep = this.value;
    var $select = $('#' + selectId);
    $select.find('option').attr('hidden', false);
    $select.find('option:not([data-cost-type-id="' + dataIdToKeep + '"])').attr('hidden', true);
    $select.find('option[value="' + dataIdToKeep + '"]').attr('selected', true);
    $select.find('option[value="0"]').attr('hidden', false);
    if(dataIdToKeep){
      $('.section-select-cost').show()
    }else{ 
      $select.find('option').attr('hidden', false);
    }
});
})