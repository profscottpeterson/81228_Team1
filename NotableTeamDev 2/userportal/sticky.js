
// display first note by default ------
var mynotes = document.getElementsByClassName("note");
for (i = 0; i < mynotes.length; i++) {
    mynotes[i].style.display = "none";
    if (i==0) {
        mynotes[i].style.display = "block";
    }
}


// counter to increment each new note created (to test max note number) and increment noteid/notekey
var maxnotekey = 0;
for (i = 0; i < mynotes.length; i++) {
    if (mynotes[i].getAttribute("data-notekey") > maxnotekey) {
        maxnotekey = parseInt(mynotes[i].getAttribute("data-notekey")); 
    }
}

// counter to increment each new note created
var noteNumber = maxnotekey + 1;

addNote = function() {

    SaveLastNote();

    var List = document.getElementById("noteNav").getElementsByTagName("li");
    var length = List.length;

    if (length < 12) {

        //build tab in navigation
        var ul = document.getElementById("noteNav");
        var li = document.createElement("li");
        var a = document.createElement('a');
        var img = document.createElement('img');
        img.setAttribute("src", "../images/trashicon.png");
        img.setAttribute("height", "18px");
        img.setAttribute("height", "18px");
        img.setAttribute("style", "float:right");
        a.setAttribute("class", "x");
        a.setAttribute("onclick", "deleteNote(this)");
        li.setAttribute("id", "note" + noteNumber);
        li.setAttribute("class", "noteLink");
        li.setAttribute("data-notekey", noteNumber);
        li.setAttribute("onclick", "openNote(event, 'Note " + noteNumber + "')");
        li.setAttribute("style", "border-color:#FBEF65");
        li.appendChild(document.createTextNode("New Note"));
        a.appendChild(img);
        li.appendChild(a);
        ul.appendChild(li);

        // add note div for content
        if (noteNumber < 10) {
            var noteCount = li.id.slice(-1);
        }
        if (noteNumber >= 10 && noteNumber < 100) {
            var noteCount = li.id.slice(-2);
        }
        if (noteNumber > 100 && noteNumber < 1000) {
            var noteCount = li.id.slice(-3);
        }
        var noteDiv = document.createElement('div');
        // Build Div and add to page
        noteDiv.id = 'Note ' + noteCount; // gives div an ID that matches the note tab created
        noteDiv.className = 'note';
        noteDiv.style.backgroundColor = '#FBEF65';
        //add custom attribute to match primary key in database
        noteDiv.setAttribute("data-notekey", noteNumber);

        document.getElementsByClassName('rightColumn')[0].appendChild(noteDiv);
        // Add textareas, save, and delete button to new note Div
        var buildDiv = document.getElementById('Note ' + noteCount);
        var title = document.createElement('textarea');
        title.className = 'noteTitle';
        title.setAttribute("oninput", "updateTab(this)")
        title.setAttribute("maxlength", 10);
        title.placeholder = 'New Note';
        buildDiv.appendChild(title);
        var noteContent = document.createElement('textarea');
        noteContent.className = 'noteText';
        noteContent.setAttribute("maxlength", 84);
        noteContent.placeholder = 'Note details';
        buildDiv.appendChild(noteContent);

        noteNumber++;

        //hide all notes, show newly created note in display on right
        var i;
        var note = document.getElementsByClassName("note");
        for (i = 0; i < note.length; i++) {
            note[i].style.display = "none";
        }

        // display newly created note upon creation
        var noteList = document.getElementsByClassName('note')
        noteList[noteList.length - 1].style.display = "block";
    } else {
        alert("Note maximum reached");
    }

}
// delete note tab and connected note div
function deleteNote(link) {
    // remove tab from left column
    var deleteID = link.parentNode;
    link.parentNode.parentNode.removeChild(link.parentNode);
    // get length of ID so we know how many characters to trim off end of ID
    var idLength = deleteID.getAttribute('id').length;
    var noteCount = "";
    // Trim right number of characters off so we have the proper note number to delete
    if (idLength == 5) {
        noteCount = deleteID.getAttribute('id').slice(-1);
    }
    if (idLength == 6) {
        noteCount = deleteID.getAttribute('id').slice(-2);
    }
    if (idLength == 7) {
        noteCount = deleteID.getAttribute('id').slice(-3);
    }

    // Build note ID that we need to delete from note list
    var noteID = "Note " + noteCount;
    var i;
    var elementToRemove = document.getElementById(noteID);



    $('.note').each(function() {
        if (this.id == noteID) {
            var notekeyId = this.getAttribute("data-notekey");
            $.post('../deletenote.php', { notekey: notekeyId }, function() {});
        }
    });


    // remove note from list
    elementToRemove.parentNode.removeChild(elementToRemove);
    //hide all notes
    var notedelete = document.getElementsByClassName("note");
    for (i = 0; i < notedelete.length; i++) {
        notedelete[i].style.display = "none";
    }
    

    // display first note when a note is deleted
    document.getElementsByClassName('note')[0].style.display = "block";
    // cancel onclick method
    link.parentNode.onclick = false;
}

