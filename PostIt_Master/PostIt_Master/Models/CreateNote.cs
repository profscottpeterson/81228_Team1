using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using PostIt_Master.Models;

namespace PostIt_Master.Models
{
    public class CreateNote
    {
        public static Note findNote(IEnumerable<Note> passedNote)
        {
            NWTCTeamDevDatabaseEntities db = new NWTCTeamDevDatabaseEntities();
            var stickies = db.Notes.ToList();
            Note result = new Note();
            if(passedNote != null)
            {
                foreach (var stick in stickies)
                {
                    foreach (var note in passedNote)
                    {
                        if (note.NoteId == stick.NoteId) result = note;
                    }
                }
            }

            return result;

        }
    }
}