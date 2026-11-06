import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';

select2(window, $);
window.Swal = Swal;
window.initialiseContractTenantSelect = () => {
    const select = $('#cTenant');
    if (!select.length) return;
    if (!select.hasClass('select2-hidden-accessible')) {
        select.select2({
            width: '100%',
            placeholder: 'Buscar por nombre, correo o número',
            language: { noResults: () => 'No se encontraron arrendatarios' },
        });
    }
    select.trigger('change.select2');
};
window.initialiseContractTenantSelect();