function blue() {
    var tabColor = document.getElementById("noteNav").getElementsByTagName("li");
    var background = document.getElementsByClassName("note");  
    for (i = 0; i < background.length; i++) {
        if (background[i].style.display == "block") {
            background[i].style.backgroundColor = "#8cd0e3";
            tabColor[i].style.borderColor = "#8cd0e3";
        }
    }

}

function yellow() {
    var tabColor = document.getElementById("noteNav").getElementsByTagName("li");
    var background = document.getElementsByClassName("note");    
    for (i = 0; i < background.length; i++) {
        if (background[i].style.display == "block") {
            background[i].style.backgroundColor = "#FBEF65";
            tabColor[i].style.borderColor = "#FBEF65";
        }
    }
}

function pink() {
    var tabColor = document.getElementById("noteNav").getElementsByTagName("li");
    var background = document.getElementsByClassName("note");    
    for (i = 0; i < background.length; i++) {
        if (background[i].style.display == "block") {
            background[i].style.backgroundColor = "pink";
            tabColor[i].style.borderColor = "pink";
        }
    }
}

function pickColor() {
    picker.click();
}

var picker = document.getElementById('colorPicker');
var notepicker = document.getElementsByClassName('note');
var i;
picker.addEventListener('change', function() {
    var tabColor = document.getElementById("noteNav").getElementsByTagName("li");
    for (i = 0; i < notepicker.length; i++) {
      if (notepicker[i].style.display == "block") {
          notepicker[i].style.backgroundColor = this.value;
          tabColor[i].style.borderColor = this.value;
      }
    }
})

// function to display note in window when tab is clicked
function openNote(evt, noteName) {

    //Logic to save note before switching to a different note
    SaveLastNote();    


    // Declare all variables

    var i, note, noteLink;

    // Get all elements with class="note" and hide them
    notehide = document.getElementsByClassName("note");
    for (i = 0; i < notehide.length; i++) {
        notehide[i].style.display = "none";
    }

    // Get all elements with class="noteLink" and remove the class "active"
    noteLink = document.getElementsByClassName("noteLink");
    for (i = 0; i < noteLink.length; i++) {
        noteLink[i].className = noteLink[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(noteName).style.display = "block";
    evt.currentTarget.className += " active";

}

// function to update tab title as note title is typed
function updateTab(title) {

    //get id of parent nod so you can find matching tab
    var id = title.parentNode.getAttribute('id');
    var idLength = id.length;
    var noteCount;
    if (idLength == 6) {
        noteCount = id.slice(-1);
    }
    if (idLength == 7) {
        noteCount = id.slice(-2);
    }
    if (idLength == 8) {
        noteCount = id.slice(-3);
    }
    // set tab title to the newly typed note title
    var noteID = 'note' + noteCount;
    var tab = document.getElementById(noteID);
    tab.innerHTML = title.value + "<a class='x' onclick='deleteNote(this)'><img src= '../images/trashicon.png' height='18px' width='18px' style='float:right'></a>";

    // If user leaves title empty, give tab a default title
    if (title.value == "") {
        tab.innerHTML = "NEW NOTE " + noteCount + "<a class='x' onclick='deleteNote(this)'><img src= '../images/trashicon.png' height='18px' width='18px' style='float:right'></a>";
    }
    //tab.value = title.value;

}

function SaveLastNote() {

    var noteCollectionFirstTitle = document.getElementsByClassName("noteTitle");
    var noteCollectionFirstText = document.getElementsByClassName("noteText");
    var noteCollectionSaveLast = document.getElementsByClassName("note");

    for(var i = 0; i < noteCollectionSaveLast.length; i++) {
        var str = noteCollectionSaveLast[i].getAttribute("style");
        var styleBlock = str.includes("display: block;");
        if (styleBlock) {
            $.post('../updatenote.php', { notekey: noteCollectionSaveLast[i].getAttribute("data-notekey"), 
                            noteTitle: noteCollectionFirstTitle[i].value, 
                                noteDetails: noteCollectionFirstText[i].value, 
                                    noteColor: noteCollectionSaveLast[i].style.backgroundColor}, function() {});
            /* alert(noteCollectionSaveLast[i].getAttribute("data-notekey") + " " +
                 noteCollectionFirstTitle[i].value + " " +
                     noteCollectionFirstText[i].value +  " " +
                        noteCollectionSaveLast[i].style.backgroundColor);  */
        }
    }
}


