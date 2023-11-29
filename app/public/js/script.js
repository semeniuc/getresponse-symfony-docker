function copyText() {
    const copyInput = document.getElementById("settings_hook_url");
    navigator.clipboard.writeText(copyInput.value)
}

function addRecord(tableId) {
    const tableBody = document.getElementById(tableId);
    const newRow = document.createElement('tr');
    
    if (tableId === 'tableFields') {
        newRow.innerHTML = `
            <td>
                <button class="deleteRecord border border-0 mt-1" onclick="deleteRecord(this)"><i class="bi bi-trash"></i></button>
            </td>
            <td>
                <select class="form-select bg-light">
                    <option value="" selected></option>
                </select>
            </td>
            <td>
                <select class="form-select bg-light">
                    <option value="" selected></option>
                </select>
            </td>
            <td>
                <select class="form-select bg-light">
                    <option value="" selected></option>
                </select>
            </td> 
        `;
    } else if (tableId === 'tableEvents') {
        newRow.innerHTML = `
            <td>
                <button class="deleteRecord border border-0 mt-1" onclick="deleteRecord(this)"><i class="bi bi-trash"></i></button>
            </td>    
            <td>
                <select class="form-select bg-light">
                    <option value="" selected></option>
                </select>
            </td>
            <td>
                <select class="form-select bg-light">
                    <option value="" selected></option>
                </select>
            </td>
        `;
    }

    if (newRow.innerHTML) {
        // Add a new line in front of the last line
        newRow.classList.add('fade-in');
        tableBody.insertBefore(newRow, tableBody.lastElementChild);
    }
}

function deleteRecord(button) {
  event.preventDefault();
  const row = button.closest('tr');
    if (row) {
        row.classList.add('fade-out');
        setTimeout(() => {
            row.remove(); // Remove the row
        }, 500);
    }
}

// Select with search