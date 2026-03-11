function showEdit(id) {
    document.querySelector('[onclick="showEdit(' + id + ')"]').style.display = 'none';
    document.getElementById('edit-' + id).style.display = 'flex';
}

function hideEdit(id) {
    document.querySelector('[onclick="showEdit(' + id + ')"]').style.display = '';
    document.getElementById('edit-' + id).style.display = 'none';
}
