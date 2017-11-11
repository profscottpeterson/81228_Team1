var picker = document.getElementById('colorPicker');
var note = document.getElementById('note');
picker.addEventListener('change', function() {
    note.style.backgroundColor = this.value;
})


addNote = function() {

    var List = document.getElementById("noteNav").getElementsByTagName("li");
    var length = List.length;

    if (length < 13) {
        var ul = document.getElementById("noteNav");
        var li = document.createElement("li");
        var a = document.createElement('a');
        var children = ul.children.length + 1
        a.setAttribute("class", "x");
        a.setAttribute("onclick", "deleteNote(this)");
        a.appendChild(document.createTextNode("x"));
        li.setAttribute("id", "note" + children);
        li.appendChild(document.createTextNode("NEW NOTE " + children));
        li.appendChild(a);
        ul.appendChild(li);
    } else {
        alert("Note maximum reached");
    }

}

function deleteNote(link) {
    link.parentNode.parentNode.removeChild(link.parentNode);
}

var background = document.getElementById("note")

function blue() {
    background.style.backgroundColor = "lightblue";
}

function yellow() {
    background.style.backgroundColor = "#FBEF65";
}

function pink() {
    background.style.backgroundColor = "pink";
}

function pickColor() {
  picker.click();
}
