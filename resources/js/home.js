function openDreamDialog() {
    const dialog = document.getElementById('noteDialog');
    document.querySelector('.dialogue-title').innerHTML = "Add new dream";
    
    dialog.showModal();
}

function closeDreamDialog() {
    const dialog = document.getElementById('noteDialog').close();
}

document.addEventListener('DOMContentLoaded', function () {
    // Closes the 'add entry' form when you click anywhere on the screen
    document.getElementById('noteDialog').addEventListener('click', function(event){ 
        console.log("hello?");
        if(event.target === event.currentTarget) { 
            closeDreamDialog();
        }
    })
})

function deleteNote(noteId, element) {
    fetch('includes/deleteNote.inc.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}, // sending the data in the same format as forms
        body: 'id=' + encodeURIComponent(noteId)
    })
    .then(res => {
        const card = element.closest('.note-card');
        if (card) card.remove();
    })
}

function openNoteDialog(element) {
    const card = element.closest('.note-card');
    
    // prefill all the values based on the value in the rendered card
    document.getElementById('noteId').value = card.dataset.id; // hidden attribute so only set when dialog is edited
    document.getElementById('noteTitle').value = card.dataset.title;
    document.getElementById('noteContent').value = card.dataset.content;
    document.getElementById('noteDate').value = card.dataset.date;

    document.querySelector('.dialogue-title').innerHTML = "Edit dream";

    const dialog = document.getElementById('noteDialog');
    dialog.showModal();
}