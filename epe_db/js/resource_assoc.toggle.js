function resource_assoc_toggle(type) {
    jQuery('.list.' + type).toggle();
    jQuery('.section.' + type + ' .assoc_type').toggleClass('expand');
}
