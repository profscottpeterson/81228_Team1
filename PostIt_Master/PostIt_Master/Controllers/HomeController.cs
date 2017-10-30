using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using PostIt_Master.Models;

namespace PostIt_Master.Controllers
{
    public class HomeController : Controller
    {
        private NWTCTeamDevDatabaseEntities db = new NWTCTeamDevDatabaseEntities();

        public ActionResult Index()
        {
            var stickies = db.Notes.ToList();
            List<Note> results = new List<Note>();

            foreach (var stick in stickies)
            {
                Note model = new Note();
                model.NoteTitle = stick.NoteTitle;
                model.NoteDetails = stick.NoteDetails;
                model.NoteId = stick.NoteId;
                results.Add(model);
            }

            return View(results);

            // return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }
    }
}