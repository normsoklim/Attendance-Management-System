

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.confirmLogout = (formId) => {
    document.getElementById(formId).submit();
};

Alpine.start();
