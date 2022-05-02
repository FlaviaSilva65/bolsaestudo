// SEDUC DPID - Manuel Afonso 47061 em 20/03/2021
function _(objid) {
    return document.getElementById(objid)
}
function capslock() {
   document.addEventListener('keydown', function(event) {
   var x = event.getModifierState && event.getModifierState('CapsLock')
   _('cps').style.display = (x) ? "block" : "none"
   })
}
function mostra_pass(id,obj) {
    if( _(id).getAttribute('type') == 'password' ){
        _(id).type = 'text'
        obj.className = 'far fa-eye mostra_pass'
        obj.style.color = 'green'
    } else {
        _(id).type = 'password'
        obj.className = 'far fa-eye-slash mostra_pass'
        obj.style.color = '#7e7e7e'
    }
}
$(function(){
    $('.giro').on('mouseover', function(){
        var mv = $(this);
        mv.removeClass('out');
        mv.addClass('in');
    })
    $('.giro').on('mouseout', function(){
        var mv = $(this);
          mv.removeClass('in');
          mv.addClass('out');
    })
});