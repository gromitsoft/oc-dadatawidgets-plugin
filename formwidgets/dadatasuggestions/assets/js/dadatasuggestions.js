window.addEventListener('click', function(e) {
    let elements = document.querySelectorAll('.suggestions');
    let isOutside = true;
    if(elements.length) {
        for (var i = 0, len = elements.length; i < len; i++) {
            if (!elements[i].contains(e.target)) {
                elements[i].classList.remove('is_open');
            }
        }
    }
});
