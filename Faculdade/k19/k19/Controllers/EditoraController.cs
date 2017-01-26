using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using k19.Models;

namespace k19.Controllers
{
    public class EditoraController : Controller
    {
        private k19Context db = new k19Context();

        //
        // GET: /Editora/

        public ActionResult Index()
        {
            return View(db.Editoras.ToList());
        }

        //
        // GET: /Editora/Details/5

        public ActionResult Details(int id = 0)
        {
            Editora editora = db.Editoras.Find(id);
            if (editora == null)
            {
                return HttpNotFound();
            }
            return View(editora);
        }

        //
        // GET: /Editora/Create

        public ActionResult Create()
        {
            return View();
        }

        //
        // POST: /Editora/Create

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(Editora editora)
        {
            if (ModelState.IsValid)
            {
                db.Editoras.Add(editora);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(editora);
        }

        //
        // GET: /Editora/Edit/5

        public ActionResult Edit(int id = 0)
        {
            Editora editora = db.Editoras.Find(id);
            if (editora == null)
            {
                return HttpNotFound();
            }
            return View(editora);
        }

        //
        // POST: /Editora/Edit/5

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit(Editora editora)
        {
            if (ModelState.IsValid)
            {
                db.Entry(editora).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(editora);
        }

        //
        // GET: /Editora/Delete/5

        public ActionResult Delete(int id = 0)
        {
            Editora editora = db.Editoras.Find(id);
            if (editora == null)
            {
                return HttpNotFound();
            }
            return View(editora);
        }

        //
        // POST: /Editora/Delete/5

        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Editora editora = db.Editoras.Find(id);
            db.Editoras.Remove(editora);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            db.Dispose();
            base.Dispose(disposing);
        }
    }
}