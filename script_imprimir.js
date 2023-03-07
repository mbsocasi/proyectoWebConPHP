
function printReport() {
    
    // Ocultar los botones de acción y la barra de navegación
    var addButton = document.querySelector('.addx');
    addButton.style.display = 'none';
    var navBar = document.querySelector('.navbar');
    navBar.style.display = 'none';
    var reporte5 = document.querySelector('.reporte5');
    reporte5.style.opacity = '0';
    // Obtener la tabla y eliminar la columna de opciones
    var table = document.querySelector('table');
    var headerRow = table.querySelector('thead tr');
    var optionsHeader = headerRow.querySelector('th:last-child');
    headerRow.removeChild(optionsHeader);
    var rows = table.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        var optionsCell = row.querySelector('td:last-child');
        row.removeChild(optionsCell);
    });

    // Eliminar los estilos de la tabla y sus elementos
    table.style.borderCollapse = 'collapse';
    table.style.border = 'none';
    headerRow.style.border = 'none';
    headerRow.style.backgroundColor = 'lightgray';
    var cells = headerRow.querySelectorAll('th');
    cells.forEach(function(cell) {
        cell.style.border = 'none';
        cell.style.padding = '5px';
        cell.style.textAlign = 'left';
    });
    rows.forEach(function(row, index) {
        row.style.backgroundColor = index % 2 === 0 ? 'white' : 'lightgray';
        var cells = row.querySelectorAll('td');
        cells.forEach(function(cell) {
            cell.style.border = 'none';
            cell.style.padding = '5px';
        });
    });

    // Mostrar el encabezado del reporte
    var reportHeader = document.createElement('h3');
    reportHeader.textContent = 'Reporte ';
    var date = new Date();
    var dateHeader = document.createElement('p');
    dateHeader.textContent = 'Fecha: ' + date.toLocaleDateString();
    var codeHeader = document.createElement('p');
    codeHeader.textContent = 'Código: ' + Math.floor(Math.random() * 1000000);
    table.parentNode.insertBefore(reportHeader, table);
    table.parentNode.insertBefore(codeHeader, table);
    table.parentNode.insertBefore(dateHeader, table);

    // Mostrar la vista previa de impresión
    window.print();
    

    // Restaurar la tabla y los botones de acción
    window.onafterprint = function() {
        table.parentNode.removeChild(reportHeader);
        table.parentNode.removeChild(dateHeader);
        table.parentNode.removeChild(codeHeader);
        headerRow.appendChild(optionsHeader);
        rows.forEach(function(row) {
            var lastCell = row.lastElementChild;
            var optionsCell = document.createElement('td');
            optionsCell.appendChild(lastCell.firstChild);
            row.appendChild(optionsCell);
        });
        addButton.style.display = 'inline-block';
        navBar.style.display = 'block';
        // Restaurar los estilos de la tabla y sus elementos
        table.removeAttribute('style');
        headerRow.removeAttribute('style');
        cells.forEach(function(cell) {
            cell.removeAttribute('style');
        });
        rows.forEach(function(row, index) {
            row.removeAttribute('style');
            var cells = row.querySelectorAll('td');
            cells.forEach(function(cell) {
                cell.removeAttribute('style');
            });
        });
    };
        window.location.reload()
}
